<?php

namespace App\Http\Controllers;

use App\Models\Pasillo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasilloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cargar pasillos con productos y el jefe de pasillo (usuario)
        $pasillos = Pasillo::with(['productos', 'user'])->get();

        // Devolver la respuesta en formato JSON
        return response()->json($pasillos);
    }

    
}
