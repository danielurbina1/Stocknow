<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamar al seeder de Pasillos
        $this->call([
            PasilloSeeder::class,
            ProductosSeeder::class,
            UserSeeder::class,


        ]);
    }
}
