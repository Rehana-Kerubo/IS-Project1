<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StallPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Announcement;
use Carbon\Carbon;
use App\Models\Vendor;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StallPaymentController extends Controller
{
    public function index()
    {
        $events = Announcement::whereDate('end_date', '>=', now())->get();
        return view('vendor.select-event', compact('events'));
    }

    public function create($announcement_id)
    {
        $event = Announcement::findOrFail($announcement_id);
        $vendor = Auth::guard('buyer')->user()->vendor;
        $buyer = Auth::guard('buyer')->user();


        return view('vendor.book-stall', compact('event', 'vendor' , 'buyer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,vendor_id',
            'announcement_id' => 'required|exists:announcements,announcement_id',
            'amount_paid' => 'required|numeric|min:600',
        ]);

        StallPayment::create([
            'vendor_id' => $request->vendor_id,
            'announcement_id' => $request->announcement_id,
            'amount_paid' => $request->amount_paid,
            'status' => 'paid',
        ]);

        return redirect('/vendor/book-stall')->with('success', 'Stall booked successfully!');
    }
    public function admin_index()
    {
        $events = Announcement::withCount('stallPayments')
                    ->withSum('stallPayments', 'amount_paid') // sum of all payments for each event
                    ->orderBy('start_date', 'desc')
                    ->get();

        return view('admin.stall-bookings', compact('events'));
    }



    public function show(Announcement $announcement)
    {
        $stallPayments = StallPayment::with('vendor')
            ->where('announcement_id', $announcement->announcement_id)
            ->get();

        return view('admin.show-stall-bookings', compact('announcement', 'stallPayments'));
    }

    public function verifyVendor(Request $request, Vendor $vendor)
{
    $announcementId = $request->announcement_id;

    // 1. Find the payment record FIRST
    $payment = StallPayment::where('vendor_id', $vendor->vendor_id)
        ->where('announcement_id', $announcementId)
        ->first();

    if (!$payment) {
        return back()->with('error', 'Vendor has not made a stall payment for this event.');
    }

    // 2. Assign stall number (check for existing assigned ones in this event)
    $lastStallNumber = StallPayment::where('announcement_id', $announcementId)
        ->whereNotNull('stall_number')
        ->max('stall_number');

    $nextStallNumber = ($lastStallNumber ?? 0) + 1;

    $payment->stall_number = $nextStallNumber;
    $payment->save();

    // 3. Only now verify the vendor
    $vendor->status = 'verified';
    $vendor->verified_until = Carbon::parse($request->announcement_end_date);
    $vendor->save();

    return back()->with('success', "Vendor verified and assigned Stall #{$nextStallNumber}.");
}
    
    public function unverifyExpiredVendors()
    {
        Vendor::where('status', 'verified')
            ->update(['status' => 'unverified']);

        return back()->with('success', 'Expired vendor verifications revoked.');
    }

    public function paymentLoader(Request $request)
    {
        // This comes from the form
        $vendor = Auth::guard('buyer')->user()->vendor;

        // Store info in session
        session([
            'type' => 'stall',
            'stall_shop' => $vendor->shop_name,
            'announcement_id' => $request->announcement_id,
            'vendor_id' => $vendor->vendor_id,
            'total' => 1,
        ]);

        return view('vendor.payment-loader');
    }

    public function paymentSuccess()
    {
        logger('paymentSuccess hit ✅');
        logger(session()->all());

        $announcement = Announcement::find(session('announcement_id'));
        $vendor = Vendor::find(session('vendor_id'));

        if (session('type') === 'stall') {
            \App\Models\StallPayment::create([
                'vendor_id' => session('vendor_id'),
                'announcement_id' => session('announcement_id'),
                'amount_paid' => session('amount_paid') ?? session('total'),
                'status' => 'paid',
            ]);
        }
        

        return view('vendor.payment-success', compact('announcement', 'vendor'));
    }

/**
 * Initiate Daraja STK Push
 */
    public function initiateStkPush(Request $request)
    {
        try {
            Log::info('STK Push Initiation Started', $request->all());

            $phone = ltrim($request->phone, '0');
            $phone = '254' . $phone;
            $amount = $request->amount_paid;

            $timestamp = now()->format('YmdHis');
            $shortcode = 174379;
            $passkey = env('PASSKEY');
            $password = base64_encode($shortcode . $passkey . $timestamp);

            // Access Token
            $tokenResponse = Http::withBasicAuth(env('CONSUMER_KEY'), env('CONSUMER_SECRET'))
                ->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

            if (!$tokenResponse->successful()) {
                Log::error('Access Token Request Failed', ['response' => $tokenResponse->body()]);
                return response()->json(['success' => false, 'error' => 'Unable to connect to MPESA API.']);
            }

            $accessToken = $tokenResponse['access_token'];

            Log::info('Sending STK Push', [
                'amount' => $amount,
                'phone' => $phone,
                'vendor_id' => $request->vendor_id,
                'announcement_id' => $request->announcement_id,
            ]);

            // STK Push
            $stkResponse = Http::withToken($accessToken)->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', [
                'BusinessShortCode' => $shortcode,
                'Password' => $password,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $phone,
                'PartyB' => $shortcode,
                'PhoneNumber' => $phone,
                'CallBackURL' => "https://6e53-102-2-90-40.ngrok-free.app/mpesa/callback",
                'AccountReference' => 'Stall Booking',
                'TransactionDesc' => 'Flea Market Stall Booking'
            ]);

            Log::info('STK Push Response', ['response' => $stkResponse->json()]);

            if ($stkResponse->successful()) {
                session([
                    'vendor_id' => $request->vendor_id,
                    'announcement_id' => $request->announcement_id,
                    'amount_paid' => $amount,
                    'type' => $request->type,
                ]);
                return response()->json(['success' => true, 'message' => 'STK Push sent. Check your phone to complete the payment.']);
            } else {
                Log::error('STK Push Failed', ['response' => $stkResponse->body()]);
                return response()->json(['success' => false, 'error' => 'STK Push request failed.']);
            }
        } catch (\Exception $e) {
            Log::error('Exception during STK Push', ['message' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => 'Something went wrong. Try again.']);
        }
    }

    public function handleMpesaCallback(Request $request)
    {
        // Log the raw request body for debugging
        Log::info('M-PESA Callback Raw Body', [
            'raw' => file_get_contents('php://input'),
        ]);
        
        // Log the parsed JSON body
        Log::info('M-PESA Callback Parsed JSON', [
            'json' => $request->all(),
        ]);

        // Log the headers for completeness
        Log::info('M-PESA Callback Headers', [
            'headers' => $request->headers->all(),
        ]);

        $body = $request->input('Body.stkCallback');
        $resultCode = $body['ResultCode'] ?? null;
        $resultDesc = $body['ResultDesc'] ?? null;

        if ($resultCode === 0) {
            $mpesaReceipt = $body['CallbackMetadata']['Item'][1]['Value'] ?? null; // MpesaReceiptNumber
            $amount = $body['CallbackMetadata']['Item'][0]['Value'] ?? null;

            Log::info('Successful Transaction', [
                'transaction_id' => $mpesaReceipt,
                'amount' => $amount,
            ]);

            // Save to DB only on success
            $stallPayment = StallPayment::create([
                'vendor_id' => session('vendor_id'),
                'announcement_id' => session('announcement_id'),
                'amount_paid' => session('amount_paid'),
                'status' => 'paid',
                'transaction_id' => $mpesaReceipt,
            ]);

            Log::info('Stall Payment Saved', $stallPayment->toArray());
        } else {
            Log::warning('M-PESA Callback Result Not Successful', [
                'result_code' => $resultCode,
                'result_description' => $resultDesc,
            ]);
        }

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'OK']);
    }

}