@extends("theme.$theme.layout")
@section('titulo')
{{ $anuncio->nombre ?? '' }} - {{ $anuncio->descripcion }}
@endsection

@section('header')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css" />
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
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
                    <button type="button" class="btn bg-dark btn-sm text-white">{{ $servicio->servicio ?? '' }}</button>
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
                <p class="card-title font-weight-bolder float-none" style="color: #ff4646;">Galeria de
                    {{$anuncio->nombre ?? ''}}</p>
                <small>Fotografías sin retoque</small>
            </div>
            <div class="card-body">
                <div class="row imglist">
                    @if (isset($anuncio->fotos) && count($anuncio->fotos) > 0)
                    @foreach ($anuncio->fotos as $key => $foto)
                    <a href="{{asset('storage/'.$foto->foto)}}" data-fancybox="images"
                        data-caption="Backpackers following a dirt trail">
                        <img src="{{asset('storage/'.$foto->foto)}}" class="gallery-image img-fluid img-thumbnail gallery-image" />
                    </a>
                    @endforeach
                    @endif
                    {{-- @if (isset($anuncio->fotos) && count($anuncio->fotos) > 0)
                    @foreach ($anuncio->fotos as $key => $foto)
                    <a class="col-md-3 col-lg-4 col-4 gallery-item {{$key != 0 && intval($key/3) == 1 ? 'mt-4' : ''}}"
                    data-fancybox="images" href="{{asset('storage/'.$foto->foto)}}">
                    <div class="gallery-image" style="background-image: url('{{asset('storage/'.$foto->foto)}}'); ">
                    </div>
                    </a>
                    @endforeach
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection