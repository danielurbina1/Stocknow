<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    /**
     * Almacenar un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {


        // Procesar y almacenar la imagen si fue enviada
        $imagePath = null;

        if ($request->hasFile('imagen')) {
            // Guardar la imagen en el almacenamiento público en la carpeta 'imagenes_productos'

            $imagePath = $request->file('imagen')->store('imagenes_productos', 'public');
        }

        // Crear el producto en la base de datos
        $producto =  Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'pasillo_id' => $request->pasillo_id,
            'stock' => $request->stock,
            'imagen' => $imagePath, // Guardar la ruta de la imagen
        ]);
        // Redirigir con un mensaje de éxito

        return response()->json(array('success' => true));
    }
    /**
     * Actualizar un producto en la base de datos.
     */
    public function update(Request $request, Producto $productos)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'pasillo_id' => 'required|exists:pasillos,id',
            'stock' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Procesar la imagen si se envía una nueva
        $imagePath = $productos->imagen; // Mantener la imagen actual si no se sube una nueva
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen antigua si existe
            if ($productos->imagen) {
                Storage::disk('public')->delete($productos->imagen);
            }

            // Guardar la nueva imagen
            $imagePath = $request->file('imagen')->store('imagenes_productos', 'public');
        }

        // Actualizar los datos del producto
        $productos->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'pasillo_id' => $request->pasillo_id,
            'stock' => $request->stock,
            'imagen' => $imagePath, // Actualizar la imagen
        ]);

        // Redirigir con un mensaje de éxito
        //  return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Eliminar un producto de la base de datos.
     */
    public function destroy(Producto $productos)
    {
        // Eliminar la imagen asociada al producto
        if ($productos->imagen) {
            Storage::disk('public')->delete($productos->imagen);
        }

        // Eliminar el producto
        $productos->delete();

        // return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
