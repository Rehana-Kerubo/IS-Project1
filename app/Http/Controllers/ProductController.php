<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Vendor;

class ProductController extends Controller
{
    public function create()
    {
        return view('/vendor/add-product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'available_stock' => 'required|integer|min:1',
        ]);

        $buyer = Auth::user();

// Check if buyer has vendor profile
$vendor = Vendor::where('buyer_id', $buyer->buyer_id)->first();

        // Upload image
        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'vendor_id' => $vendor->vendor_id, // ✅ CORRECT
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => $imagePath,
            'available_stock' => $request->available_stock,
        ]);

        return redirect('/vendor/products')->with('success', 'Product added successfully!');
    }
    public function index()
{
    $vendor = Vendor::where('buyer_id', Auth::id())->first();
    $products = Product::where('vendor_id', $vendor->vendor_id)->get();

    return view('vendor.products', compact('products'));
}

public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('vendor.edit-product', compact('product'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'available_stock' => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($id);
    $product->update($request->only('name', 'description', 'price', 'available_stock'));

    return redirect()->route('vendor.products.index')->with('success', 'Product updated successfully!');
}

public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('vendor.products.index')->with('success', 'Product deleted successfully!');
}

}

