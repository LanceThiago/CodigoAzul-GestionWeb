$(document).ready(function() {
    var ID, opcion, estado;
    estado = 1;

    $('#enfermeros').addClass('active');
    $('title').text('Control Panel - CRUD Enfermeros');
    
    $('#btnEstado').on('click', function(){
        if (estado == 1) {
            $('#tablaEnfermerosInactivo_wrapper').show();
            $('#tablaEnfermerosActivo_wrapper').hide();
            estado = 0;
        } else {
            $('#tablaEnfermerosInactivo_wrapper').hide();
            $('#tablaEnfermerosActivo_wrapper').show();
            estado = 1;
        }
    });

    tablaEnfermeroActivo = $('#tablaEnfermerosActivo').DataTable({
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../serverside/serversideEnfermero.php?estado=1",
        "columnDefs": [{
            "targets": -1,
            "defaultContent": "<div class='wrapper text-center'><div class='btn-group'><button class='btn btn-info btn-sm btnEditar' data-toggle='tooltip' title='Editar'><i class='bx bx-edit'></i>edit</button><button class='btn btn-danger btn-sm btnBorrar' data-toggle='tooltip' title='Eliminar'><i class='bx bx-eraser'></i>del</button></div></div>"
        }],
    });

    tablaEnfermeroInactivo = $('#tablaEnfermerosInactivo').DataTable({
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../serverside/serversideEnfermero.php?estado=0",
        "columnDefs": [{
            "targets": -1,
            "defaultContent": "<div class='wrapper text-center'><button class='btn btn-info btn-sm btnRestaurar' data-toggle='tooltip' title='restaurar'><i class='bx bx-reset'></i>Restaurar</button></div>"
        }],
    });

    $('#tablaEnfermerosInactivo_wrapper').hide();

    var fila;

    $('#formEnfermero').submit(function(e){
        e.preventDefault();
        nombre = $.trim($('#nombre').val());
        apellido = $.trim($('#apellido').val());
        dni = $.trim($('#dni').val());
        $.ajax({
            url: "../bd/crud Enfermeros.php",
            type: "POST",
            datatype: "json",
            data:  {ID:ID, nombre:nombre, apellido:apellido, dni:dni, opcion:opcion},
            success: function(data) {
                if (data == 'false') {
                    alert('No tiene suficientes permisos para realizar esta accion.');
                }
                tablaEnfermeroActivo.ajax.reload(null, false);
                tablaEnfermeroInactivo.ajax.reload(null, false);
            }
        });
        $('#modalCRUD').modal('hide');
    });
    
    $("#btnNuevo").click(function(){
        $('#formEnfermero')[0].reset();
        opcion = 1;
        ID = null;
        $("#formEnfermero").trigger("reset");
        $(".modal-header").css( "background-color", "var(--first-color)");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Enfermero");
        $('#modalCRUD').modal('show');
        $('.modal-backdrop').css('width', '100%');
    });

    $(document).on("click", ".btnEditar", function(){
        $('#formEnfermero')[0].reset();
        opcion = 2;
        fila = $(this).closest("tr");
        ID = parseInt(fila.find('td:eq(0)').text());
        nombre = fila.find('td:eq(1)').text();
        apellido = fila.find('td:eq(2)').text();
        dni = fila.find('td:eq(3)').text();
        $("#nombre").val(nombre);
        $("#apellido").val(apellido);
        $("#dni").val(dni);
        $(".modal-header").css("background-color", "var(--first-color)");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Enfermero");
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
                url: "../bd/crud Enfermeros.php",
                type: "POST",
                datatype: "json",
                data:  {opcion:opcion, ID:ID},
                success: function(data) {
                    if (data == 'false') {
                        alert('No tiene suficientes permisos para realizar esta accion.');
                    }
                    tablaEnfermeroActivo.ajax.reload(null, false);
                    tablaEnfermeroInactivo.ajax.reload(null, false);
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
                url: "../bd/crud Enfermeros.php",
                type: "POST",
                datatype: "json",
                data:  {opcion:opcion, ID:ID},
                success: function(data) {
                    if (data == 'false') {
                        alert('No tiene suficientes permisos para realizar esta accion.');
                    }
                    tablaEnfermeroActivo.ajax.reload(null, false);
                    tablaEnfermeroInactivo.ajax.reload(null, false);
                }
            });
        }
    });
});