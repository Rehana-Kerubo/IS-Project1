<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Buyer;
use App\Models\Product;

class BookingController extends Controller
{
    public function index()
    {
        $buyer = Auth::guard('buyer')->user(); // assuming buyer is authenticated normally
        $bookedProducts = Booking::with('product')
        ->where('buyer_id', $buyer->buyer_id)
            ->get();

        return view('buyer.b-products', compact('bookedProducts'));
    }

    public function destroy($id)
    {
    $booking = Booking::findOrFail($id);

    // Make sure this booking belongs to the logged-in buyer
    if ($booking->buyer_id !== Auth::guard('buyer')->id()) {
        abort(403); // Unauthorized access
    }

    $booking->delete();

    return redirect()->back()->with('success', 'Booking deleted successfully!');
    }

}
