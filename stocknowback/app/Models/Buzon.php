<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buzon extends Model
{
    protected $fillable = ['cantidad', 'operacion', 'jefe_id', 'user_id', 'producto_id'];
    protected $table = 'buzones'; 

    //Aqui estoy definiendo relaciones con user, jefe y producto para acceder al esos datos dentro de buzon
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


