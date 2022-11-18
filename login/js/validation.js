$(document).ready(function(){
    jQuery.extend(jQuery.validator.messages, {
        required: "Complete este campo.",
        maxlength: jQuery.validator.format("Ingrese menos de {0} caracteres."),
        rangelength: jQuery.validator.format("Ingrese un valor de entre {0} y {1} caracteres de longitud."),
        equalTo: "Ingrese el mismo valor de nuevo."
    });

    var passwordREG = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/;
    jQuery.validator.addMethod("passwordValidation", function(value, element) {
        return this.optional(element) || passwordREG.test(value);
    }, "La contraseña debe contenter al menos una letra mayuscula, una minuscula, un numero y un caracter especial (@ $ ! % * ? &).");
    
    $( "#editForm" ).validate({
      rules: {
        user: {
          required: true,
          rangelength: [6, 20],

        },
        nombreCompleto: {
          required: true,
          maxlength: 60
        },
        password: {
          required: false,
          rangelength: [8, 20],
          passwordValidation: true,
        },
        passwordVerify: {
          required: false,
          equalTo: password
        }
      }
    });
});