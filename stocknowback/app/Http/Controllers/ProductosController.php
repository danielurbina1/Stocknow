<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Buzon;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function updateStock(Request $request, $id)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'stock' => 'required|integer|min:0', // Verificar que el stock sea un número entero no negativo
        ]);

        // Buscar el producto por ID
        $producto = Producto::find($id); // Cargar relaciones necesarias

        // Si no se encuentra el producto
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Obtener el usuario logeado
        $loggedUser = $request->user(); // Usuario que realiza la petición

        // Obtener el jefe del pasillo asociado al producto
        $jefePasillo = $producto->pasillo->user ?? null;

        if (!$jefePasillo) {
            return response()->json(['message' => 'El pasillo no tiene un jefe asignado'], 400);
        }

        // Calcular la cantidad de stock modificado
        $cantidadModificada = $producto->stock - $validated['stock'];

        // Actualizar el stock del producto
        $producto->stock = $validated['stock'];

        try {
            // Guardar el producto actualizado
            $producto->save();

            // Crear un registro en la tabla "buzones"
            Buzon::create([
                'cantidad' => $cantidadModificada,
                'jefe_id' => $jefePasillo->id,
                'user_id' => $loggedUser->id,
            ]);
        } catch (\Exception $e) {
            // Capturar cualquier excepción que pueda ocurrir
            return response()->json(['message' => 'Error al actualizar el stock o registrar en el buzón', 'error' => $e->getMessage()], 500);
        }

        // Devolver la respuesta con el stock actualizado
        return response()->json([
            'message' => 'Stock actualizado',
            'stock' => $producto->stock,
            'buzon' => [
                'cantidad' => $cantidadModificada,
                'jefe' => $jefePasillo->name,
                'usuario' => $loggedUser->name,
            ],
        ], 200);
    }
}
