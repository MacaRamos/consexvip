@extends("theme.$theme.layout")
@section('titulo')
Editar Anuncio
@endsection
@section('tituloContenido')
<span class="text-white border-consex-left font-weight-normal pl-1">Editar Anuncio</span>
@endsection

@section("header")
<!-- Select2 -->
<link rel="stylesheet" href="{{asset("assets/$theme/plugins/select2/css/select2.min.css")}}">
<link rel="stylesheet" href="{{asset("assets/$theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" rel="stylesheet" />
<!-- dropzonejs -->
<link rel="stylesheet" href="{{asset("assets/$theme/plugins/dropzone/min/dropzone.min.css")}}">
<!-- bootstrap-toggle -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section("scripts")
<!-- InputMask -->
<script src="{{asset("assets/$theme/plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("assets/$theme/plugins/inputmask/min/jquery.inputmask.bundle.min.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<!-- dropzonejs -->
<script src="{{asset("assets/$theme/plugins/dropzone/min/dropzone.min.js")}}"></script>
<!-- bootstrap-toggle -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@include('includes.mensaje')
@include('includes.error-form')
<script>
    Dropzone.autoDiscover = false;
    $(function(){
        
        $('#etiquetas').tooltip('enable');
        var fotos = $('input[name^="fotos"]').map(function(){
            if($(this).val() != ''){
                return $(this).val();
            }
        }).get();
        var sizes = $('input[name^="sizes"]').map(function(){
            if($(this).val() != ''){
                return $(this).val();
            }
        }).get();

        if(@json(old('fotos'))){
            var fotos = @json(old('fotos'));
            var sizes = @json(old('sizes'));
            fotos.forEach(function(item, index) {
                $('#form-general').append('<input type="hidden" name="fotos[]" value="'+item+'">')
                $('#form-general').append('<input type="hidden" name="sizes[]" value="'+sizes[index]+'">')
            });
        }       

        $('#telefono, #whatsapp').inputmask('(+56) 999999999');
        $('#precio_hora').inputmask('numeric', {
            prefix: '$ ',
            groupSeparator: '.',
            autoGroup: true,
            digits: 0,
            radixPoint: ",",
            digitsOptional: false,
            allowMinus: false,
            rightAlign: false
            }
        );

        $('#horario_inicio').datetimepicker({
            format: 'H:i',
            // value: '00:00',
            onShow:function( ct ){
                this.setOptions({
                    minTime:$('#horario_fin').val()?$('#horario_fin').val():false
                })
            },
            datepicker: false,
        });

        $('#horario_fin').datetimepicker({
            format: 'H:i',
            onShow:function( ct ){
                this.setOptions({
                    minTime:$('#horario_inicio').val()?$('#horario_inicio').val():false
                })
            },
            datepicker: false,
        });
        
        // DropzoneJS Demo Code Start
        var dataUrl = "{{route('subirFotos')}}"; 
        $("#subirFotos").dropzone({
            url: dataUrl,
            autoQueue: true,
            addRemoveLinks: true,
            maxFiles: 6,
            parallelUploads: 2,
            thumbnailHeight: 120,
            thumbnailWidth: 120,
            maxFilesize: 3,
            filesizeBase: 1000,
            dictRemoveFile: "Quitar archivo",
            init: function() {       
                thisDropzone = this;
                if(fotos){
                    fotos.forEach(function(item, index) {
                        var mockFile = { name: item, myCustomName: item, size: sizes[index] };
                        thisDropzone.emit("addedfile", mockFile);
                        thisDropzone.emit("thumbnail", mockFile, document.location.origin+'/storage/'+item);
                            $('[data-dz-thumbnail]').css('height', '120');
                            $('[data-dz-thumbnail]').css('width', '120');
                            $('[data-dz-thumbnail]').css('object-fit', 'cover');
                        
                        thisDropzone.emit("complete", mockFile);   
                        console.log(mockFile.myCustomName);                     
                    });
                }         
            },
            sending: function(file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
            },
            success: function (file, response) {
                file.myCustomName = response.value;
                console.log(file.name);
                $('#form-general').append('<input type="hidden" name="fotos[]" value="'+response.value+'">')
                $('#form-general').append('<input type="hidden" name="sizes[]" value="'+response.size+'">')
                $('.dz-message').css('display', 'none');
                
            },
            removedfile: function(file) {
                var name = file.myCustomName;    
                $.ajax({
                    type: 'POST',
                    url: "{{route('eliminarFoto')}}/"+@json($anuncio->id),
                    data: {name: name,request: 2,  "_token": "{{ csrf_token() }}"},
                    success: function(response){
                        if(response == 'ok'){
                            $('input[name^="fotos"]').map(function(value,index) {
                                // console.log($(this).val(), name, $(this).val().split('storage/')[1]);
                                if($(this).val() == name){
                                    $(this).remove();
                                    $(this).next().remove();
                                }
                            });
                            if($('input[name^="fotos"]').length > 0){
                                $('.dz-message').css('display', 'none');
                            }else{
                                $('.dz-message').css('display', 'block');
                            }
                        }
                    }
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        });


        // DropzoneJS Demo Code End

        $('#actualizar').on('click', function(){
            $('#tipo_id').attr('disabled', false);
            $('#form-general').submit();
        });
    });
</script>
@endsection

@section('contenido')
<div class="card bg-dark">
    <div class="card-header with-border border-consex">
        <h6 class="card-title text-white">Información anuncio</h6>
        <div class="card-tools pull-right">
            <a href="{{route('anuncios.index')}}" class="btn btn-block text-white bg-consex btn-sm ">
                <i class="fas fa-reply"></i> anuncios
            </a>
        </div>
    </div>
    <!-- form start -->
    <form action="{{route('anuncios.update', ['anuncio' => $anuncio->id])}}" id="form-general"
        class="form-horizontal" method="POST" autocomplete="off">
        @csrf @method('put')
        <div class="card-body">
            @include('anuncios.form')
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="row float-right">
                <a href="{{URL::previous()}}" type="reset" class="btn btn-secondary mr-2">Cancelar</a>
                <button type="button" class="btn btn-consex text-white" id="actualizar">Actualizar</button>
            </div>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
@endsection