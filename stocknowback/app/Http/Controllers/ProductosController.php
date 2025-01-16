<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Buzon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\StockMinimoAlcanzado;
use App\Models\Role;
use App\Models\User;

class ProductosController extends Controller
{
    
    private function getJefes()
{
    // Obtener el rol 'jefe'
    $jefeRole = Role::where('name', 'Jefe')->first();



    // Obtener todos los usuarios que tengan el rol "jefe"
    $usuariosConRolJefe = User::with('role')
                                ->where('role_id', $jefeRole->id)
                                ->get();

    return $usuariosConRolJefe;
}
public function restarStock(Request $request, $id)
{
    // Validar la cantidad a restar
    $validated = $request->validate([
        'cantidad_a_restar' => 'required|integer|min:1', // Asegura que haya un mínimo de stock
    ]);

    // Buscar el producto por ID
    $producto = Producto::find($id);

    if (!$producto) {
        return response()->json(['message' => 'Producto no encontrado'], 404);
    }

    // Verificamos que no se reste más del stock que hay
    if ($producto->stock < $validated['cantidad_a_restar']) {
        return response()->json(['message' => 'Stock insuficiente para restar esa cantidad'], 400);
    }

    // Restar el stock con la cantidad puesta
    $cantidadRestada = $validated['cantidad_a_restar'];
    $producto->stock -= $cantidadRestada;

    // Se actualiza el producto y se crea el buzón si todo sale bien
    try {
        $producto->save();

        // Crear el buzón
        Buzon::create([
            'cantidad' => $cantidadRestada,
            'operacion' => 'resta', 
            'producto_id' => $producto->id,
            'user_id' => $request->user()->id,
            'jefe_id' => $producto->pasillo->user->id,
        ]);

        // Verificar si el stock ha alcanzado el mínimo
        if ($producto->stock <= $producto->stock_minimo) {
            // Obtener los jefes y enviar el correo a cada uno
            $jefes = $this->getJefes();
            foreach ($jefes as $jefe) {
                // Enviar correo al jefe
                Mail::to($jefe->email)->send(new StockMinimoAlcanzado($producto, $jefe));
            }
        }

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
                'operacion' => 'suma', 
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

