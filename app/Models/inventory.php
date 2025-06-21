<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    protected $fillable = [
    'product_id',
    'vendor_id',
    'stock_quantity',
    'buying_price',
    'selling_price',
    'low_stock_threshold',
];


    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function product() 
    {
        return $this->belongsTo(Product::class);
    }



}
