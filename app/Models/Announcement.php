<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $primaryKey = 'announcement_id';

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
    ];

    public function stallPayments()
    {
        return $this->hasMany(StallPayment::class, 'announcement_id');
    }
}
