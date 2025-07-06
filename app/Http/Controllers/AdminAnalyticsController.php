<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vendor;
use App\Models\Category;



class AdminAnalyticsController extends Controller
{
    public function analytics()
    {
        $totalRevenue = DB::table('sales')->sum('total_price');

        $vendorCount = DB::table('vendors')->count();

        $buyerCount = DB::table('buyers')
            ->where('role', 'buyer')
            ->count();


        $vendors = DB::table('vendors')
        ->leftJoin('products', 'vendors.vendor_id', '=', 'products.vendor_id')
        ->leftJoin('buyers', 'vendors.buyer_id', '=', 'buyers.buyer_id')
        ->leftJoin('categories', 'vendors.category_id', '=', 'categories.id') 
        ->select(
            'vendors.vendor_id',
            'vendors.shop_name',
            'buyers.email',
            'buyers.phone_number',
            'vendors.status',
            'categories.name as category_name', 
            'buyers.full_name as buyer_name',
            DB::raw('COUNT(products.product_id) as product_count')
        )
        ->groupBy(
            'vendors.vendor_id',
            'vendors.shop_name',
            'buyers.email',
            'buyers.phone_number',
            'vendors.status',
            'categories.name',
            'buyers.full_name'
        )
        ->get();
        

        return view('admin.analytics', compact('totalRevenue', 'buyerCount','vendorCount', 'vendors'));
    }
}
