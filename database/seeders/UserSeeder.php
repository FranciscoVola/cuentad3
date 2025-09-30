<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario administrador
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            User::create([
                'name' => 'soyAdmin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456789'),
                'rol' => 'admin'
            ]);
        }

        // Usuario común
        if (!User::where('email', 'usuario@gmail.com')->exists()) {
            User::create([
                'name' => 'usuario',
                'email' => 'usuario@gmail.com',
                'password' => Hash::make('12345678'),
                'rol' => 'user'
            ]);
        }
    }
}
