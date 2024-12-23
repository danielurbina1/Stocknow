<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pasillo;
use App\Models\Producto;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener todos los pasillos
        $pasillos = Pasillo::all();

        foreach ($pasillos as $pasillo) {
            // Asignamos productos de manera más realista según el pasillo
            switch ($pasillo->nombre) {
                case 'Pasta':
                    Producto::create([
                        'nombre' => 'ALCAMPO Pasta macarrón paquete 1 kg',
                        'precio' => 1.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 120,
                    ]);
                    Producto::create([
                        'nombre' => 'Pasta espagueti paquete 1 kg',
                        'precio' => 1.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 150,
                    ]);
                    Producto::create([
                        'nombre' => 'ALCAMPO Pasta tiburón',
                        'precio' => 2.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 90,
                    ]);
                    Producto::create([
                        'nombre' => 'Arroz largo PRODUCTO',
                        'precio' => 1.60,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 200,
                    ]);
                    Producto::create([
                        'nombre' => 'Pasta tallarín',
                        'precio' => 2.20,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 100,
                    ]);
                    Producto::create([
                        'nombre' => 'Pasta de coditos',
                        'precio' => 1.40,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 130,
                    ]);
                    Producto::create([
                        'nombre' => 'Macarrones en forma de tubo',
                        'precio' => 1.70,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 110,
                    ]);
                    Producto::create([
                        'nombre' => 'Pasta de sopa fideos',
                        'precio' => 1.20,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 160,
                    ]);
                    break;

                case 'Internacional':
                    Producto::create([
                        'nombre' => 'Salsa de soja Kikkoman',
                        'precio' => 2.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 80,
                    ]);
                    Producto::create([
                        'nombre' => 'Salsa Teriyaki japonesa',
                        'precio' => 3.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 60,
                    ]);
                    Producto::create([
                        'nombre' => 'Tortillas de maíz mexicanas',
                        'precio' => 1.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 200,
                    ]);
                    Producto::create([
                        'nombre' => 'Wasabi en pasta',
                        'precio' => 2.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 75,
                    ]);
                    Producto::create([
                        'nombre' => 'Pasta de curry verde tailandesa',
                        'precio' => 3.20,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 50,
                    ]);
                    Producto::create([
                        'nombre' => 'Arroz jazmín tailandés',
                        'precio' => 2.30,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 120,
                    ]);
                    Producto::create([
                        'nombre' => 'Curry en polvo de la India',
                        'precio' => 1.90,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 90,
                    ]);
                    Producto::create([
                        'nombre' => 'Té verde japonés en hojas',
                        'precio' => 4.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 65,
                    ]);
                    break;

                case 'Café':
                    Producto::create([
                        'nombre' => 'Café molido 100% arábica',
                        'precio' => 5.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 100,
                    ]);
                    Producto::create([
                        'nombre' => 'Café expreso en cápsulas',
                        'precio' => 3.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 150,
                    ]);
                    Producto::create([
                        'nombre' => 'Café descafeinado',
                        'precio' => 4.20,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 120,
                    ]);
                    Producto::create([
                        'nombre' => 'Café instantáneo soluble',
                        'precio' => 2.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 130,
                    ]);
                    Producto::create([
                        'nombre' => 'Café en grano Lavazza',
                        'precio' => 6.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 80,
                    ]);
                    Producto::create([
                        'nombre' => 'Café de Colombia 100% orgánico',
                        'precio' => 5.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 150,
                    ]);
                    Producto::create([
                        'nombre' => 'Café filtrado gourmet',
                        'precio' => 4.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 100,
                    ]);
                    Producto::create([
                        'nombre' => 'Té verde en bolsitas',
                        'precio' => 3.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 160,
                    ]);
                    break;

                case 'Bio':
                    Producto::create([
                        'nombre' => 'Arroz integral ecológico',
                        'precio' => 3.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 80,
                    ]);
                    Producto::create([
                        'nombre' => 'Lentejas ecológicas',
                        'precio' => 2.60,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 100,
                    ]);
                    Producto::create([
                        'nombre' => 'Aceite de oliva virgen extra ecológico',
                        'precio' => 5.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 60,
                    ]);
                    Producto::create([
                        'nombre' => 'Leche de almendras sin azúcar',
                        'precio' => 2.40,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 120,
                    ]);
                    Producto::create([
                        'nombre' => 'Pasta de espelta ecológica',
                        'precio' => 3.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 150,
                    ]);
                    Producto::create([
                        'nombre' => 'Galletas integrales',
                        'precio' => 2.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 130,
                    ]);
                    Producto::create([
                        'nombre' => 'Semillas de chía ecológicas',
                        'precio' => 4.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 90,
                    ]);
                    Producto::create([
                        'nombre' => 'Frutos secos sin azúcar',
                        'precio' => 4.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 60,
                    ]);
                    break;

                // Otros pasillos pueden seguir un patrón similar...
            }
        }
    }
}
