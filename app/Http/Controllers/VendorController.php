<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


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
            $products = Product::all(); // fetch all products from DB
            
            return view('vendor.v-landing', compact('products'));
        }

}

