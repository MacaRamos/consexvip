{{-- {{dd(session()->all())}} --}}
<script>
  var mensaje = @json(session()->get('mensaje') ?? $notificacion['mensaje'] ?? '');
  var tipo = @json(session()->get('tipo') ?? $notificacion['tipo'] ?? '');
  var titulo = @json(session()->get('titulo') ?? $notificacion['titulo'] ?? '');
  if(mensaje){
    toastr.options = {
      closeButton: true,
      newestOnTop: true,
      positionClass: 'toast-top-right',
      preventDuplicates: true,
      timeOut: '5000'
    };
    if (tipo == 'error') {
        toastr.error(mensaje, titulo);
    } else if (tipo == 'success') {
        toastr.success(mensaje, titulo);
    } else if (tipo == 'info') {
        toastr.info(mensaje, titulo);
    } else if (tipo == 'warning') {
        toastr.warning(mensaje, titulo);
    }
  }
  
  
</script>