var errorValidEmail = false;
var email = jQuery('#email');
var hint = jQuery("#hint");

function checkMail(){
    hint.css('display', 'none').empty(); // hide hint initially
    error = false;
    errorValidEmail = false;
    email.mailcheck({
        suggested: function (element, suggestion) {
            if (!hint.html()) {
                // misspell - display hint element
                var suggestion = "<p style='margin-top: 0.5em; background-color: #ffffff;border-radius: 5px;padding: 0.5em;border-style: solid;border-color: red;color: red;font-weight: bolder;'>Quisiste decir <span class='suggestion'>" +
                        "<span class='address'>" + suggestion.address + "</span>"
                        + "@<a href='#' class='domain'>" + suggestion.domain +
                        "</a></span>?</p>";

                email.addClass("error");
                errorValidEmail = true;
                hint.html(suggestion).fadeIn(150);
            } else {
                // Subsequent errors
                jQuery(".address").html(suggestion.address);
                jQuery(".domain").html(suggestion.domain);
                email.addClass("error");
                errorValidEmail = true;
            }
        }
    });
}

email.on('blur', function () {
    checkMail();
});

hint.on('click', '.domain', function () {
    // Display with the suggestion and remove the hint
    email.val(jQuery(".suggestion").text());
    hint.fadeOut(200, function () {
        jQuery(this).empty();
        email.removeClass("error");
        errorValidEmail = false;
    });
    return false;
});



jQuery.extend(jQuery.validator.messages, {
    required: "Campo requerido.",
    email: "Ingrese Email válido."
});

$(document).ready(function () {
    checkMail();
    $('#spinnerloading').hide();
    $('#proceder_pago').show();
    
    $('#proceder_pago').click(function (event) {
        event.preventDefault();

        var error = false;
        var wizard = $("#procederPagoForm");

        if (!wizard.validate({errorPlacement: function (error, element) {}}).element("#nombre")) {
            error = true;
        }

        if (!wizard.validate({errorPlacement: function (error, element) {}}).element("#apellido")) {
            error = true;
        }

        if (!wizard.validate({errorPlacement: function (error, element) {}}).element("#celular")) {
            error = true;
        }

        //if(!wizard.validate({errorPlacement: function (error, element) {}}).element( "#email" )){ 
        //	error=true;
        //}

        if (email.val() == '')
        {
            error == true;
            email.removeClass("valid");
            email.addClass("error");
        } else
        {
            email.removeClass("error");
            email.addClass("valid");
        }

        if (errorValidEmail == false)
        {
            if (email.val() == '')
            {
                error == true;
                email.removeClass("valid");
                email.addClass("error");
            } else
            {
                email.removeClass("error");
                email.addClass("valid");
            }
        }

        if (error == false && errorValidEmail == false && email.val() != '')
        {
            $('#spinnerloading').show();
            $('#proceder_pago').hide();
            str = '';
            $.ajax(
                    {
                        url: "../libraries1/realizarVenta.php",
                        type: "get",
                        data: {
                            nombre: $('#nombre').val(),
                            apellido: $('#apellido').val(),
                            celular: $('#celular').val(),
                            email: $('#email').val(),
                            curso: $('#curso').val(),
                            pack: $('#pack').val(),
                            descuento: $('#codigo').val()
                        },
                        success: function (response) {
                            window.location.href = response;
                            $('#spinnerloading').hide();
                            $('#proceder_pago').show();
                        },
                        error: function (xhr) {
                            alert(xhr);
                            $('#spinnerloading').hide();
                            $('#proceder_pago').show();
                        }
                    });
        } else {
            $('#spinnerloading').hide();
            $('#proceder_pago').show();
        }
    });

})
