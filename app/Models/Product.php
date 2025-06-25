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
        'image_url',
        'available_stock',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'vendor_id');
    }
    public function booking()
    {
        return $this->hasMany(Booking::class, 'product_id');
    }
    public function getBookingCountAttribute()
    {
        return $this->booking()->count();
    }
}
