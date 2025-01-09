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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasillo $pasillo)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasillo $pasillo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasillo $pasillo)
    {
        //
    }
}
