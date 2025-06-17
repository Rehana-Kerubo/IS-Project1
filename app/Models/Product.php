<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'vendor_id',
        'name',
        'description',
        'price',
        'image',
        'available_stock',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
