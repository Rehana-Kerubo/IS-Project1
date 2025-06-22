<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Buyer;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class BuyerController extends Controller
{
    public function updateProfile(Request $request)
    {
        $buyer = Auth::user(); // This assumes you're using the default guard

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
    $products = Product::all(); // fetch all products from DB
    return view('buyer.landing', compact('products'));
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
   
    $product =  Product::findOrFail($request->input('product_id'));
    return view('buyer.checkout', compact('product'));
}





public function paymentLoader(Request $request)
{
    $product = Product::findOrFail($request->product_id); // ✅ will now work
    $quantity = $request->input('quantity', 1); // Default to 1 if not provided
    $total = $product->price * $quantity;
    // Store the checkout data in the session
    session([
        'product_name' => $product->name,
        'quantity' => $quantity,
        'total' => $total, // Or your own logic
        'pickup_date' => now()->addDays(2)->toDateString(),
    ]);
    // Simulate a small delay before redirecting to the success page
    return view('buyer.payment-loader');
}

public function paymentSuccess()
{
    return view('buyer.payment-success');
}


public function bookProduct(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,product_id',
    ]);

    $product = Product::findOrFail($request->product_id);

    return view('buyer.checkout', [
        'product' => $product,
        'type' => 'booking'
    ]);
}



}
