@extends("theme.$theme.layout")
@section('titulo')
{{$anuncio->nombre ?? ''}} - {{$anuncio->descripcion}}
@endsection
@section('contenido')
<div class="row">
    <div class="col-md-4 mx-auto">
        <!-- Profile Image -->
        <div class="card bg-transparent card-outline">
            <div class="card-body box-profile mx-auto">
                <div class="text-center img-circle elevation-2 shadow-lg mx-auto">
                    <img width="100%" src="{{asset('storage/'.$anuncio->fotos[0]->foto)}}" data-holder-rendered="true">
                </div>

                <h3 class="profile-username text-center text-white">{{$anuncio->nombre ?? ''}}</h3>

                <p class="text-muted text-center text-white">"{{$anuncio->subtitulo ?? ''}}"</p>

                <p>
                    <a href="https://api.whatsapp.com/send?phone=+56936914443&text=Hola,%20Sabrina%20vi%20tu%20aviso%20%20y%20me%20interesa%20saber%20mas"
                        class="text-white text-sm btn btn-success mr-2"><i class="fab fa-whatsapp"></i></i>
                        Consultas</a>
                    <a href="tel:+{{$anuncio->telefono ?? ''}}" class="text-white text-sm btn btn-consex"><i
                            class="fas fa-mobile-alt"></i> +{{$anuncio->telefono ?? ''}}</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<div class="row">
    <div class="col-md-4">
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
                    <button type="button" class="btn bg-consex-dark btn-sm text-white">{{$etiqueta->etiqueta ?? ''}}</button>
                    @endforeach
                    @endif
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Ubicación</strong>

                <p class="text-muted">{{$anuncio->ubicacion ?? ''}}</p>

                <hr>

                <strong><i class="far fa-clock mr-1"></i> Skills</strong>

                <p class="text-muted">
                    <span class="tag tag-danger">UI Design</span>
                    <span class="tag tag-success">Coding</span>
                    <span class="tag tag-info">Javascript</span>
                    <span class="tag tag-warning">PHP</span>
                    <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim
                    neque.</p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-8">
        <div class="card bg-transparent">
            <h1>Hola</h1>
        </div>
    </div>
</div>
@endsection