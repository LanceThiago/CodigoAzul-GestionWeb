$(document).ready(function() {
    var ID, opcion, estado;
    estado = 1;

    $('#ubicaciones').addClass('active');
    $('title').text('Control Panel - CRUD Ubicaciones');
    
    $('#btnEstado').on('click', function(){
        if (estado == 1) {
            $('#tablaUbicacionesInactivo_wrapper').show();
            $('#tablaUbicacionesActivo_wrapper').hide();
            estado = 0;
        } else {
            $('#tablaUbicacionesInactivo_wrapper').hide();
            $('#tablaUbicacionesActivo_wrapper').show();
            estado = 1;
        }
    });

    tablaUbicacionActivo = $('#tablaUbicacionesActivo').DataTable({
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../serverside/serversideUbicacion.php?estado=1",
        "columnDefs": [{
            "targets": -1,
            "defaultContent": "<div class='wrapper text-center'><div class='btn-group'><button class='btn btn-info btn-sm btnEditar' data-toggle='tooltip' title='Editar'><i class='bx bx-edit'></i>edit</button><button class='btn btn-danger btn-sm btnBorrar' data-toggle='tooltip' title='Eliminar'><i class='bx bx-eraser'></i>del</button></div></div>"
        }],
    });

    tablaUbicacionInactivo = $('#tablaUbicacionesInactivo').DataTable({
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../serverside/serversideUbicacion.php?estado=0",
        "columnDefs": [{
            "targets": -1,
            "defaultContent": "<div class='wrapper text-center'><button class='btn btn-info btn-sm btnRestaurar' data-toggle='tooltip' title='restaurar'><i class='bx bx-reset'></i>Restaurar</button></div>"
        }],
    });

    $('#tablaUbicacionesInactivo_wrapper').hide();

    var fila;

    $('#formUbicacion').submit(function(e){
        e.preventDefault();
        piso = $.trim($('#piso').val());
        area = $.trim($('#area').val());
        sala = $.trim($('#sala').val());
        $.ajax({
            url: "../bd/crud Ubicaciones.php",
            type: "POST",
            datatype: "json",
            data:  {ID:ID, piso:piso, area:area, sala:sala, opcion:opcion},
            success: function(data) {
                if (data == 'false') {
                    alert('No tiene suficientes permisos para realizar esta accion.');
                }
                tablaUbicacionActivo.ajax.reload(null, false);
                tablaUbicacionInactivo.ajax.reload(null, false);
            }
        });
        $('#modalCRUD').modal('hide');
    });
    
    $("#btnNuevo").click(function(){
        $('#formUbicacion')[0].reset();
        opcion = 1;
        ID = null;
        $("#formUbicacion").trigger("reset");
        $(".modal-header").css( "background-color", "var(--first-color)");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Ubicacion");
        $('#modalCRUD').modal('show');
        $('.modal-backdrop').css('width', '100%');
    });

    $(document).on("click", ".btnEditar", function(){
        $('#formUbicacion')[0].reset();
        opcion = 2;
        fila = $(this).closest("tr");
        ID = parseInt(fila.find('td:eq(0)').text());
        piso = fila.find('td:eq(1)').text();
        area = fila.find('td:eq(2)').text();
        sala = fila.find('td:eq(3)').text();
        $("#piso").val(piso);
        $("#area").val(area);
        $("#sala").val(sala);
        $(".modal-header").css("background-color", "var(--first-color)");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Ubicacion");
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
                url: "../bd/crud Ubicaciones.php",
                type: "POST",
                datatype: "json",
                data:  {opcion:opcion, ID:ID},
                success: function(data) {
                    if (data == 'false') {
                        alert('No tiene suficientes permisos para realizar esta accion.');
                    }
                    tablaUbicacionActivo.ajax.reload(null, false);
                    tablaUbicacionInactivo.ajax.reload(null, false);
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
                url: "../bd/crud Ubicaciones.php",
                type: "POST",
                datatype: "json",
                data:  {opcion:opcion, ID:ID},
                success: function(data) {
                    if (data == 'false') {
                        alert('No tiene suficientes permisos para realizar esta accion.');
                    }
                    tablaUbicacionActivo.ajax.reload(null, false);
                    tablaUbicacionInactivo.ajax.reload(null, false);
                }
            });
        }
    });
});