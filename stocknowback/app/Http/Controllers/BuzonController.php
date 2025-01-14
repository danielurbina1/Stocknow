<?php

namespace App\Http\Controllers;
use App\Models\Buzon;
use Illuminate\Support\Facades\Auth;
class BuzonController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $buzon = Buzon::with(['producto', 'jefe', 'user'])->where("jefe_id", $user->id)->get(); // se obtiene los buzones del id del jefe que tiene que coincidir con el usuario autenticado
        return response()->json($buzon);

        
    }
}
