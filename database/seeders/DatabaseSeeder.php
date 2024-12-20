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
        
        $this->call(UserSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(ProyectSeeder::class);
        $this->call(AvanceSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(ProyectHasAreaSeeder::class);
        
       
    }
}
