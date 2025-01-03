<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Daniel',
            'email' => 'turbinamoreno@gmail.com',
            'password' => Hash::make('1234'),
            'rol' => 'admin',
        ]);

        User::create([
            'name' => 'user1',
            'email' => 'prueba.com',
            'password' => Hash::make('1234'),
            'rol' => 'user',
        ]);
    }
}
