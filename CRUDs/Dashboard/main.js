$(document).ready(function() {
    $('#dashboard').addClass('active');
    $('title').text('Control Panel - Dashboard');

    tablaRegistrosActivo = $('#tablaRegistros').DataTable({
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../serverside/serversideRegistro.php"
    });
});