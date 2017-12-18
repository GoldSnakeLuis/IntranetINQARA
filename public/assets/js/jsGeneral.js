function notificacion(tipo, mensaje) {
    if (tipo == 0) {
        new PNotify({
            title: 'ERROR',
            text: mensaje,
            type: 'error'
        });
    } else
    if (tipo == 1) {
        new PNotify({
            title: 'EXITO',
            text: mensaje,
            type: 'success'
        });
    } else
    if (tipo == 2) {
        new PNotify({
            title: 'CUIDADO',
            text: mensaje,
            type: 'warning'
        });
    } else
    if (tipo == 3) {
        new PNotify({
            title: 'INFORMACION',
            text: mensaje,
            type: 'info'
        });
    }
}
function registrarAJAX(nombreFRM, AJAX_URL) {
    $(nombreFRM).on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: AJAX_URL,
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function ()
            {
                $.LoadingOverlay("show");
//                console.log("Registrar Ajax");
            },
            success: function () {
                $.LoadingOverlay("hide");
                notificacion(1, "Registro realizado con éxito.");
                $(nombreFRM)[0].reset();
                $('.modal-block .modal-dismiss').click();
                datatable.ajax.reload();
            },
            error: function (e) {
                $.LoadingOverlay("hide");
                notificacion(0, "Hubo un error al realizar la acción solicitada.");
                $(nombreFRM)[0].reset();
                $('.modal-block .modal-dismiss').click();
            }
        });
    }));
}

function estadoAJAX(idAttr, AJAX_URL, estado) {

    $.ajax({
        url: AJAX_URL,
        type: 'GET',
        data: {
            id: idAttr,
            estado: estado
        },
        beforeSend: function () {
            $.LoadingOverlay("show");
        },
        success: function (data) {
            $.LoadingOverlay("hide");
            notificacion(1, "Acción realizada con éxito.");
            $('.modal-block .modal-dismiss').click();
            datatable.ajax.reload();
        },
        error: function (e)
        {
            $.LoadingOverlay("hide");
            notificacion(0, "Hubo un error al realizar la acción solicitada.");
            $('.modal-block .modal-dismiss').click();
        }
    });
}

function buscarxidAJAX(id, urlAJAX) {
    var resultado = [];
    $.ajax({
        url: urlAJAX,
        dataType: 'json',
        type: 'POST',
        async: false,
        data: {
            id: id
        },
        beforeSend: function () {
            $.LoadingOverlay("show");
        },
        success: function (response) {
            $(response).each(function (i, obj) {
                resultado.push(obj);
            });
            $.LoadingOverlay("hide");
        },
        error: function (response) {
            resultado = "Error";
            $.LoadingOverlay("hide");

        }
    });
    return resultado;
}



function eliminarAJAX(idAttr, AJAX_URL) {

    $.ajax({
        url: AJAX_URL,
        type: 'POST',
        data: {
            id: idAttr
        },
        beforeSend: function () {
            $.LoadingOverlay("show");
        },
        success: function (data) {
            $.LoadingOverlay("hide");
            notificacion(1, "Acción realizada con éxito.");
            $('.modal-block .modal-dismiss').click();
            datatable.ajax.reload();
        },
        error: function (e)
        {
            $.LoadingOverlay("hide");
            notificacion(0, "Hubo un error al realizar la acción solicitada.");
            $('.modal-block .modal-dismiss').click();
        }
    });
}


$(document).ready(function () {
    APP.init();
});