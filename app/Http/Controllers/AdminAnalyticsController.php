<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminAnalyticsController extends Controller
{
    public function vendorAnalytics()
    {
        $totalRevenue = DB::table('sales')->sum('total_price');

        $vendorCount = DB::table('vendors')->count();

        $vendors = DB::table('vendors')
        ->leftJoin('products', 'vendors.vendor_id', '=', 'products.vendor_id')
        ->leftJoin('buyers', 'vendors.buyer_id', '=', 'buyers.buyer_id')
        ->select(
            'vendors.vendor_id',
            'vendors.shop_name',
            'vendors.shop_category',
            'vendors.status',
            'buyers.full_name as buyer_name',
            DB::raw('COUNT(products.product_id) as product_count')
        )
        ->groupBy(
            'vendors.vendor_id',
            'vendors.shop_name',
            'vendors.shop_category',
            'vendors.status',
            'buyers.full_name'
        )
        ->get();

        return view('admin.vendor-analytics', compact('totalRevenue', 'vendorCount', 'vendors'));
    }
    public function buyerAnalytics()
{
    $buyerCount = DB::table('buyers')
        ->where('role', 'buyer')
        ->count();

    $buyers = DB::table('buyers')
        ->where('role', 'buyer')
        ->select('buyer_id', 'full_name', 'email')
        ->orderBy('full_name')
        ->get();

    return view('admin.buyer-analytics', compact('buyerCount', 'buyers'));
}


}
