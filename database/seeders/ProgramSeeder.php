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
            
        ]);

        Program::create([
            'nombre_Programa' => 'Programa de Salud',
            'anio_Programa' => '2023',
            'presupuesto_Programa' => 750000,
            
        ]);

        Program::create([
            'nombre_Programa' => 'Programa de Infraestructura',
            'anio_Programa' => '2025',
            'presupuesto_Programa' => 1200000,
            
        ]);
    }
}
