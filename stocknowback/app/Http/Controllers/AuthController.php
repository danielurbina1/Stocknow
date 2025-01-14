<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        // Validación de los campos del request
        $request->validate([
            'email' => 'required|email',  
            'password' => 'required',     
        ]);
    
        // Buscar al usuario por email
        $user = User::with('role')->where('email', $request->email)->first();
    
        
        if (!$user) {
            return response()->json([
                'message' => 'El usuario no existe'
            ], 404);
        }
    
        // Verificar si la contraseña es correcta
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales inválidas'
            ], 401);
        }
    
        
        $token = $user->createToken('auth_token')->plainTextToken;
    
        // Retornar respuesta con el token y datos del usuario
        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        // Eliminar el token de acceso del usuario
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente.']);
    }
}
