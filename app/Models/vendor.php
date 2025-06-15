<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'vendors';

    protected $primaryKey = 'vendor_id';

    protected $fillable = [
        'buyer_id',
        'shop_name',
        'shop_category',
        'status',
    ];

    // If you want to define the relationship back to the buyer:
    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }
}
