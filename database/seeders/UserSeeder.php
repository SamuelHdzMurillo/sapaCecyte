<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            
            'correo_Usuario' => 'pili@gmail.com',
            'nombre_Usuario' => 'samuel hernandez murillo',
            'rol_Usuario' => 'admin',
            'area_Usuario' => 'Informatica',
            'password' => Hash::make('password123'), // Encripta la contraseña
        ]);

        // Puedes añadir más usuarios si lo deseas
        User::create([
            'correo_Usuario' => 'pili2@gmail.com',
            'nombre_Usuario' => 'daniel carillo cortes',
            'rol_Usuario' => 'user',
            'area_Usuario' => 'Informatica',
            'password' => Hash::make('password456'),
        ]);
    }
}
