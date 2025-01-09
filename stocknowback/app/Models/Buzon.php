<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buzon extends Model
{
    protected $fillable = ['cantidad', 'jefe_id', 'user_id'];
    protected $table = 'buzones';
}
