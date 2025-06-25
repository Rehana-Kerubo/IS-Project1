<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Product;

class ExploreProductsController extends Controller
{
    public function index()
{
    // Get all vendor IDs where status is verified
    $verifiedVendorIds = Vendor::where('status', 'verified')->pluck('vendor_id');

    // Get all products where the vendor_id is in that list, and eager load the vendor relationship
    $products = Product::whereIn('vendor_id', $verifiedVendorIds)
                ->with('vendor') // this line is the key!
                ->get();

    return view('buyer.explore-products', compact('products'));
}

}

