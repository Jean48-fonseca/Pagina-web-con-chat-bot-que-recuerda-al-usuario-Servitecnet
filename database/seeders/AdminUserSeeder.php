<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
  
    public function run(): void
    {
        user::create([
            'name' => 'Admin ServitecNet',
            'email' => 'admin@servitecnet.com',
            'password' => Hash::make('Admin2026'), //<--contraseña encriptada
            'role' => 'admin', //<--privelegio de administrador
        ]);
    }
}
