<?php

namespace Database\Seeders;


use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Base tables first
        $this->call(UserSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(AreaSeeder::class);
        
        // Create projects before their relationships and avances
        $this->call(ProyectSeeder::class);
        $this->call(ProyectHasAreaSeeder::class);
        
        // Avances must be last since they depend on existing projects
        $this->call(AvanceSeeder::class);
    }
}
