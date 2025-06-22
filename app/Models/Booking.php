<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Buyer;
use App\Models\Product;


class Booking extends Model
{
    protected $fillable = [
        'buyer_id',
        'product_id',
        'quantity',
        'status',
        'commitment_fee_paid',
        'cancellation_fee_paid',
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
