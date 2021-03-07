<?php

namespace App\Models\Anuncio;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    //anuncios
    protected $table = 'anuncios';
    protected $fillable = [
        'id',
        'usuario_id',
        'tipo_id',
        'nombre',
        'subtitulo',
        'descripcion',
        'ubicacion',
        'telefono',
        'whatsapp',
        'precio_hora',
        'horario_inicio',
        'horario_fin',
        'activo',
        'fecha_activo',
        'pausado',
        'fecha_pausado',
        'bajadas'
    ];

    public function fotos(){
        return $this->hasMany(Foto::class, 'anuncio_id', 'id');
    }

    public function tipo(){
        return $this->hasOne(Tipo::class, 'id', 'tipo_id');
    }

    public function etiquetas(){
        return $this->hasMany(Etiqueta::class, 'anuncio_id', 'id');
    }

    public function servicios(){
        return $this->hasMany(Servicio::class, 'anuncio_id', 'id');
    }
}
