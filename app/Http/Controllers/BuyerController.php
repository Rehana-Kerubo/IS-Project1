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

    // Dummy product data (same as in your earlier example)
    $allProducts = [
        [
            'name' => 'Red T-shirt',
            'image' => 'https://via.placeholder.com/300x200.png?text=Red+T-shirt',
            'price' => '500',
        ],
        [
            'name' => 'Blue Jeans',
            'image' => 'https://via.placeholder.com/300x200.png?text=Blue+Jeans',
            'price' => '800',
        ],
        [
            'name' => 'Green Hoodie',
            'image' => 'https://via.placeholder.com/300x200.png?text=Green+Hoodie',
            'price' => '950',
        ],
    ];

    // Filter based on search query
    $results = array_filter($allProducts, function ($product) use ($query) {
        return str_contains(strtolower($product['name']), $query);
    });

    return view('buyer.search', ['results' => $results]);
}
// Show the form
public function checkout(Request $request)
{
    $product = (object)[
        'id' => $request->id,
        'name' => $request->name,
        'price' => $request->price,
        'image' => $request->image,
    ];

    return view('buyer.checkout', compact('product'));
}


// Handle the form data and go to payment loader
public function processCheckout(Request $request)
{
    session([
        'product_name' => 'Dummy Product',
        'quantity' => $request->quantity,
        'total' => 1500 * $request->quantity, // Or your own logic
        'pickup_date' => now()->addDays(2)->toDateString(),
    ]);

    return redirect()->route('buyer.payment-loader');
}


public function paymentLoader()
{
    // Simulate a small delay before redirecting to the success page
    return view('buyer.payment-loader');
}

public function paymentSuccess()
{
    return view('buyer.payment-success');
}


}
