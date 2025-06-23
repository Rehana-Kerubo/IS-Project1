<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\Announcement;
use Carbon\Carbon;


class VendorController extends Controller
{
    public function create()
    {
        // Show the vendor registration form
        return view('/buyer/be-vendor');
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'shop_name' => 'required|string|max:100',
            'shop_category' => 'required|string|max:100',
        ]);
        
        $user = Auth::guard('buyer')->user();
        $user->role = 'vendor';
        $user->save();

        // Check if the buyer is already registered as a vendor
        $existing = Vendor::where('buyer_id', Auth::id())->first();

        if ($existing) {
            return redirect()->back()->with('error', 'You have already registered as a vendor.');
        }

        // Create the vendor record
        Vendor::create([
            'buyer_id' => Auth::id(),
            'shop_name' => $request->shop_name,
            'shop_category' => $request->shop_category,
            // status defaults to 'unverified'
        ]);

        return redirect('/vendor/dashboard')->with('success', 'Successfully registered as vendor!');
        
    }
    //Update vendor details
    public function update(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:100',
            'shop_category' => 'required|string|max:100',
        ]);

        $user = Auth::guard('buyer')->user();


        // Update buyer's role
        $user->role = 'vendor';
        $user->save();

        // Update vendor details
        $vendor = $user->vendor;
        
        if (!$vendor) {
            return redirect()->back()->with('error', 'You are not registered as a vendor.');
        }

        $vendor->shop_name = $request->shop_name;
        $vendor->shop_category = $request->shop_category;
        $vendor->save();

        return redirect()->back()->with('success', 'Shop details updated successfully!');
    }
    public function landing()
    {
        $announcement = Announcement::where('start_date', '>', Carbon::now())
            ->orderBy('start_date', 'asc')
            ->first();

        $products = Product::all(); // so the products also load

        return view('vendor.v-landing', compact('announcement', 'products'));
    }

    public function checkout(Request $request)
    {
        $product =  Product::findOrFail($request->input('product_id'));
        return view('vendor.checkout', compact('product'));
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
        return view('vendor.payment-loader');
    }

    public function paymentSuccess()
    {
        return view('vendor.payment-success');
    }
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

        // if ($request->hasFile('profile_pic')) {
        //     $imagePath = $request->file('profile_pic')->store('profiles', 'public');
        //     $buyer->profile_pic = $imagePath;
        // }

        $buyer->save();

        return redirect('/vendor/profile')->with('success', 'Profile updated successfully!');
    }
}

