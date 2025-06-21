<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    protected $table = 'admins';

    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'full_name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

