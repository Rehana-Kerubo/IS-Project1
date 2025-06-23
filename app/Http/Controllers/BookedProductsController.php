<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookedProductsController extends Controller
{
    public function index()
{
    $vendorId = Auth::guard('buyer')->user()->buyer_id;

    $products = Product::where('vendor_id', $vendorId)->get();

    return view('vendor.booked', compact('products'));
}
    public function show($id)
{
    $product = Product::findOrFail($id);
    $bookings = Booking::where('product_id', $id)->get();
    
    // Only get this vendor's products
    $products = Product::withCount('booking') // adds booking_count to each product
        ->where('vendor_id', auth()->id())
        ->get();

    return view('vendor.booked-product', compact('product', 'products', 'bookings'));
}
public function markCommitmentPaid($booking_id)
{
    $booking = Booking::findOrFail($booking_id);
    
    $booking->update([
        'commitment_fee_paid' => true,
        'status' => 'booked',
    ]);

    return back()->with('success', 'Commitment fee marked as paid and booking updated!');
}


}
