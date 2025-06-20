<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorPOSController extends Controller
{
    // Add new stock
public function storeInventory(Request $request) {
    Inventory::create([
        'vendor_id' => auth()->id(),
        'product_name' => $request->product_name,
        'stock_quantity' => $request->stock_quantity,
        'price' => $request->price,
        'low_stock_threshold' => $request->low_stock_threshold,
    ]);
    return back()->with('success', 'Product added!');
}

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
        'total_price' => $inventory->price * $request->quantity_sold,
    ]);

    return back()->with('success', 'Sale recorded!');
}

}
