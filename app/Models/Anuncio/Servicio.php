<?php

namespace App\Models\Anuncio;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    //anuncios_servicios
    protected $table = 'anuncios_servicios';
    protected $fillable = [
        'id',
        'anuncio_id',
        'servicio'
    ];
}
