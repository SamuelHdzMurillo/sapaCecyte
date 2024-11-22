<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProyectHasArea;

class ProyectHasAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProyectHasArea::create([
            'idArea' => 1,  // Ajusta según los valores de tu tabla 'areas'
            'idProyecto' => 2,  // Ajusta según los valores de tu tabla 'proyects'
        ]);

        ProyectHasArea::create([
            'idArea' => 2,
            'idProyecto' => 2,
        ]);

        ProyectHasArea::create([
            'idArea' => 1,
            'idProyecto' => 2,
        ]);

        ProyectHasArea::create([
            'idArea' => 3,
            'idProyecto' => 3,
        ]);
        
        // Agrega más inserciones según lo necesites
    }
}
