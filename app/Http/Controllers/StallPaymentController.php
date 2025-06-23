<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StallPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Announcement;
use Carbon\Carbon;
use App\Models\Vendor;

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

        return view('vendor.book-stall', compact('event', 'vendor'));
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
        $events = Announcement::latest()->get(); // flea market events

        return view('admin.stall-bookings', compact('events'));
    }

    public function show(Announcement $announcement)
{
    $stallPayments = StallPayment::with('vendor')
        ->where('announcement_id', $announcement->announcement_id)
        ->get();

    // Get expired vendors for this announcement only
    $expiredVendors = Vendor::where('status', 'verified')
        ->where('verified_until', '<', Carbon::now())
        ->whereIn('vendor_id', $stallPayments->pluck('vendor_id'))
        ->get();

    return view('admin.show-stall-bookings', compact('announcement', 'stallPayments', 'expiredVendors'));
}
    public function verifyVendor(Request $request, Vendor $vendor)
    {
        $vendor->status = 'verified';

        // Optional: store end date for revoking access later
        $vendor->verified_until = Carbon::parse($request->announcement_end_date);

        $vendor->save();

        return back()->with('success', 'Vendor has been verified until the end of the event.');
    }
    public function unverifyExpiredVendors()
    {
        Vendor::where('status', 'verified')
            ->where('verified_until', '<', Carbon::now())
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
        'total' => 600,
    ]);

    return view('vendor.payment-loader');
}

public function paymentSuccess()
{
    if (session('type') === 'stall') {
        \App\Models\StallPayment::create([
            'vendor_id' => session('vendor_id'),
            'announcement_id' => session('announcement_id'),
            'amount_paid' => session('total'),
            'status' => 'paid',
        ]);
    }

    return view('vendor.payment-success');
}

}