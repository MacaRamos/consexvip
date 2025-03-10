@extends("theme.$theme.layout")
@section('titulo')
Escorts en Concepción
@endsection
@section('tituloContenido')
<span class="text-white border-consex-left font-weight-normal pl-1">Escorts en Concepción</span>
@endsection

{{-- @section('scripts')
<script>
    function verAnuncio(value){
        alert('hola');
    }
    $(function(){
        
    });
</script>
@endsection --}}

@section('contenido')
<div class="row">
    @foreach ($anuncios as $anuncio)
    <div class="col-md-2 mb-3">
        <a href="{{route('anuncios.show', ['anuncio' => $anuncio->id])}}" class="home-anuncio">
            <img src="{{isset($anuncio->fotos) && count($anuncio->fotos) > 0 ? asset('storage/'.$anuncio->fotos[0]->foto) : asset('assets/img/sin-foto-mujer.jpg')}}"
                class="img-fluid" alt="Responsive image">
            <div class="font-weight-bold" style="font-size: 15px; color: #cb4c5b;">{{$anuncio->nombre ?? ''}}</div>
            <div class="text-white" style="font-size: 15px;">{{$anuncio->ubicacion ?? ''}}</div>
            <p class="text-white" style="font-size: 12px;">{{$anuncio->subtitulo ?? ''}}</p>
        </a>
    </div>
    @endforeach
</div>
@endsection