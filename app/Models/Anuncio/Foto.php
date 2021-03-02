<?php

namespace App\Models\Anuncio;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    //anuncios_fotos
    protected $table = 'anuncios_fotos';
    protected $fillable = [
        'id',
        'anuncio_id',
        'foto',
        'size'
    ];
}
