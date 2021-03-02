<?php

namespace App\Models\Anuncio;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    //anuncios_etiquetas
    protected $table = 'anuncios_etiquetas';
    protected $fillable = [
        'id',
        'anuncio_id',
        'etiqueta'
    ];
}
