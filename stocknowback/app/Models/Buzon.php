<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buzon extends Model
{
    protected $fillable = ['cantidad', 'jefe_id', 'user_id', 'producto_id'];
    protected $table = 'buzones'; // Asegúrate de que el nombre de la tabla sea 'buzones'

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jefe()
    {
        return $this->belongsTo(User::class, 'jefe_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}


