$(document).ready(function() {
    var ID, opcion, estado;
    estado = 1;

    $('#usuarios').addClass('active');
    $('title').text('Control Panel - CRUD Usuarios');
    
    $('#btnEstado').on('click', function(){
        if (estado == 1) {
            $('#tablaUsuariosInactivo_wrapper').show();
            $('#tablaUsuariosActivo_wrapper').hide();
            estado = 0;
        } else {
            $('#tablaUsuariosInactivo_wrapper').hide();
            $('#tablaUsuariosActivo_wrapper').show();
            estado = 1;
        }
    });

    tablaUsuarioActivo = $('#tablaUsuariosActivo').DataTable({
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../serverside/serversideUsuario.php?estado=1",
        "columnDefs": [{
            "targets": -1,
            "defaultContent": "<div class='wrapper text-center'><div class='btn-group'><button class='btn btn-info btn-sm btnEditar' data-toggle='tooltip' title='Editar'><i class='bx bx-edit'></i>edit</button><button class='btn btn-danger btn-sm btnBorrar' data-toggle='tooltip' title='Eliminar'><i class='bx bx-eraser'></i>del</button></div></div>"
        }],
    });

    tablaUsuarioInactivo = $('#tablaUsuariosInactivo').DataTable({
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../serverside/serversideUsuario.php?estado=0",
        "columnDefs": [{
            "targets": -1,
            "defaultContent": "<div class='wrapper text-center'><button class='btn btn-info btn-sm btnRestaurar' data-toggle='tooltip' title='restaurar'><i class='bx bx-reset'></i>Restaurar</button></div>"
        }],
    });

    $('#tablaUsuariosInactivo_wrapper').hide();

    var fila;

    $('#formUsuario').submit(function(e){
        e.preventDefault();
        user = $.trim($('#user').val());
        table = 'usuarios';
        $.ajax({
            url: "../bd/crud Usuarios.php",
            type: "POST",
            datatype: "json",
            data:  {opcion:5, user:user, table:table, estado:1},
            success: function(data) {
                data = JSON.parse(data);
                if (data[0]['count'] == 0 || data[0]['ID_Usuario'] == ID) {
                    NombreCompleto = $.trim($('#NombreCompleto').val());
                    password = $.trim($('#password').val());
                    rol = $.trim($('#rol').val());
                    $.ajax({
                        url: "../bd/crud Usuarios.php",
                        type: "POST",
                        datatype: "json",
                        data:  {ID:ID, user:user, NombreCompleto:NombreCompleto, password:password, rol:rol, opcion:opcion},
                        success: function(data) {
                            console.log(data);
                            tablaUsuarioActivo.ajax.reload(null, false);
                            tablaUsuarioInactivo.ajax.reload(null, false);
                        }
                    });
                    $('#modalCRUD').modal('hide');
                } else {
                    alert("El nombre de usuario se encuentra en uso. (registro " + data[0]['ID_Usuario'] + ")");
                }
            }
        });
    });
    
    $("#btnNuevo").click(function(){
        $('#formUsuario')[0].reset();
        opcion = 1;
        ID = null;
        $("#formUsuario").trigger("reset");
        $(".modal-header").css( "background-color", "var(--first-color)");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Usuario");
        $('#modalCRUD').modal('show');
        $('.modal-backdrop').css('width', '100%');
    });

    $(document).on("click", ".btnEditar", function(){
        $('#formUsuario')[0].reset();
        opcion = 2;
        fila = $(this).closest("tr");
        user = fila.find('td:eq(1)').text();
        ID = parseInt(fila.find('td:eq(0)').text());
        NombreCompleto = fila.find('td:eq(2)').text();
        rol = fila.find('td:eq(3)').text();
        $("#user").val(user);
        $("#NombreCompleto").val(NombreCompleto);
        $('#rol').val(rol);
        $(".modal-header").css("background-color", "var(--first-color)");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Usuario");
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
                url: "../bd/crud Usuarios.php",
                type: "POST",
                datatype: "json",
                data:  {opcion:opcion, ID:ID},
                success: function(data) {
                    console.log(data);
                    tablaUsuarioActivo.ajax.reload(null, false);
                    tablaUsuarioInactivo.ajax.reload(null, false);
                }
            });
        }
    });

    $(document).on("click", ".btnRestaurar", function(){
        ID = parseInt($(this).closest('tr').find('td:eq(0)').text());
        user = $(this).closest('tr').find('td:eq(1)').text();
        table = 'usuarios';
        opcion = 4;
        var respuesta = confirm("¿Está seguro de que desea restaurar el registro " + ID + "?");
        if (respuesta) {
        $.ajax({
            url: "../bd/crud Usuarios.php",
            type: "POST",
            datatype: "json",
            data:  {opcion:5, user:user, table:table, estado:1},
            success: function(data) {
                data = JSON.parse(data);
                if (data[0]['count'] == 0) {
                    $.ajax({
                        url: "../bd/crud Usuarios.php",
                        type: "POST",
                        datatype: "json",
                        data:  {opcion:opcion, ID:ID},
                        success: function() {
                            tablaUsuarioActivo.ajax.reload(null, false);
                            tablaUsuarioInactivo.ajax.reload(null, false);
                        }
                    });
                } else {
                    alert("El nombre de usuario se encuentra en uso. (registro " + data[0]['ID_Usuario'] + ")");
                }
            }
        });
        }
    });
});