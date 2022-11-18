$(document).ready(function() {
    var ID, opcion, estado, table, indexColumn, where, columns = [];
    estado = 1;

    $('#alarmas').addClass('active');
    $('title').text('Control Panel - CRUD Alarmas');

    var $selectUbicacion = $('#ID_Ubicacion');
    $selectUbicacion.select2({
        dropdownParent: $('#modalCRUD'),
        placeholder: 'Ubicacion',
        width: '100%'
    });
    
    var $select2 = $('.select2-selection');
    $select2.height('58px');
    $select2.addClass('d-flex align-items-center');
    $select2.css('border-color', '#ced4da');

    $('.select2-selection__arrow').height('58px');
 
    table = 'ubicaciones';
    indexColumn = 'ID_Ubicacion';
    columns = ['ID_Ubicacion', 'Area', 'Sala', 'Piso'];

    $.ajax({
        url: "../bd/obtenerDatosSelect.php",
        type: "POST",
        datatype: "json",
        data: {table:table, indexColumn:indexColumn, columns:columns},
        success: function(data) {
            data = JSON.parse(data);
            data.forEach(element => {
                $('#ID_Ubicacion').append('<option ' + ' value="' + element['ID_Ubicacion'] + '">' + element['ID_Ubicacion'] + ' - ' + element['Area'] + ' ' + element['Sala'] + ', Piso ' + element['Piso'] + '</option>');
            });
        }
    });
    
    $('#btnEstado').on('click', function(){
        if (estado == 1) {
            $('#tablaAlarmasInactivo_wrapper').show();
            $('#tablaAlarmasActivo_wrapper').hide();
            estado = 0;
        } else {
            $('#tablaAlarmasInactivo_wrapper').hide();
            $('#tablaAlarmasActivo_wrapper').show();
            estado = 1;
        }
    });

    tablaAlarmaActivo = $('#tablaAlarmasActivo').DataTable({
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../serverside/serversideAlarma.php?estado=1",
        "columnDefs": [{
            "targets": -1,
            "defaultContent": "<div class='wrapper text-center'><div class='btn-group'><button class='btn btn-info btn-sm btnEditar' data-toggle='tooltip' title='Editar'><i class='bx bx-edit'></i>edit</button><button class='btn btn-danger btn-sm btnBorrar' data-toggle='tooltip' title='Eliminar'><i class='bx bx-eraser'></i>del</button></div></div>"
        }],
    });

    tablaAlarmaInactivo = $('#tablaAlarmasInactivo').DataTable({
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../serverside/serversideAlarma.php?estado=0",
        "columnDefs": [{
            "targets": -1,
            "defaultContent": "<div class='wrapper text-center'><button class='btn btn-info btn-sm btnRestaurar' data-toggle='tooltip' title='restaurar'><i class='bx bx-reset'></i>Restaurar</button></div>"
        }],
    });

    $('#tablaAlarmasInactivo_wrapper').hide();

    var fila;

    $('#formAlarma').submit(function(e){
        e.preventDefault();
        descripcion = $.trim($('#descripcion').val());
        ID_Ubicacion = $.trim($('#ID_Ubicacion').val());
        origen = $.trim($('#origen').val());
        $.ajax({
            url: "../bd/crud Alarmas.php",
            type: "POST",
            datatype: "json",
            data:  {ID:ID, descripcion:descripcion, ID_Ubicacion:ID_Ubicacion, origen:origen, opcion:opcion},
            success: function(data) {
                if (data == 'false') {
                    alert('No tiene suficientes permisos para realizar esta accion.');
                }
                tablaAlarmaActivo.ajax.reload(null, false);
                tablaAlarmaInactivo.ajax.reload(null, false);
            }
        });
        $('#modalCRUD').modal('hide');
    });
    
    $("#btnNuevo").click(function(){
        $('#formAlarma')[0].reset();
        $selectUbicacion.val(null).trigger("change");
        opcion = 1;
        ID = null;
        $("#formAlarma").trigger("reset");
        $(".modal-header").css( "background-color", "var(--first-color)");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Alarma");
        $('#modalCRUD').modal('show');
        $('.modal-backdrop').css('width', '100%');
    });

    $(document).on("click", ".btnEditar", function(){
        $('#formAlarma')[0].reset();
        opcion = 2;
        fila = $(this).closest("tr");
        ID = parseInt(fila.find('td:eq(0)').text());
        descripcion = fila.find('td:eq(1)').text();
        origen = fila.find('td:eq(3)').text();
        table = 'alarmas';
        indexColumn = 'ID_Alarma';
        columns = ['ID_Ubicacion'];
        where = indexColumn + ' = ' + ID;
        $.ajax({
            url: "../bd/obtenerDatosSelect.php",
            type: "POST",
            datatype: "json",
            data:  {table:table, indexColumn:indexColumn, columns:columns, where:where},
            success: function(data) {
                data = JSON.parse(data);
                $selectUbicacion.val(data[0]['ID_Ubicacion']).trigger("change");
            }
        });
        $("#descripcion").val(descripcion);
        $("#ID_Ubicacion").val(ID_Ubicacion);
        $("#origen").val(origen);
        $(".modal-header").css("background-color", "var(--first-color)");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Alarma");
        $('#modalCRUD').modal('show');
        $('.modal-backdrop').css('width', '100%');
    });

    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);
        ID = parseInt($(this).closest('tr').find('td:eq(0)').text());
        opcion = 3;
        var respuesta = confirm("¿Está seguro de que desesa borrar el registro " + ID + "?");
        if (respuesta) {
            $.ajax({
                url: "../bd/crud Alarmas.php",
                type: "POST",
                datatype: "json",
                data:  {opcion:opcion, ID:ID},
                success: function(data) {
                    if (data == 'false') {
                        alert('No tiene suficientes permisos para realizar esta accion.');
                    }
                    tablaAlarmaActivo.ajax.reload(null, false);
                    tablaAlarmaInactivo.ajax.reload(null, false);
                }
            });
        }
    });

    $(document).on("click", ".btnRestaurar", function(){
        fila = $(this);
        ID = parseInt($(this).closest('tr').find('td:eq(0)').text());
        opcion = 4;
        var respuesta = confirm("¿Está seguro de que desea restaurar el registro " + ID + "?");
        if (respuesta) {
            $.ajax({
                url: "../bd/crud Alarmas.php",
                type: "POST",
                datatype: "json",
                data:  {opcion:opcion, ID:ID},
                success: function(data) {
                    if (data == 'false') {
                        alert('No tiene suficientes permisos para realizar esta accion.');
                    }
                    tablaAlarmaActivo.ajax.reload(null, false);
                    tablaAlarmaInactivo.ajax.reload(null, false);
                }
            });
        }
    });
});