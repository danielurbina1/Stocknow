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
            'email' => 'required|email',  // Validar que el campo sea un email válido
            'password' => 'required',     // Campo obligatorio
        ]);
    
        // Buscar al usuario por email
        $user = User::with('role')->where('email', $request->email)->first();    
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
    public function logout(Request $request)
    {
        // Elimina el token de acceso del usuario autenticado
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente.']);
    }
}
