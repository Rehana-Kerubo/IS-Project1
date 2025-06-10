<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Buyer extends Authenticatable
{
    use Notifiable;

    

    protected $primaryKey = 'buyer_id'; // tell Laravel your PK is buyer_id

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
    ];

    protected $table = 'buyers'; // Make sure Laravel knows which table
}
