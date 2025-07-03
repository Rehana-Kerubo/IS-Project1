<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StallPayment extends Model
{
    use HasFactory;

    protected $table = 'stall-payments';

    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'vendor_id',
        'announcement_id',
        'amount_paid',
        'status',
        'stall_number',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'vendor_id');
    }

    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'announcement_id');
    }
}
