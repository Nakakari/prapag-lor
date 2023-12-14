@push('css-plugins')

@endpush

@push('js-plugins')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
    <script>
        jQuery.validator.setDefaults({
            errorElement: "div",
            errorPlacement: function ( error, element ) {
                
                // Add the `help-block` class to the error element
                error.addClass( "invalid-feedback");

                if ( element.prop( "type" ) === "checkbox" ) {
                    
                    error.insertAfter(element.parent().parent());
                } else if(element.prop('tagName') == 'SELECT') {
                    if(element.hasClass('select2-hidden-accessible')){
                        
                        element.parent().append(error)
                    }else{
                        error.insertAfter( element );
                    }
                }else {
                    error.insertAfter( element );
                }
            },
            highlight: function(element) {
                
                $(element).removeClass('is-valid').addClass('is-invalid');
            },
            success: function(label, element) {
                
                $(label).removeClass('is-invalid').removeClass('is-valid')
            },
            unhighlight: function ( element, errorClass, validClass ) {
                
                $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });

    </script>
@endpush
