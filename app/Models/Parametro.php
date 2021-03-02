<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    //parametros
    protected $table = 'parametros';
    protected $fillable = ['nombre', 'indice'];
}
