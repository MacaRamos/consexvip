<script>
    errors = @json($errors->all());
    if(errors.length > 0){
        errors.forEach(error => {
            toastr.options = {
                closeButton: true,
                newestOnTop: true,
                positionClass: 'toast-top-right',
                preventDuplicates: true,
                timeOut: '5000'
            };
            toastr.error(error, ''); 
        });
    }
</script>