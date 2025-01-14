<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // recoge todos los usuarios y los roles
        $users = User::with('role')->get();

        return response()->json($users);
    }


    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id', // comprueba que existe el role id
        ]);

        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), 
            'role_id' => $validated['role_id'],
        ]);

        return response()->json($user, 201); 
    }

  
    public function show(string $id)
    {
        // Se busca el usuario por el id y se añade el rol
        $user = User::with('role')->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

 
    public function update(Request $request, string $id)
    {
        
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
            'role_id' => 'sometimes|required|exists:roles,id', 
        ]);

      
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        
        if ($request->has('name')) {
            $user->name = $validated['name'];
        }
        if ($request->has('email')) {
            $user->email = $validated['email'];
        }
        if ($request->has('password')) {
            $user->password = Hash::make($validated['password']); 
        }
        if ($request->has('role_id')) {
            $user->role_id = $validated['role_id'];
        }

        $user->save();

        return response()->json($user);
    }


    public function destroy(string $id)
    {
        
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // borra el usuario
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
