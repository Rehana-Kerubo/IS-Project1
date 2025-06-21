<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    protected $fillable = [
        'vendor_id',
        'product_name',
        'stock_quantity',
        'price',
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
