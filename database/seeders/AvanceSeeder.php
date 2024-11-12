<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Avance;
use Carbon\Carbon;

class AvanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Avance::create([
            'costo_Avance' => 5000,
            'fecha_Avance' => Carbon::now()->subDays(10),
            'descripcion_Avance' => 'Inicio del proyecto',
            'evidencia_Avance' => 'evidencia_inicial.jpg',
            'idProyecto'=>1
        ]);

        Avance::create([
            'costo_Avance' => 3000,
            'fecha_Avance' => Carbon::now()->subDays(5),
            'descripcion_Avance' => 'Primera fase completada',
            'evidencia_Avance' => 'evidencia_fase1.jpg',
            'idProyecto'=>1
        ]);

        Avance::create([
            'costo_Avance' => 4500,
            'fecha_Avance' => Carbon::now()->subDays(2),
            'descripcion_Avance' => 'Segunda fase en progreso',
            'evidencia_Avance' => 'evidencia_fase2.jpg',
            'idProyecto'=>1
        ]);
    }
}