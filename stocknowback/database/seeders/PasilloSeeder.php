<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pasillo;

class PasilloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lista de pasillos con sus descripciones
        $pasillos = [
            ['nombre' => 'Pasta', 'descripcion' => 'Donde hay pasta, legumbres, y similares.' , 'user_id' => 1],
            ['nombre' => 'Internacional', 'descripcion' => 'Comida y salsas de países como Japón, China, México, etc.' , 'user_id' => 2],
            ['nombre' => 'Café', 'descripcion' => 'Productos relacionados con café, té, y similares.' , 'user_id' => 3],
            ['nombre' => 'Bio', 'descripcion' => 'Comida ecológica, sin gluten, y productos orgánicos.' , 'user_id' => 4],
            ['nombre' => 'Pan', 'descripcion' => 'Sección de pan fresco y productos relacionados.' , 'user_id' => 5],
            ['nombre' => 'Conservas', 'descripcion' => 'Productos enlatados y conservas.' , 'user_id' => 6],
            ['nombre' => 'Salsas', 'descripcion' => 'Todo tipo de salsas, desde mayonesa hasta picante.' , 'user_id' => 7],
            ['nombre' => 'Bollería', 'descripcion' => 'Dulces, pasteles y productos de bollería.' , 'user_id' => 8],
        ];

        // Insertar cada pasillo en la tabla
        foreach ($pasillos as $pasillo) {
            Pasillo::create($pasillo);
        }
    }
}
