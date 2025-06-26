<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Carbon\Carbon;
use App\Models\Product;

class LandingController extends Controller
{
    public function landing()
{
    $announcement = Announcement::where('start_date', '>', Carbon::now())
                        ->orderBy('start_date', 'asc')
                        ->first();

    $products = Product::all();

    return view('landing', compact('announcement', 'products'));
}
}
