<?php

namespace App\Models\Anuncio;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    //tipos
    protected $table = 'tipos';
    protected $fillable = [
        'id',
        'nombre'
    ];
}
