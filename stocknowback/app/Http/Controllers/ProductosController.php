<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Buzon;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    // Método para restar stock
    public function restarStock(Request $request, $id)
    {
        // Validar la cantidad a restar
        $validated = $request->validate([
            'cantidad_a_restar' => 'required|integer|min:1', // Asegura que la cantidad es un número entero positivo
        ]);

        // Buscar el producto por ID
        $producto = Producto::find($id);

        // Si no se encuentra el producto
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Verificar que no se reste más de lo que hay en stock
        if ($producto->stock < $validated['cantidad_a_restar']) {
            return response()->json(['message' => 'Stock insuficiente para restar esa cantidad'], 400);
        }

        // Restar la cantidad del stock
        $cantidadRestada = $validated['cantidad_a_restar'];
        $producto->stock -= $cantidadRestada;

        // Intentar realizar la actualización del producto y la creación del registro en el buzón
        try {
            // Guardar el producto actualizado
            $producto->save();

            // Crear un registro en el buzón
            Buzon::create([
                'cantidad' => $cantidadRestada,
                'producto_id' => $producto->id,
                'user_id' => $request->user()->id,
                'jefe_id' => $producto->pasillo->user->id, // Suponiendo que cada pasillo tiene un jefe
            ]);

            // Respuesta de éxito con el stock actualizado y detalles del buzón
            return response()->json([
                'message' => 'Stock restado con éxito',
                'stock' => $producto->stock,
                'buzon' => [
                    'cantidad' => $cantidadRestada,
                    'jefe' => $producto->pasillo->user->name, // Asegúrese de que el jefe esté disponible
                    'usuario' => $request->user()->name,
                ],
            ], 200);

        } catch (\Exception $e) {
            // En caso de error, devolver el error con un mensaje adecuado
            return response()->json([
                'message' => 'Error al restar el stock o registrar en el buzón',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Método para sumar stock
    public function sumarStock(Request $request, $id)
    {
        // Validar la cantidad a sumar
        $validated = $request->validate([
            'cantidad_a_sumar' => 'required|integer|min:1', // Asegura que la cantidad es un número entero positivo
        ]);

        // Buscar el producto por ID
        $producto = Producto::find($id);

        // Si no se encuentra el producto
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Sumar la cantidad al stock
        $cantidadSumada = $validated['cantidad_a_sumar'];
        $producto->stock += $cantidadSumada;

        // Intentar realizar la actualización del producto y la creación del registro en el buzón
        try {
            // Guardar el producto actualizado
            $producto->save();

            // Crear un registro en el buzón (puedes ajustar este registro según tu necesidad)
            Buzon::create([
                'cantidad' => $cantidadSumada,
                'producto_id' => $producto->id,
                'user_id' => $request->user()->id,
                'jefe_id' => $producto->pasillo->user->id, // Suponiendo que cada pasillo tiene un jefe
            ]);

            // Respuesta de éxito con el stock actualizado y detalles del buzón
            return response()->json([
                'message' => 'Stock sumado con éxito',
                'stock' => $producto->stock,
                'buzon' => [
                    'cantidad' => $cantidadSumada,
                    'jefe' => $producto->pasillo->user->name, // Asegúrese de que el jefe esté disponible
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

