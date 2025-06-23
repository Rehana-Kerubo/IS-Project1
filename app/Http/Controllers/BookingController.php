<?php
namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $buyer = Auth::guard('buyer')->user(); // assuming buyer is authenticated normally
        $bookedProducts = Booking::with('product')
            ->where('buyer_id', $buyerId)
            ->get();

        return view('buyer.b-products', compact('bookedProducts'));
    }
}
