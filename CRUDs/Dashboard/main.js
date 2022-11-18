$(document).ready(function() {
    var opcion;
    $('#dashboard').addClass('active');
    $('title').text('Control Panel - Dashboard');

    tablaRegistrosActivo = $('#tablaRegistros').DataTable({
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../serverside/serversideRegistro.php"
    });

    opcion = 1;
    table = 'enfermeros';
    indexColumn = 'ID_Enfermero';
    columns = ["COUNT(" + indexColumn + ")"];
    status = 1;
    $count = count(opcion, table, indexColumn, columns, status);
    $('#cantEnfermerosActivos').text($count);
    opcion = 1;
    table = 'enfermeros';
    indexColumn = 'ID_Enfermero';
    columns = ["COUNT(" + indexColumn + ")"];
    status = 0;
    $count = count(opcion, table, indexColumn, columns, status);
    $('#cantEnfermerosInactivos').text($count);

    table = 'pacientes';
    indexColumn = 'ID_Paciente';
    columns = ["COUNT(" + indexColumn + ")"];
    status = 1;
    $count = count(opcion, table, indexColumn, columns, status);
    $('#cantPacientesActivos').text($count);
    table = 'pacientes';
    indexColumn = 'ID_Paciente';
    columns = ["COUNT(" + indexColumn + ")"];
    status = 0;
    $count = count(opcion, table, indexColumn, columns, status);
    $('#cantPacientesInactivos').text($count);
    
    table = 'alarmas';
    indexColumn = 'ID_Alarma';
    columns = ["COUNT(" + indexColumn + ")"];
    status = 1;
    $count = count(opcion, table, indexColumn, columns, status);
    $('#cantAlarmasActivos').text($count);
    table = 'alarmas';
    indexColumn = 'ID_Alarma';
    columns = ["COUNT(" + indexColumn + ")"];
    status = 0;
    $count = count(opcion, table, indexColumn, columns, status);
    $('#cantAlarmasInactivos').text($count);
    
    table = 'registros';
    indexColumn = 'ID_Registro';
    columns = ["COUNT(" + indexColumn + ")"];
    status = '';
    $count = count(opcion, table, indexColumn, columns, status);
    $('#cantRegistros').text($count);

    opcion = 2;
    columnInicio = 'FechaHora';
    columnFinal = 'FechaHoraAtendido';
    $as = 'Diferencia';
    $.ajax({
        async: false,
        url: "../bd/dashboard.php",
        type: "POST",
        datatype: "json",
        data: {opcion:2, table:table, columnInicio:columnInicio, columnFinal:columnFinal, as:$as},
        success: function(data) {
            $('#promedioRespuesta').text(data);
        }
    });

    function count(opcion, table, indexColumn, columns, status) {
        var $output;
        $.ajax({
            async: false,
            url: "../bd/dashboard.php",
            type: "POST",
            datatype: "json",
            data: {opcion:opcion, table:table, indexColumn:indexColumn, columns:columns, status:status},
            success: function(data) {
                data = JSON.parse(data);
                $output = data[0][0];
            }
        });
        return $output;
    }
});