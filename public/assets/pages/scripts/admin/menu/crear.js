$(document).ready(function() {
    Gilberto.validacionGeneral('form-general');
    $('#icono').on('input', function() {
        $('#mostrar-icono').removeClass().addClass($(this).val() + ' pt-2');
    });
});