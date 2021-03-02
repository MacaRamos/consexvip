@extends("theme.$theme.layout")
@section('titulo')
Escorts en Concepción
@endsection
@section('tituloContenido')
<span class="text-white border-consex-left font-weight-normal pl-1">Escorts en Concepción</span>
@endsection

@section('contenido')
<div class="row">
    @foreach ($anuncios as $anuncio)
    <div class="col-md-3 mb-3">
        <img src="{{isset($anuncio->fotos) && count($anuncio->fotos) > 0 ? asset('storage/'.$anuncio->fotos[0]->foto) : asset('assets/img/sin-foto-mujer.jpg')}}"
            class="img-fluid" alt="Responsive image">
        <div class="font-weight-bold" style="font-size: 15px; color: #cb4c5b;">{{$anuncio->nombre}}</div>
        <div class="text-white">{{$anuncio->ubicacion}}</div>
        <div class="text-white">
            @if (isset($anuncio->etiquetas) && count($anuncio->etiquetas) > 0)
            @foreach ($anuncio->etiquetas as $etiqueta)
            @if($loop->last)
            {{$etiqueta->etiqueta}}
            @else
            {{$etiqueta->etiqueta}},
            @endif
            @endforeach
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection