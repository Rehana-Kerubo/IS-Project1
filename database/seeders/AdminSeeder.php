<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            
            ['email' => 'rehana@admin.edu'], 
            [
                'full_name' => 'Rehana Admin',
                'password' => Hash::make('password123'), 
                'must_change_password' => true,
            ]
        );
    }
}
