<?php

namespace App\Http\Controllers;

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
    $query = Inventory::where('vendor_id', auth()->id());

    if ($request->has('search')) {
        $query->where('product_name', 'like', '%' . $request->search . '%');
    }

    $inventories = $query->get();

    return view('vendor.pos.index', compact('inventories'));
}


public function inventoryPage()
{
    $vendorId = auth('buyer')->id();


    // Get only this vendor’s products
    $products = \App\Models\Product::where('vendor_id', $vendorId)->get();
    // dd($products);
    // Also show current inventory
    $inventory = \App\Models\Inventory::where('vendor_id', $vendorId)->with('product')->get();

    return view('vendor.pos.inventory', compact('products', 'inventory'));
}


public function storeInventory(Request $request) {
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'stock_quantity' => 'required|integer|min:1',
        'buying_price' => 'required|numeric|min:0',
        'selling_price' => 'required|numeric|min:0',
        // 'low_stock_threshold' => 'nullable|integer|min:0'
    ]);

    Inventory::create([
    'vendor_id' => auth()->id(),
    'product_id' => $request->product_id,
    'stock_quantity' => $request->stock_quantity,
    'buying_price' => $request->buying_price,
    'selling_price' => $request->selling_price, // readonly but passed
    'low_stock_threshold' => 5, // or whatever default
]);


    return back()->with('success', 'Inventory added successfully!');
}


}
