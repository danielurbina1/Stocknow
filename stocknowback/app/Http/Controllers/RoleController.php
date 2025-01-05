<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Muestra todos los roles.
     */
    public function index()
    {
        return response()->json(Role::all(), 200);
    }

    /**
     * Almacena un nuevo rol.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles,name|max:255',
        ]);

        $role = Role::create($validated);

        return response()->json($role, 201);
    }

    /**
     * Muestra un rol específico.
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        return response()->json($role, 200);
    }

    /**
     * Actualiza un rol.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id . '|max:255',
        ]);

        $role->update($validated);

        return response()->json($role, 200);
    }

    /**
     * Elimina un rol.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        return response()->json(['message' => 'Rol eliminado'], 200);
    }
}
