<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener IDs de áreas existentes
        $areas = DB::table('areas')->pluck('id')->toArray();

        if (empty($areas)) {
            $this->command->warn('No hay áreas disponibles en la tabla "areas". Asegúrate de poblarla antes de ejecutar este seeder.');
            return;
        }

        // Poblar la tabla 'users'
        DB::table('users')->insert([
            [
                'correo_Usuario' => 'admin@example.com',
                'nombre_Usuario' => 'Administrador',
                'rol_Usuario' => 'admin',
                'area_Usuario' => $areas[array_rand($areas)],
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'correo_Usuario' => 'user@example.com',
                'nombre_Usuario' => 'Usuario General',
                'rol_Usuario' => 'user',
                'area_Usuario' => $areas[array_rand($areas)],
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->command->info('Se han insertado usuarios en la tabla "users".');
    }
}
