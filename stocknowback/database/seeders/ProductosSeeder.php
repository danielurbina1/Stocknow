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
                        'id' => 10001,
                        'nombre' => 'Pasta macarrón paquete 1 kg',
                        'precio' => 1.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 120,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Pasta macarrón paquete 1 kg.webp',
                    ]);
                    Producto::create([
                        'id' => 10002,
                        'nombre' => 'Pasta espagueti paquete 1 kg',
                        'precio' => 1.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 150,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Pasta espagueti paquete 1 kg.webp',
                    ]);
                    Producto::create([
                        'id' => 10003,
                        'nombre' => 'Pasta tiburón',
                        'precio' => 2.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 90,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Pasta tiburón.webp',
                    ]);
                    Producto::create([
                        'id' => 10004,
                        'nombre' => 'Arroz largo',
                        'precio' => 1.60,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 200,
                        'stock_minimo' => 15, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Arroz largo.webp',
                    ]);
                    Producto::create([
                        'id' => 10005,
                        'nombre' => 'Pasta tallarín',
                        'precio' => 2.20,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 100,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Pasta tallarín.webp',
                    ]);
                    Producto::create([
                        'id' => 10006,
                        'nombre' => 'Pasta espiral con vegetales',
                        'precio' => 1.40,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 130,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Pasta espiral con vegetales.webp',
                    ]);
                    Producto::create([
                        'id' => 10007,
                        'nombre' => 'Pasta de sémola de trigo duro',
                        'precio' => 1.70,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 110,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Pasta de sémola de trigo duro.webp',
                    ]);
                    Producto::create([
                        'id' => 10008,
                        'nombre' => 'Pasta de sopa fideos',
                        'precio' => 1.20,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 160,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Pasta de sopa fideos.webp',
                    ]);
                    break;

                case 'Internacional':
                    Producto::create([
                        'id' => 20001,
                        'nombre' => 'Salsa de soja Kikkoman',
                        'precio' => 2.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 80,
                        'stock_minimo' => 5, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Salsa de soja Kikkoman.webp',
                    ]);
                    Producto::create([
                        'id' => 20002,
                        'nombre' => 'Salsa Teriyaki japonesa',
                        'precio' => 3.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 60,
                        'stock_minimo' => 5, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Salsa Teriyaki japonesa.webp',
                    ]);
                    Producto::create([
                        'id' => 20003,
                        'nombre' => 'Tortillas de maíz mexicanas',
                        'precio' => 1.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 200,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Tortillas de maíz mexicanas.webp',
                    ]);
                    Producto::create([
                        'id' => 20004,
                        'nombre' => 'Wasabi en pasta',
                        'precio' => 2.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 75,
                        'stock_minimo' => 5, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Wasabi en pasta.webp',
                    ]);
                    Producto::create([
                        'id' => 20005,
                        'nombre' => 'Pasta de curry',
                        'precio' => 3.20,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 50,
                        'stock_minimo' => 5, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Pasta de curry.webp',
                    ]);
                    Producto::create([
                        'id' => 20006,
                        'nombre' => 'Salsa de guacamole',
                        'precio' => 2.30,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 120,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Salsa de guacamole.webp',
                    ]);
                    Producto::create([
                        'id' => 20007,
                        'nombre' => 'Nachos fritos de maíz',
                        'precio' => 1.90,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 90,
                        'stock_minimo' => 5, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/nachos fritos de maíz.webp',
                    ]);
                    Producto::create([
                        'id' => 20008,
                        'nombre' => 'Frijoles rojos guisados',
                        'precio' => 4.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 65,
                        'stock_minimo' => 5, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Frijoles rojos guisados.webp',
                    ]);
                    break;

                case 'Café':
                    Producto::create([
                        'id' => 30001,
                        'nombre' => 'Café molido 100% arábica',
                        'precio' => 5.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 100,
                        'stock_minimo' => 20, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Café molido 100% arábica.webp',
                    ]);
                    Producto::create([
                        'id' => 30002,
                        'nombre' => 'Café expreso en cápsulas',
                        'precio' => 3.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 150,
                        'stock_minimo' => 20, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Café expreso en cápsulas.webp',
                    ]);
                    Producto::create([
                        'id' => 30003,
                        'nombre' => 'Café descafeinado',
                        'precio' => 4.20,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 120,
                        'stock_minimo' => 20, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Café descafeinado.webp',
                    ]);
                    Producto::create([
                        'id' => 30004,
                        'nombre' => 'Café instantáneo soluble',
                        'precio' => 2.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 130,
                        'stock_minimo' => 20, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Café instantáneo soluble.webp',
                    ]);
                    Producto::create([
                        'id' => 30005,
                        'nombre' => 'Café en grano Lavazza',
                        'precio' => 6.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 80,
                        'stock_minimo' => 20, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Café en grano Lavazza.webp',
                    ]);
                    Producto::create([
                        'id' => 30006,
                        'nombre' => 'Café de Colombia',
                        'precio' => 5.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 150,
                        'stock_minimo' => 20, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Café de Colombia.webp',
                    ]);
                    Producto::create([
                        'id' => 30007,
                        'nombre' => 'Café en cápsulas con leche',
                        'precio' => 4.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 100,
                        'stock_minimo' => 20, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Café en cápsulas con leche.webp',
                    ]);
                    Producto::create([
                        'id' => 30008,
                        'nombre' => 'Té verde en bolsitas',
                        'precio' => 3.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 160,
                        'stock_minimo' => 20, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Té verde en bolsitas.webp',
                    ]);
                    break;

                case 'Bio':
                    Producto::create([
                        'id' => 40001,
                        'nombre' => 'Arroz integral ecológico',
                        'precio' => 3.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 80,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Arroz integral ecológico.webp',
                    ]);
                    Producto::create([
                        'id' => 40002,
                        'nombre' => 'Lentejas ecológicas',
                        'precio' => 2.60,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 100,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Lentejas ecológicas.webp',
                    ]);
                    Producto::create([
                        'id' => 40003,
                        'nombre' => 'Aceite de oliva virgen extra ecológico',
                        'precio' => 5.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 60,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Aceite de oliva virgen extra ecológico.webp',
                    ]);
                    Producto::create([
                        'id' => 40004,
                        'nombre' => 'Leche de almendras sin azúcar',
                        'precio' => 2.40,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 120,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Leche de almendras sin azúcar.webp',
                    ]);
                    Producto::create([
                        'id' => 40005,
                        'nombre' => 'Pasta de espelta ecológica',
                        'precio' => 3.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 150,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Pasta de espelta ecológica.webp',
                    ]);
                    Producto::create([
                        'id' => 40006,
                        'nombre' => 'Galletas integrales sin azúcar',
                        'precio' => 3.20,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 90,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Galletas integrales sin azúcar.webp',
                    ]);
                    Producto::create([
                        'id' => 40007,
                        'nombre' => 'Muesli ecológico sin gluten',
                        'precio' => 4.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 75,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Muesli ecológico sin gluten.webp',
                    ]);
                    Producto::create([
                        'id' => 40008,
                        'nombre' => 'Cereales integrales ecológicos',
                        'precio' => 3.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 60,
                        'stock_minimo' => 10, // Asignación del stock mínimo
                        'imagen' => 'imagenes_productos/Cereales integrales ecológicos.webp',
                    ]);
                    break;
            }
        }
    }
}
