<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    protected $fillable = [
        'inventory_id',
        'quantity_sold',
        'total_price',
        'profit',
    ];

    public function inventory()
    {
        return $this->belongsTo(inventory::class);
    }
}
