<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

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
}

