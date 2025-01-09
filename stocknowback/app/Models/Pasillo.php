<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasillo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'user_id'];

    // Relación: un pasillo tiene muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
