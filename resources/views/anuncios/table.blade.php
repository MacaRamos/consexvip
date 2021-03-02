<div class="card-body table-responsive p-0">
    <table class="table table-condensed" id="tabla-data">
        <thead class="border-bottom-3 border-black">
            <tr>
                <th style="white-space: pre !important;">ID</th>
                <th style="white-space: pre !important;">Nombre</th>
                <th style="white-space: pre !important;">Tipo anuncio</th>
                <th style="white-space: pre !important;">Activo</th>
                <th style="white-space: pre !important;">Fecha activo</th>
                <th style="width: 100px"></th>
            </tr>
        </thead>
        <tbody class="border-bottom">
            @foreach ($anuncios as $anuncio)
            <tr>
                <td>{{$anuncio->id ?? ''}}</td>
                <td>{{$anuncio->nombre ?? ''}}</td>
                <td>{{$anuncio->tipo->nombre ?? ''}}</td>
                <td>{{$anuncio->activo ?? ''}}</td>
                <td>{{isset($anuncio->fecha_activo) ? date('d-m-Y H:i:s', strtotime($anuncio->fecha_activo)) : ''}}</td>
                <td>
                    <a href="{{route('anuncios.edit', ['anuncio' => $anuncio->id])}}"
                        class="btn bg-gray btn-xs rounded mr-2" style="width: 24px; height: 24px;">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{route('anuncios.destroy', ['anuncio' => $anuncio->id])}}"
                        class="d-inline form-eliminar" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-xs rounded desactivar"
                            style="width: 24px; height: 24px;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>