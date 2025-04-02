<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Base tables first
        $this->call(UserSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(AreaSeeder::class);
        
        // Create projects before their relationships and avances
        $this->call(ProyectSeeder::class);
        $this->call(ProyectHasAreaSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call([FacturaSeeder::class]);
        
        // Avances must be last since they depend on existing projects
        $this->call(AvanceSeeder::class);
    }
}
