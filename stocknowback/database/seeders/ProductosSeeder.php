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
                        'nombre' => 'ALCAMPO Pasta macarrón paquete 1 kg',
                        'precio' => 1.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 120,
                        'imagen' => 'imagenes_productos/probar.jpg',
                    ]);
                    Producto::create([
                        'id' => 10002,
                        'nombre' => 'Pasta espagueti paquete 1 kg',
                        'precio' => 1.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 150,
                        'imagen' => 'imagenes_productos/pasta_espagueti_1kg.jpg',
                    ]);
                    Producto::create([
                        'id' => 10003,
                        'nombre' => 'ALCAMPO Pasta tiburón',
                        'precio' => 2.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 90,
                        'imagen' => 'imagenes_productos/pasta_tiburon.jpg',
                    ]);
                    Producto::create([
                        'id' => 10004,
                        'nombre' => 'Arroz largo PRODUCTO',
                        'precio' => 1.60,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 200,
                        'imagen' => 'imagenes_productos/arroz_largo.jpg',
                    ]);
                    Producto::create([
                        'id' => 10005,
                        'nombre' => 'Pasta tallarín',
                        'precio' => 2.20,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 100,
                        'imagen' => 'imagenes_productos/pasta_tallarín.jpg',
                    ]);
                    Producto::create([
                        'id' => 10006,
                        'nombre' => 'Pasta de coditos',
                        'precio' => 1.40,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 130,
                        'imagen' => 'imagenes_productos/pasta_coditos.jpg',
                    ]);
                    Producto::create([
                        'id' => 10007,
                        'nombre' => 'Macarrones en forma de tubo',
                        'precio' => 1.70,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 110,
                        'imagen' => 'imagenes_productos/macarrones_tubo.jpg',
                    ]);
                    Producto::create([
                        'id' => 10008,
                        'nombre' => 'Pasta de sopa fideos',
                        'precio' => 1.20,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 160,
                        'imagen' => 'imagenes_productos/pasta_sopa_fideos.jpg',
                    ]);
                    break;

                case 'Internacional':
                    Producto::create([
                        'id' => 20001,
                        'nombre' => 'Salsa de soja Kikkoman',
                        'precio' => 2.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 80,
                        'imagen' => 'imagenes_productos/salsa_soja_kikkoman.jpg',
                    ]);
                    Producto::create([
                        'id' => 20002,
                        'nombre' => 'Salsa Teriyaki japonesa',
                        'precio' => 3.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 60,
                        'imagen' => 'imagenes_productos/salsa_teriyaki.jpg',
                    ]);
                    Producto::create([
                        'id' => 20003,
                        'nombre' => 'Tortillas de maíz mexicanas',
                        'precio' => 1.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 200,
                        'imagen' => 'imagenes_productos/tortillas_maiz_mexicanas.jpg',
                    ]);
                    Producto::create([
                        'id' => 20004,
                        'nombre' => 'Wasabi en pasta',
                        'precio' => 2.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 75,
                        'imagen' => 'imagenes_productos/wasabi_pasta.jpg',
                    ]);
                    Producto::create([
                        'id' => 20005,
                        'nombre' => 'Pasta de curry verde tailandesa',
                        'precio' => 3.20,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 50,
                        'imagen' => 'imagenes_productos/curry_verde_tailandes.jpg',
                    ]);
                    Producto::create([
                        'id' => 20006,
                        'nombre' => 'Arroz jazmín tailandés',
                        'precio' => 2.30,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 120,
                        'imagen' => 'imagenes_productos/arroz_jazmin_tailandes.jpg',
                    ]);
                    Producto::create([
                        'id' => 20007,
                        'nombre' => 'Curry en polvo de la India',
                        'precio' => 1.90,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 90,
                        'imagen' => 'imagenes_productos/curry_india.jpg',
                    ]);
                    Producto::create([
                        'id' => 20008,
                        'nombre' => 'Té verde japonés en hojas',
                        'precio' => 4.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 65,
                        'imagen' => 'imagenes_productos/te_verde_japones.jpg',
                    ]);
                    break;

                case 'Café':
                    Producto::create([
                        'id' => 30001,
                        'nombre' => 'Café molido 100% arábica',
                        'precio' => 5.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 100,
                        'imagen' => 'imagenes_productos/cafe_arabica.jpg',
                    ]);
                    Producto::create([
                        'id' => 30002,
                        'nombre' => 'Café expreso en cápsulas',
                        'precio' => 3.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 150,
                        'imagen' => 'imagenes_productos/cafe_expreso_capsulas.jpg',
                    ]);
                    Producto::create([
                        'id' => 30003,
                        'nombre' => 'Café descafeinado',
                        'precio' => 4.20,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 120,
                        'imagen' => 'imagenes_productos/cafe_descafeinado.jpg',
                    ]);
                    Producto::create([
                        'id' => 30004,
                        'nombre' => 'Café instantáneo soluble',
                        'precio' => 2.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 130,
                        'imagen' => 'imagenes_productos/cafe_instantaneo.jpg',
                    ]);
                    Producto::create([
                        'id' => 30005,
                        'nombre' => 'Café en grano Lavazza',
                        'precio' => 6.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 80,
                        'imagen' => 'imagenes_productos/cafe_grano_lavazza.jpg',
                    ]);
                    Producto::create([
                        'id' => 30006,
                        'nombre' => 'Café de Colombia 100% orgánico',
                        'precio' => 5.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 150,
                        'imagen' => 'imagenes_productos/cafe_colombia_organico.jpg',
                    ]);
                    Producto::create([
                        'id' => 30007,
                        'nombre' => 'Café filtrado gourmet',
                        'precio' => 4.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 100,
                        'imagen' => 'imagenes_productos/cafe_filtrado_gourmet.jpg',
                    ]);
                    Producto::create([
                        'id' => 30008,
                        'nombre' => 'Té verde en bolsitas',
                        'precio' => 3.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 160,
                        'imagen' => 'imagenes_productos/te_verde_bolsitas.jpg',
                    ]);
                    break;

                case 'Bio':
                    Producto::create([
                        'id' => 40001,
                        'nombre' => 'Arroz integral ecológico',
                        'precio' => 3.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 80,
                        'imagen' => 'imagenes_productos/arroz_integral.jpg',
                    ]);
                    Producto::create([
                        'id' => 40002,
                        'nombre' => 'Lentejas ecológicas',
                        'precio' => 2.60,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 100,
                        'imagen' => 'imagenes_productos/lentejas_ecologicas.jpg',
                    ]);
                    Producto::create([
                        'id' => 40003,
                        'nombre' => 'Aceite de oliva virgen extra ecológico',
                        'precio' => 5.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 60,
                        'imagen' => 'imagenes_productos/aceite_oliva_ecologico.jpg',
                    ]);
                    Producto::create([
                        'id' => 40004,
                        'nombre' => 'Leche de almendras sin azúcar',
                        'precio' => 2.40,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 120,
                        'imagen' => 'imagenes_productos/leche_almendras_sin_azucar.jpg',
                    ]);
                    Producto::create([
                        'id' => 40005,
                        'nombre' => 'Pasta de espelta ecológica',
                        'precio' => 3.00,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 150,
                        'imagen' => 'imagenes_productos/pasta_espelta_ecologica.jpg',
                    ]);
                    Producto::create([
                        'id' => 40006,
                        'nombre' => 'Galletas integrales sin azúcar',
                        'precio' => 3.20,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 90,
                        'imagen' => 'imagenes_productos/galletas_integrales_sin_azucar.jpg',
                    ]);
                    Producto::create([
                        'id' => 40007,
                        'nombre' => 'Muesli ecológico sin gluten',
                        'precio' => 4.50,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 75,
                        'imagen' => 'imagenes_productos/muesli_ecologico_sin_gluten.jpg',
                    ]);
                    Producto::create([
                        'id' => 40008,
                        'nombre' => 'Sopa de miso ecológica',
                        'precio' => 3.80,
                        'pasillo_id' => $pasillo->id,
                        'stock' => 60,
                        'imagen' => 'imagenes_productos/sopa_miso_ecologica.jpg',
                    ]);
                    break;

                // Agrega más pasillos según sea necesario
            }
        }
    }
}
