<?php

namespace App\Http\Controllers;

use App\Models\Producto;
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
        $producto = Producto::find($id);
    
        // Si no se encuentra el producto
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    
        // Actualizar el stock del producto
        $producto->stock = $validated['stock'];
    
        // Guardar el producto actualizado
        try {
            $producto->save();
        } catch (\Exception $e) {
            // Capturar cualquier excepción que pueda ocurrir al guardar el producto
            return response()->json(['message' => 'Error al actualizar el stock', 'error' => $e->getMessage()], 500);
        }
    
        // Devolver la respuesta con el stock actualizado
        return response()->json(['message' => 'Stock actualizado', 'stock' => $producto->stock], 200);
    }
    
}
