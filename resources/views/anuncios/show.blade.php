@extends("theme.$theme.layout")
@section('titulo')
    {{ $anuncio->nombre ?? '' }} - {{ $anuncio->descripcion }}
@endsection

@section('header')
<link rel="stylesheet" href="http://fancyapps.com/fancybox/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
<link rel="stylesheet" href="http://fancyapps.com/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />    
<link rel="stylesheet" href="http://fancyapps.com/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />

@endsection

@section('scripts')
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="http://fancyapps.com/fancybox/source/jquery.fancybox.pack.js?v=2.1.7"></script>

<script type="text/javascript" src="http://fancyapps.com/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="http://fancyapps.com/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript" src="http://fancyapps.com/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<script>
    $(document).ready(function() {
        $(".fancybox-button").fancybox({
            prevEffect		: 'none',
            nextEffect		: 'none',
            closeBtn		: false,
            helpers		: {
                title	: { type : 'inside' },
                buttons	: {}
            }
        });
    });
</script>    
@endsection

@section('contenido')
    <div class="row">
        <div class="col-md-4 mx-auto">
            <!-- Profile Image -->
            <div class="card bg-transparent shadow-none">
                <div class="card-body box-profile mx-auto">
                    <div class="text-center img-circle elevation-2 shadow-lg mx-auto">
                        <img width="100%" src="{{ asset('storage/' . $anuncio->fotos[0]->foto) }}"
                            data-holder-rendered="true">
                    </div>

                    <h3 class="profile-username text-center text-white">{{ $anuncio->nombre ?? '' }}</h3>

                    <p class="text-muted text-center text-white">"{{ $anuncio->subtitulo ?? '' }}"</p>

                    <p>
                        <a href="{{ isset($anuncio->whatsapp) ? 'https://api.whatsapp.com/send/?phone=' . $anuncio->whatsapp . '&text=Hola ' . $anuncio->nombre . ' ví tu aviso y me interesa saber más' : '#' }}"
                            class="text-white text-sm btn btn-success mr-2"><i class="fab fa-whatsapp"></i></i>
                            Consultas</a>
                        <a href="tel:+{{ $anuncio->telefono ?? '' }}" class="text-white text-sm btn btn-consex"><i
                                class="fas fa-mobile-alt"></i> +{{ $anuncio->telefono ?? '' }}</a>
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-md-4" style="height: auto;">
            <!-- About Me Box -->
            <div class="card bg-dark">
                <div class="card-header">
                    <h3 class="card-title">Datos e información</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-tags  mr-1"></i> Atributos</strong>
                    <p class="text-muted">
                        @if (isset($anuncio->etiquetas) && count($anuncio->etiquetas) > 0)
                            @foreach ($anuncio->etiquetas as $etiqueta)
                                <button type="button"
                                    class="btn bg-consex-dark btn-sm text-white">{{ $etiqueta->etiqueta ?? '' }}</button>
                            @endforeach
                        @endif
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Ubicación</strong>

                    <p class="text-muted">{{ $anuncio->ubicacion ?? '' }}</p>

                    <hr>

                    <strong><i class="far fa-clock mr-1"></i> Horario</strong>

                    <p class="text-muted">{{ $anuncio->horario_inicio ?? '' }} - {{ $anuncio->horario_fin ?? '' }}</p>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-8" style="height: 100%;">
            <div class="card bg-transparent">
                <div class="card-body">
                    <h5 class="text-white text-bold">{{ $anuncio->nombre ?? '' }}</h5>
                    <p class="text-white">
                        {!! nl2br($anuncio->descripcion) ?? '' !!}
                    </p>

                    <h5 class="text-white text-bold">Servicios</h5>
                    <p class="text-muted">
                        @if (isset($anuncio->servicios) && count($anuncio->servicios) > 0)
                            @foreach ($anuncio->servicios as $servicio)
                                <button type="button"
                                    class="btn bg-navy btn-sm text-white">{{ $servicio->servicio ?? '' }}</button>
                            @endforeach
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-dark">
                <div class="card-header">
                    <h5 class="card-title text-bold" style="color: #ff4646;">Galeria</h5>
                </div>
                <div class="card-body">
                    @if (isset($anuncio->fotos) && count($anuncio->fotos) > 0)
                        @foreach ($anuncio->fotos as $foto)
                            <a class="col-md-3 col-lg-4 col-4" data-fancybox="gallery"
                                href="{{asset('storage/'.$foto->foto)}}"
                                title="{{$foto->foto}}">
                                @php
                                    $url = "storage/'.$foto->foto";
                                @endphp
                                <div class="gallery-image lazy" style="background-image: url('storage/'.{{$foto->foto}});"></div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
