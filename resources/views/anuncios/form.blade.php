<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="requerido font-weight-normal">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre"
                value="{{old('nombre', $anuncio->nombre ?? '')}}" maxlength="100" required>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group float-right">
            <input type="checkbox" name="activo" id="activo" data-onstyle="success" data-toggle="toggle"
                data-on="Activo" data-off="Inactivo" checked>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="font-weight-normal">Subtitulo</label>
            <input type="text" class="form-control" name="subtitulo" id="subtitulo"
                value="{{old('subtitulo', $anuncio->subtitulo ?? '')}}" maxlength="100">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="requerido font-weight-normal">Descripción</label>
            <textarea class="form-control" rows="3" name="descripcion" id="descripcion" maxlength="5000" minlength="0"
                required>{{old('descripcion', isset($anuncio) ? $anuncio->descripcion : '')}}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="requerido font-weight-normal">Ubicación</label>
            <input type="text" class="form-control" name="ubicacion" id="ubicacion"
                value="{{old('ubicacion', $anuncio->ubicacion ?? '')}}" maxlength="250" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="requerido font-weight-normal">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono"
                value="{{old('telefono', $anuncio->telefono ?? '')}}" maxlength="15" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="font-weight-normal">Whatsapp</label>
            <input type="text" class="form-control" name="whatsapp" id="whatsapp"
                value="{{old('whatsapp', $anuncio->whatsapp ?? '')}}" maxlength="15">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="font-weight-normal">Precio hora</label>
            <input type="text" class="form-control" name="precio_hora" id="precio_hora"
                value="{{old('precio_hora', $anuncio->precio_hora ?? '')}}" maxlength="13">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <label class="font-weight-normal">Horario</label>
    </div>
    <div class="col-md-1">
        <div class="form-group">
            <input type="text" class="form-control" name="horario_inicio" id="horario_inicio"
                value="{{old('horario_inicio', $anuncio->horario_inicio ?? '')}}" maxlength="11">
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group">
            <input type="text" class="form-control" name="horario_fin" id="horario_fin"
                value="{{old('horario_fin', $anuncio->horario_fin ?? '')}}" maxlength="11">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="requerido font-weight-normal">Tipo anuncio</label>
            <select class="form-control" name="tipo_id" id="tipo_id" {{isset($anuncio) && $anuncio->activo ? 'disabled' : 'required'}}
                {{isset($anuncio) && $anuncio->activo ? 'title="El aviso esta activo y vigente, no puede cambiar su tipo" data-toggle="tooltip" data-placement="top"' : ''}}>
                <option value="">Seleccione...</option>
                @foreach ($tipos as $tipo)
                <option value="{{$tipo->id}}" {{isset($anuncio) && $anuncio->tipo_id == $tipo->id ? 'selected' : ''}}
                    {{ (old("tipo_id") == $tipo->id ? "selected":"") }}>{{$tipo->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="font-weight-normal">Servicios</label>
            <input type="text" class="form-control" name="servicios" id="servicios"
                title="Separe por comas ',' cada valor." data-toggle="tooltip" data-placement="top"
                placeholder="Ingrese uno o mas valores" value="{{old('servicios', isset($anuncio) && count($anuncio->servicios) ? implode(', ', array_column($anuncio->servicios->toArray(), 'servicio')) : '')}}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="font-weight-normal">Etiquetas</label>
            <input type="text" class="form-control" name="etiquetas" id="etiquetas"
                title="Separe por comas ',' cada valor." data-toggle="tooltip" data-placement="top"
                placeholder="Ingrese uno o mas valores" value="{{old('etiquetas', isset($anuncio) && count($anuncio->etiquetas) ? implode(', ', array_column($anuncio->etiquetas->toArray(), 'etiqueta')) : '')}}">
        </div>
    </div>
</div>


<div class="row mt-3">
    <div class="col-md-12">
        <div id="subirFotos" class="dropzone bg-transparent border-consex">
            <div class="dz-message text-center" data-dz-message>
                @if (!isset($anuncio) || count($anuncio->fotos) == 0)
                <i class="fas fa-images"></i><span> Agregar Fotos</span>
                @endif
            </div>
        </div>
    </div>
</div>
@if (isset($anuncio) && count($anuncio->fotos) > 0)
@foreach ($anuncio->fotos as $foto)
<input type="hidden" name="fotos[]" value="{{$foto->foto}}">
<input type="hidden" name="sizes[]" value="{{$foto->size ?? 0}}">
@endforeach
@endif