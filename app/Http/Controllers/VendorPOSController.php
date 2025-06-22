<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Sale;
use App\Models\Vendor;
use App\Models\Product;


class VendorPOSController extends Controller
{
    


// Record sale
public function recordSale(Request $request) {
    $inventory = Inventory::findOrFail($request->inventory_id);

    if ($inventory->stock_quantity < $request->quantity_sold) {
        return back()->with('error', 'Not enough stock!');
    }

    $inventory->stock_quantity -= $request->quantity_sold;
    $inventory->save();

    Sale::create([
    'inventory_id' => $inventory->id,
    'quantity_sold' => $request->quantity_sold,
    'total_price' => ($inventory->selling_price ?? $inventory->product->price) * $request->quantity_sold,
    ]);


    return back()->with('success', 'Sale recorded!');
}
 

public function index(Request $request) {
    $vendorId = Auth::guard('buyer')->id(); // FIXED ✅

    $query = Inventory::with('product')->where('vendor_id', $vendorId);

    if ($request->has('search')) {
        $query->whereHas('product', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });
    }

    $inventories = $query->get();
    //  dd($inventories);
    return view('vendor.pos.index', compact('inventories'));
}



public function inventoryPage()
{
    $vendorId = auth()->guard('buyer')->user()->vendor->vendor_id;

    // Get only this vendor’s products
    $products = \App\Models\Product::where('vendor_id', $vendorId)->get();
    // dd($products);
    // Also show current inventory
    $inventory = \App\Models\Inventory::where('vendor_id', $vendorId)->with('product')->get();

    return view('vendor.pos.inventory', compact('products', 'inventory'));
}


public function storeInventory(Request $request) {
    $request->validate([
        'product_id' => 'required|exists:products,product_id',
        'stock_quantity' => 'required|integer|min:1',
        'buying_price' => 'required|numeric|min:0',
        'selling_price' => 'required|numeric|min:0',
        
    ]);
    // dd($request->all());

    Inventory::create([
    'vendor_id' => auth()->guard('buyer')->user()->vendor->vendor_id,
    'product_id' => $request->product_id,
    'stock_quantity' => $request->stock_quantity,
    'buying_price' => $request->buying_price,
    'selling_price' => $request->selling_price, // readonly but passed
    'low_stock_threshold' => 5, // or whatever default
]);


    return back()->with('success', 'Inventory added successfully!');
}


}
