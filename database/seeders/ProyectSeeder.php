<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proyect;
use Carbon\Carbon;

class ProyectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proyect::create([
            'nombre_Proyecto' => 'Proyecto de Innovación',
            'descripcion_Proyecto' => 'Un proyecto para innovar en tecnología educativa.',
            'presupuesto_Proyecto' => 1000000,
            'fechaInicio_Proyecto' => Carbon::now()->subMonths(3),
            'fechaFin_Proyecto' => Carbon::now()->addMonths(9),
            'comentario_Proyecto' => 'Este proyecto es crucial para la mejora del aprendizaje.',
             'idPrograma' => 1,// Asegúrate de que el avance con ID 1 exista en la tabla 'avances'
             
        ]);

        Proyect::create([
            'nombre_Proyecto' => 'Proyecto de Salud Comunitaria',
            'descripcion_Proyecto' => 'Mejorar el acceso a servicios de salud en comunidades marginadas.',
            'presupuesto_Proyecto' => 750000,
            'fechaInicio_Proyecto' => Carbon::now()->subMonths(2),
            'fechaFin_Proyecto' => Carbon::now()->addMonths(6),
            'comentario_Proyecto' => 'Este proyecto está alineado con la salud pública.',
            'idPrograma' => 1,// Asegúrate de que el avance con ID 2 exista
        ]);

        Proyect::create([
            'nombre_Proyecto' => 'Proyecto de Infraestructura Verde',
            'descripcion_Proyecto' => 'Desarrollo de espacios verdes en la ciudad.',
            'presupuesto_Proyecto' => 1200000,
            'fechaInicio_Proyecto' => Carbon::now()->subMonths(1),
            'fechaFin_Proyecto' => Carbon::now()->addMonths(12),
            'comentario_Proyecto' => 'Un proyecto esencial para la sostenibilidad urbana.',
             'idPrograma' => 2,// Asegúrate de que el avance con ID 3 exista
        ]);
    }
}
