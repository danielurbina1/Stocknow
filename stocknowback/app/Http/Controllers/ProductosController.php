<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Buzon;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    
    public function restarStock(Request $request, $id)
    {
        // Validar la cantidad a restar
        $validated = $request->validate([
            'cantidad_a_restar' => 'required|integer|min:1', // Aqui aseguramos que haya un minimo de stock
        ]);

        // Buscar el producto por ID
        $producto = Producto::find($id);

    
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Verificamos que no se reste mas del stock que hay 
        if ($producto->stock < $validated['cantidad_a_restar']) {
            return response()->json(['message' => 'Stock insuficiente para restar esa cantidad'], 400);
        }

        // Aqui se resta el stock con la cantidad puesta
        $cantidadRestada = $validated['cantidad_a_restar'];
        $producto->stock -= $cantidadRestada;

        // Se actualiza el producto y se crea el buzon si todo sale bien
        try {
            
            $producto->save();

            // Aqui creamos el buzon 
            Buzon::create([
                'cantidad' => $cantidadRestada,
                'producto_id' => $producto->id,
                'user_id' => $request->user()->id,
                'jefe_id' => $producto->pasillo->user->id, 
            ]);

            // Respuesta de éxito con el stock actualizado y detalles del buzón
            return response()->json([
                'stock' => $producto->stock,
                'buzon' => [
                    'cantidad' => $cantidadRestada,
                    'jefe' => $producto->pasillo->user->name, 
                    'usuario' => $request->user()->name,
                ],
            ], 200);

        } catch (\Exception $e) {
            
            return response()->json([
                'message' => 'Error al restar el stock o registrar en el buzón',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Método para sumar stock
    public function sumarStock(Request $request, $id)
    {
        
        $validated = $request->validate([
            'cantidad_a_sumar' => 'required|integer|min:1', // Asegura que la cantidad es un número entero positivo
        ]);


        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Aqui sumamos en el stock
        $cantidadSumada = $validated['cantidad_a_sumar'];
        $producto->stock += $cantidadSumada;

       
        try {
           
            $producto->save();

            // Crear un registro en el buzón (puedes ajustar este registro según tu necesidad)
            Buzon::create([
                'cantidad' => $cantidadSumada,
                'producto_id' => $producto->id,
                'user_id' => $request->user()->id,
                'jefe_id' => $producto->pasillo->user->id, 
            ]);

            return response()->json([
                'stock' => $producto->stock,
                'buzon' => [
                    'cantidad' => $cantidadSumada,
                    'jefe' => $producto->pasillo->user->name, 
                    'usuario' => $request->user()->name,
                ],
            ], 200);

        } catch (\Exception $e) {
            // En caso de error, devolver el error con un mensaje adecuado
            return response()->json([
                'message' => 'Error al sumar el stock o registrar en el buzón',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

