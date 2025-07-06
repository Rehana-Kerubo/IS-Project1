<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Vendor;

class CategoryController extends Controller
{
    public function create() {
        $categories = Category::all();

    // Prepare data for the pie chart
    $chartLabels = [];
    $chartData = [];

    foreach ($categories as $category) {
        $chartLabels[] = $category->name;
        $chartData[] = Vendor::where('category_id', $category->id)->count();
    }

    return view('admin.create-category', compact('categories', 'chartLabels', 'chartData'));
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:categories,name|max:255',
        ]);
    
        Category::create(['name' => $request->name]);
    
        return redirect()->back()->with('success', 'Category added successfully!');
    }
}
