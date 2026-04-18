$(document).ready(function () {
    
function getFloatValue(value) {
    return parseFloat(Math.round(value * 100) / 100).toFixed(0);
}

var errorValidEmail = false;
var email = $('#email');
var hint = $("#hint");

jQuery.extend(jQuery.validator.messages, {
    required: "Campo requerido.",
    email: "Ingrese Email válido."
});

function initPushPago(){
    var errorNombre = false, errorApellido = false, errorEmail = false, errorMetodoPago = false;
        var wizard = $("#procederPagoForm");

        if (!wizard.validate({errorPlacement: function (error, element) {}}).element("#nombre")) {
            errorNombre = true;
        }

        if (!wizard.validate({errorPlacement: function (error, element) {}}).element("#apellido")) {
            errorApellido = true;
        }

if (!wizard.validate({errorPlacement: function (error, element) {}}).element("#email")) {
            errorEmail = true;
        }


        if ($("#metodoPago").val() == '')
            errorMetodoPago = true;

        if (email.val() == '' /*|| 
                !(/([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(email.val()))*/) {
            errorEmail = true;
            email.addClass("error");
        }

        if (errorNombre || errorApellido || errorEmail) {
            $("#alert-datos").attr('style', 'display: block!important');
        } else {
            $("#alert-datos").attr('style', 'display: none!important');
        }

        if (errorMetodoPago) {
            $("#alert-metodo-pago").attr('style', 'display: block!important');
        } else {
            $("#alert-metodo-pago").attr('style', 'display: none!important');
        }
        if (!(errorNombre || errorApellido || errorEmail || errorMetodoPago))
        {
            $("#btn-pagos").attr('style', 'display: none');
            $("#espera-pagos").attr('style', 'display: block');
            $.ajax({
                url: "/a-includes/initPagos.php",
                type: "get",
                dataType: 'json',
                data: {
                    nombre: $('#nombre').val().trim(),
                    apellido: $('#apellido').val().trim(),
                    email: $('#email').val().trim(),
                    curso: $('#curso').val(),
                    pack: $('#pack').val(),
                    metodoPago: $('#metodoPago').val().trim(),
                    pais: $('#pais').val().trim(),
                    moneda: $('#moneda').val().trim(),
                    // El slug (carpeta del curso) viene del path actual
                    // asi el cancel_url de Stripe redirige al curso correcto
                    // (ej: ingles-nivel-dos != str_replace de ID_ABRE ingles_dos)
                    slug: (window.location.pathname.split('/').filter(Boolean)[0] || ''),
                },
                success: function (response1) {
                    if (response1.tipoPago == "payment-paypal") {
                        document.location = response1.url;
                    } else if (response1.tipoPago == "payment-strype") {
                        console.log(response1);
                        var stripe = Stripe($('#stripekeypublic').val()); //llave publica
                        stripe.redirectToCheckout({sessionId: response1.id});
                    } else {
                        //console.log("ELSE = " + response1);
                    }
                },
                error: function (xhr) {
                    $("#btn-pagos").attr('style', 'display: block');
                    $("#espera-pagos").attr('style', 'display: none');
                    //$('#spinnerloading').hide();
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    console.log("errorMessage = " + errorMessage);
                    alert("ERROR CON EL SERVIDOR");
                }
            });
        }
}


    $("#proceder_pago").click(function (e) {
         var errorNombre = false, errorApellido = false, errorEmail = false;
        var wizard = $("#procederPagoForm");

        if (!wizard.validate({errorPlacement: function (error, element) {}}).element("#nombre")) {
            errorNombre = true;
        }

        if (!wizard.validate({errorPlacement: function (error, element) {}}).element("#apellido")) {
            errorApellido = true;
        }

        if (email.val() == '' || errorValidEmail == true) {
            errorEmail = true;
        }

        if (errorNombre || errorApellido || errorEmail) {
            $("#alert-datos").attr('style', 'display: block!important');
        } else {
            $("#alert-datos").attr('style', 'display: none!important');
        }
        
        if (!(errorNombre || errorApellido || errorEmail))
        {
            $(this).fadeOut(200,function () {
                $("#div-pago").fadeIn();
            });
           
        }
    });
    
    $(".btn-payment-cuadrado").click(function (e) {
        var pago = $(this).attr('id');
        $('#metodoPago').val(pago);
        initPushPago();
    });
});