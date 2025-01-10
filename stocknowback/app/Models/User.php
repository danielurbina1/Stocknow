<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // Nombre del usuario
        'email',  // Correo electrónico
        'password', // Contraseña
        'role_id',    // Rol del usuario
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relación con el modelo Role (ya existente)
    public function role(){
        return $this->belongsTo(Role::class);
    }

    // Relación con el modelo Pasillo (ya existente)
    public function pasillo(){
        return $this->belongsTo(Pasillo::class);
    }

    // Relación con los buzones (cuando el usuario es el que realiza la acción)
    public function buzones()
    {
        return $this->hasMany(Buzon::class, 'user_id');
    }

    // Relación con los buzones como jefe (cuando el usuario es jefe de pasillo)
    public function buzonesJefe()
    {
        return $this->hasMany(Buzon::class, 'jefe_id');
    }
}
