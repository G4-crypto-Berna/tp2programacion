$(function () {
    // Token CSRF del formulario del sorteo
    function inputToken() {
        return $('#formSorteo input[type=hidden]').first();
    }

    // Actualiza el token en todos los formularios de la página
    function actualizarToken(token) {
        if (!token) return;
        const nombre = inputToken().attr('name');
        $('input[name="' + nombre + '"]').val(token);
    }

    $('#formSorteo').on('submit', function (e) {
        e.preventDefault();
        const $form = $(this);

        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function (resp) {
                actualizarToken(resp.token);

                const $lista = $('#resultadoSorteo').empty();

                if (!resp.ok) {
                    $('#msgSorteo').text(resp.mensaje).css('color', 'red');
                    return;
                }

                $('#msgSorteo')
                    .text('Preguntas sorteadas (quedan ' + resp.restantes + ' sin sortear):')
                    .css('color', 'green');

                resp.preguntas.forEach(function (texto) {
                    $lista.append($('<li>').text(texto));
                });
            },
            error: function () {
                $('#msgSorteo').text('Error de comunicación con el servidor.').css('color', 'red');
            }
        });
    });

    $('#btnReiniciar').on('click', function () {
        const $token = inputToken();

        $.ajax({
            url: $(this).data('url'),
            method: 'POST',
            data: { [$token.attr('name')]: $token.val() },
            dataType: 'json',
            success: function (resp) {
                actualizarToken(resp.token);
                $('#resultadoSorteo').empty();
                $('#msgSorteo').text(resp.mensaje).css('color', 'green');
            },
            error: function () {
                $('#msgSorteo').text('Error de comunicación con el servidor.').css('color', 'red');
            }
        });
    });
});