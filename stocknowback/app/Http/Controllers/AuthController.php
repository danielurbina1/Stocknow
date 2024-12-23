<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Manejar el inicio de sesión.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validar los datos del request
        $request->validate([
            'name' => 'required', // Campo obligatorio de tipo email
            'password' => 'required',    // Campo obligatorio
        ]);

        // Buscar al usuario por email
        $user = User::where('name', $request->name)->first();

        // Verificar si el usuario existe
        if (!$user) {
            return response()->json([
                'message' => 'El usuario no existe'
            ], 404); // Código de estado 404: No encontrado
        }

        // Verificar la contraseña
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales inválidas'
            ], 401); // Código de estado 401: No autorizado
        }

        // Generar un token de autenticación (si usas Laravel Sanctum)
        $token = $user->createToken('auth_token')->plainTextToken;

        // Respuesta exitosa con el token y datos del usuario
        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'token' => $token,
            'user' => $user, // Aquí se devuelve el usuario completo
        ]);
    }
}
