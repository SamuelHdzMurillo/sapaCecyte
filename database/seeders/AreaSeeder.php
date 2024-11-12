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
            'idProyecto' => 1, // Asegúrate de que el proyecto con ID 1 exista en la tabla 'projects'
        ]);

        Area::create([
            'encargado_Area' => 'María López',
            'nombre_Area' => 'Investigación y Desarrollo',
            'idProyecto' => 2, // Asegúrate de que el proyecto con ID 2 exista
        ]);

        Area::create([
            'encargado_Area' => 'Carlos García',
            'nombre_Area' => 'Marketing',
            'idProyecto' => 3, // Asegúrate de que el proyecto con ID 3 exista
        ]);
    }
}