<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Jefe de pasillo'],
            ['name' => 'Jefe'],
            ['name' => 'Rotativo'],
        ];

        foreach ($roles as $roleData) {
            Role::create($roleData);
        }

        // Crear usuarios con roles específicos
        $adminRole = Role::where('name', 'Admin')->first();
        $jefePasilloRole = Role::where('name', 'Jefe de pasillo')->first();
        $jefeRole = Role::where('name', 'Jefe')->first();
        $rotativoRole = Role::where('name', 'Rotativo')->first();

        

        User::create([
            'name' => 'Jefe Pasillo pasta',
            'email' => 'jefepasilloP@gmail.com',
            'password' => Hash::make('1234'),
            'role_id' => $jefePasilloRole->id,
        ]);
        User::create([
            'name' => 'Jefe Pasillo Internacional',
            'email' => 'jefepasilloI@gmail.com',
            'password' => Hash::make('1234'),
            'role_id' => $jefePasilloRole->id,
        ]);
        User::create([
            'name' => 'Jefe Pasillo Cafe',
            'email' => 'jefepasilloC@gmail.com',
            'password' => Hash::make('1234'),
            'role_id' => $jefePasilloRole->id,
        ]);
        User::create([
            'name' => 'Jefe Pasillo Bio',
            'email' => 'jefepasilloB@gmail.com',
            'password' => Hash::make('1234'),
            'role_id' => $jefePasilloRole->id,
        ]);
        User::create([
            'name' => 'Jefe Pasillo Pan',
            'email' => 'jefepasilloPan@gmail.com',
            'password' => Hash::make('1234'),
            'role_id' => $jefePasilloRole->id,
        ]);
        User::create([
            'name' => 'Jefe Pasillo Conservas',
            'email' => 'jefepasilloCon@gmail.com',
            'password' => Hash::make('1234'),
            'role_id' => $jefePasilloRole->id,
        ]);
        User::create([
            'name' => 'Jefe Pasillo Salsas',
            'email' => 'jefepasilloS@gmail.com',
            'password' => Hash::make('1234'),
            'role_id' => $jefePasilloRole->id,
        ]);
        User::create([
            'name' => 'Jefe Pasillo Bolleria',
            'email' => 'jefepasilloBolleria@gmail.com',
            'password' => Hash::make('1234'),
            'role_id' => $jefePasilloRole->id,
        ]);
        

        User::create([
            'name' => 'Jefe General',
            'email' => 'proyectojefe5@gmail.com',
            'password' => Hash::make('1234'),
            'role_id' => $jefeRole->id,
        ]);

        User::create([
            'name' => 'Rotativo',
            'email' => 'rotativo@gmail.com',
            'password' => Hash::make('1234'),
            'role_id' => $rotativoRole->id,
        ]);
        User::create([
            'name' => 'Daniel',
            'email' => 'turbinamoreno@gmail.com',
            'password' => Hash::make('1234'),
            'role_id' => $adminRole->id,
        ]);
    }
}
