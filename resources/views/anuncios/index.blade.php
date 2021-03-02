@extends("theme.$theme.layout")
@section('titulo')
Anuncios
@endsection
@section('tituloContenido')
<span class="text-white">Anuncios</span>
@endsection

@section("header")
<link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">
@endsection

@section("scripts")
<script type="text/javascript" src="{{asset("assets/pages/scripts/admin/index.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/$theme/plugins/datatables/jquery.dataTables.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/$theme/plugins/datatables-bs4/js/dataTables.bootstrap4.js")}}">
</script>
@include('includes.mensaje')
@include('includes.error-form')
<script>
  $(function(){
    $("#tabla-data").DataTable(
      {
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        pageLength: 20,
        lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "Todos"]]
      }
    );
    
});
</script>
@endsection

@section('contenido')
<div class="card bg-dark">
  <div class="card-header with-border border-consex">
    <h4 class="card-title text-white">Anuncios</h4>
    <div class="card-tools pull-right">
      <a href="{{route('anuncios.create')}}" class="btn btn-block bg-vina text-white btn-sm">
        <i class="fas fa-plus-circle"></i> Nuevo
      </a>
    </div>
  </div>
  <div class="card-body">
    @include('anuncios.table')
  </div>
</div>
@endsection