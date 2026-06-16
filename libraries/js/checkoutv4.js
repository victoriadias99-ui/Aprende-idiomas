/**
 * checkoutv4.js — Checkout Stripe para Aprende Idiomas
 * Mismo mecanismo que aprende-excel: junta los datos del form, hace GET a
 * /a-libraries/realizarVentaStripe.php y redirige a la URL de Stripe que devuelve.
 *
 * No depende de jquery.validate: validación propia (nombre, apellido, email).
 */
$(document).ready(function () {

    var EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    function val(id) {
        var el = document.getElementById(id);
        return el ? (el.value || '').trim() : '';
    }

    function marcar(id, ok) {
        var $el = $('#' + id);
        if (!$el.length) return;
        if (ok) { $el.removeClass('error').addClass('valid'); }
        else    { $el.removeClass('valid').addClass('error'); }
    }

    function iniciarPago() {
        var nombre   = val('nombre');
        var apellido = val('apellido');
        var email    = val('email');

        var okNombre   = nombre.length > 0;
        var okApellido = apellido.length > 0;
        var okEmail    = EMAIL_RE.test(email);

        marcar('nombre', okNombre);
        marcar('apellido', okApellido);
        marcar('email', okEmail);

        if (!(okNombre && okApellido && okEmail)) {
            $('#alert-datos').attr('style', 'display: block!important');
            return;
        }
        $('#alert-datos').attr('style', 'display: none!important');

        // Estado "procesando"
        $('#btn-pagos').hide();
        $('#espera-pagos').attr('style', 'display: block');
        var $btn = $('#proceder_pago');
        var btnTxt = $btn.html();
        $btn.prop('disabled', true).html('Procesando...');

        var datos = {
            nombre:    nombre,
            apellido:  apellido,
            email:     email,
            celular:   val('celular'),
            curso:     val('curso'),
            dir:       val('dir') || (window.location.pathname.split('/').filter(Boolean)[0] || ''),
            pack:      val('pack') || val('curso'),
            descuento: val('descuento') || val('codigo'),
            moneda:    val('moneda') || 'ARS',
            country:   val('pais') || val('country') || 'AR'
        };

        // Meta Pixel: InitiateCheckout (best-effort)
        if (typeof fbq !== 'undefined') {
            try {
                fbq('track', 'InitiateCheckout', {
                    value: parseFloat(val('amount')) || 0,
                    currency: datos.moneda,
                    content_ids: [datos.curso],
                    content_name: datos.curso,
                    content_type: 'product',
                    num_items: 1
                });
            } catch (e) {}
        }

        $.ajax({
            url: '/a-libraries/realizarVentaStripe.php',
            type: 'get',
            data: datos,
            success: function (response) {
                response = (response || '').trim();
                if (response.indexOf('error:') === 0 || response.indexOf('http') !== 0) {
                    $('#espera-pagos').attr('style', 'display: none');
                    $('#btn-pagos').show();
                    $btn.prop('disabled', false).html(btnTxt);
                    alert('Hubo un problema al procesar tu pago. Por favor intentá de nuevo o escribinos por WhatsApp.');
                    return;
                }
                window.location.href = response;
            },
            error: function (xhr) {
                $('#espera-pagos').attr('style', 'display: none');
                $('#btn-pagos').show();
                $btn.prop('disabled', false).html(btnTxt);
                alert('Error de conexión. Por favor intentá de nuevo.');
            }
        });
    }

    // El botón #proceder_pago se muestra al elegir método de pago (script inline del checkout).
    $(document).on('click', '#proceder_pago', function (e) {
        e.preventDefault();
        iniciarPago();
    });

    // FIX bfcache: al volver desde la pasarela, recargar para estado limpio.
    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            // Resetear estado visual inmediatamente antes del reload
            // (evita que el usuario vea "Procesando..." mientras recarga)
            var btn = document.getElementById('proceder_pago');
            if (btn) { btn.disabled = false; btn.innerHTML = '👉 Proceder con el pago'; }
            var espera = document.getElementById('espera-pagos');
            if (espera) espera.style.display = 'none';
            window.location.reload();
        }
    });
});
