<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Buyer;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\Announcement;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class BuyerController extends Controller
{
    public function updateProfile(Request $request)
    {
        $buyer = Auth::guard('buyer')->user(); // This assumes you're using the default guard

        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'profile_pic' => 'nullable|image|max:2048',
        ]);

        $buyer->full_name = $request->input('full_name');
        $buyer->phone_number = $request->input('phone_number');

        if ($request->hasFile('profile_pic')) {
            $imagePath = $request->file('profile_pic')->store('profiles', 'public');
            $buyer->profile_pic = $imagePath;
        }

        $buyer->save();

        return redirect('/buyer/view-acc')->with('success', 'Profile updated successfully!');
    }
    public function landing()
    {
        $announcement = Announcement::where('start_date', '>', Carbon::now())
            ->orderBy('start_date', 'asc')
            ->first();

        $products = Product::all(); // so the products also load

        return view('buyer.landing', compact('announcement', 'products'));
    }

    public function search(Request $request)
{
    $query = strtolower($request->input('query'));
    // Filter based on search query
    $results = Product:: when($query, function ($q) use ($query) {
        $q->where ('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%');
    })->get();

    return view('buyer.search', ['results' => $results]);
}
// Show the form
public function checkout(Request $request)
{
    $product = Product::findOrFail($request->input('product_id'));
    $buyer = Auth::guard('buyer')->user();

    return view('buyer.checkout', compact('product', 'buyer'));
}






public function paymentLoader(Request $request)
{
//    

    $product = Product::findOrFail($request->product_id);
    $quantity = $request->input('quantity', 1);
    $type = $request->input('type', 'purchase'); // default to normal purchase

    $fullTotal = $product->price * $quantity;

    // Calculate fee based on type
    $fee = match ($type) {
        'booking' => $fullTotal * 0.2,
        'cancellation' => $fullTotal * 0.1,
        default => $fullTotal,
    };

    // Store data in session
    session([
        'type' => $type,
        'product_id' => $product->product_id,
        'product_name' => $product->name,
        'quantity' => $quantity,
        'total' => round($fee),
        'pickup_date' => now()->addDays(2)->toDateString(),
        'full_price' => $fullTotal,
        'is_booking' => $type === 'booking',
    ]);

    return view('buyer.payment-loader');
}

public function paymentSuccess()
{
    $type = session('type');
    $buyer = auth('buyer')->user();

    if ($type === 'booking') {
    $booking = \App\Models\Booking::create([
        'buyer_id' => $buyer->buyer_id,
        'product_id' => session('product_id'),
        'quantity' => session('quantity'),
        'status' => 'booked',
        'commitment_fee_paid' => true,
    ]);

    // 🧠 Get product + vendor
    $product = \App\Models\Product::find(session('product_id'));
    $vendor = $product->vendor;

    // 🧠 Get latest announcement (or pick one however you like)
    $announcement = \App\Models\Announcement::latest('start_date')->first();

    // 🧠 Get matching stall payment for this vendor + announcement
    $stallPayment = \App\Models\StallPayment::where('vendor_id', $vendor->vendor_id)
        ->where('announcement_id', $announcement->id ?? 1) // fallback to 1 if none found
        ->first();

    // 💾 Save to session
    session([
        'is_booking' => true,
        'shop_name' => $vendor->shop_name ?? 'N/A',
        'stall_number' => $stallPayment->stall_number ?? 'TBD',
    ]);
}

    // You can add similar logic later for 'cancellation'

    return view('buyer.payment-success');
}



public function bookProduct(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,product_id',
    ]);

    $product = Product::findOrFail($request->product_id);
    $buyer = Auth::guard('buyer')->user();

    return view('buyer.booking-checkout', compact('product', 'buyer'));
}

public function schedules()
{
    $announcements = Announcement::orderBy('start_date', 'asc')->get();
    return view('buyer.schedules', compact('announcements'));
}




public function downloadReceipt()
{
    $pdf = Pdf::loadView('buyer.receipt-pdf');
    return $pdf->download('receipt.pdf');
}


}

