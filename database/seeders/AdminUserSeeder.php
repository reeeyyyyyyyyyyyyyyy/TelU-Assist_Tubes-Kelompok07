<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Tel-U',
            'email' => 'admin@telkomuniversity.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);
    }
}
