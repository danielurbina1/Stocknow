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
            ['nombre' => 'Pasta', 'descripcion' => 'Donde hay pasta, legumbres, y similares.'],
            ['nombre' => 'Internacional', 'descripcion' => 'Comida y salsas de países como Japón, China, México, etc.'],
            ['nombre' => 'Café', 'descripcion' => 'Productos relacionados con café, té, y similares.'],
            ['nombre' => 'Bio', 'descripcion' => 'Comida ecológica, sin gluten, y productos orgánicos.'],
            ['nombre' => 'Pan', 'descripcion' => 'Sección de pan fresco y productos relacionados.'],
            ['nombre' => 'Conservas', 'descripcion' => 'Productos enlatados y conservas.'],
            ['nombre' => 'Salsas', 'descripcion' => 'Todo tipo de salsas, desde mayonesa hasta picante.'],
            ['nombre' => 'Bollería', 'descripcion' => 'Dulces, pasteles y productos de bollería.'],
        ];

        // Insertar cada pasillo en la tabla
        foreach ($pasillos as $pasillo) {
            Pasillo::create($pasillo);
        }
    }
}
