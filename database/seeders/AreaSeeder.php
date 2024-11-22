<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Area::create([
            'encargado_Area' => 'Juan Pérez',
            'nombre_Area' => 'Desarrollo de Software',
             // Asegúrate de que el proyecto con ID 1 exista en la tabla 'projects'
        ]);

        Area::create([
            'encargado_Area' => 'María López',
            'nombre_Area' => 'Investigación y Desarrollo',
             // Asegúrate de que el proyecto con ID 2 exista
        ]);

        Area::create([
            'encargado_Area' => 'Carlos García',
            'nombre_Area' => 'Marketing',
             // Asegúrate de que el proyecto con ID 3 exista
        ]);
    }
}
