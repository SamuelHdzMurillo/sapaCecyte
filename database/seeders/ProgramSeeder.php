<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Program::create([
            'nombre_Programa' => 'Programa de Educación',
            'anio_Programa' => '2024',
            'presupuesto_Programa' => 500000,
            'idProyecto' => 1, // Asegúrate de que el proyecto con ID 1 exista en la tabla 'projects'
        ]);

        Program::create([
            'nombre_Programa' => 'Programa de Salud',
            'anio_Programa' => '2023',
            'presupuesto_Programa' => 750000,
            'idProyecto' => 2, // Asegúrate de que el proyecto con ID 2 exista
        ]);

        Program::create([
            'nombre_Programa' => 'Programa de Infraestructura',
            'anio_Programa' => '2025',
            'presupuesto_Programa' => 1200000,
            'idProyecto' => 3, // Asegúrate de que el proyecto con ID 3 exista
        ]);
    }
}
