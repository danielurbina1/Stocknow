<?php

namespace App\Http\Controllers;

use App\Models\Buzon;

class BuzonController extends Controller
{
    public function index()
    {
        $buzon = Buzon::with(['producto', 'jefe', 'user'])->get();
        return response()->json($buzon);
    }
}
