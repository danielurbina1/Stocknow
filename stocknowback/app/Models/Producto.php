<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Definir la tabla que se utilizará
    protected $table = 'productos';

    // Definir los campos que se pueden asignar de manera masiva
    protected $fillable = [
        'nombre',
        'precio',
        'pasillo_id',
        'stock', // Añadir stock
        'stock_minimo',
        'imagen',
    ];

    /**
     * Obtener el pasillo al que pertenece el producto.
     */
    public function pasillo()
    {
        return $this->belongsTo(Pasillo::class);
    }
    public function buzones()
    {
        return $this->hasMany(Buzon::class, 'producto_id');
    }
}
