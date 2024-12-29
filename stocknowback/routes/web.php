<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/crear-usuario', function () {
    User::create([
        'name' => 'Daniel',
        'email' => 'turbinamoreno@gmail.com',
        'password' => bcrypt('1234'),
        'rol' => 'admin',
    ]);

    return 'Usuario creado';
});
