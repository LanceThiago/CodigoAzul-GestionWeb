$(document).ready(function() {
    var ID, opcion;
    estado = 1;

    $('#pacientes').addClass('active');
    $('title').text('Control Panel - CRUD Pacientes');

    var $selectPaciente = $('#ID_Paciente');
    $selectPaciente.select2({
        placeholder: 'Paciente',
        width: '100%'
    });
    
    var $select2 = $('.select2-selection');
    $select2.height('58px');
    $select2.addClass('d-flex align-items-center');
    $select2.css('border-color', '#ced4da');

    $('.select2-selection__arrow').height('58px');

    table = 'pacientes';
    indexColumn = 'ID_Paciente';
    columns = ['ID_Paciente', 'Nombre', 'Apellido', 'DNI'];

    $.ajax({
        url: "../bd/obtenerDatosSelect.php",
        type: "POST",
        datatype: "json",
        data: {table:table, indexColumn:indexColumn, columns:columns},
        success: function(data) {
            data = JSON.parse(data);
            data.forEach(element => {
                $('#ID_Paciente').append('<option ' + ' value="' + element['ID_Paciente'] + '">' + element['ID_Paciente'] + ' - ' + element['Nombre'] + ' ' + element['Apellido'] + ', DNI ' + element['DNI'] + '</option>');
            });
        }
    });

    var $selectUbicacion = $('#ID_Ubicacion');
    $selectUbicacion.select2({
        dropdownParent: $('#modalCRUD'),
        placeholder: 'Ubicacion',
        width: '100%'
    });
    
    var $selectUbicacionEdit = $('#ID_UbicacionEdit');
    $selectUbicacionEdit.select2({
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
                $('#ID_UbicacionEdit').append('<option ' + ' value="' + element['ID_Ubicacion'] + '">' + element['ID_Ubicacion'] + ' - ' + element['Area'] + ' ' + element['Sala'] + ', Piso ' + element['Piso'] + '</option>');
            });
        }
    });


    var $selectEnfermero = $('#ID_Enfermero');
    $selectEnfermero.select2({
        dropdownParent: $('#modalCRUD'),
        placeholder: 'Enfermero',
        width: '100%'
    });

    var $selectEnfermeroEdit = $('#ID_EnfermeroEdit');
    $selectEnfermeroEdit.select2({
        placeholder: 'Enfermero',
        width: '100%'
    });
    
    var $select2 = $('.select2-selection');
    $select2.height('58px');
    $select2.addClass('d-flex align-items-center');
    $select2.css('border-color', '#ced4da');

    $('.select2-selection__arrow').height('58px');
 
    table = 'enfermeros';
    indexColumn = 'ID_Enfermero';
    columns = ['ID_Enfermero', 'Nombre', 'Apellido', 'DNI'];

    $.ajax({
        url: "../bd/obtenerDatosSelect.php",
        type: "POST",
        datatype: "json",
        data: {table:table, indexColumn:indexColumn, columns:columns},
        success: function(data) {
            data = JSON.parse(data);
            data.forEach(element => {
                $('#ID_Enfermero').append('<option ' + ' value="' + element['ID_Enfermero'] + '">' + element['ID_Enfermero'] + ' - ' + element['Nombre'] + ' ' + element['Apellido'] + ', DNI ' + element['DNI'] + '</option>');
                $('#ID_EnfermeroEdit').append('<option ' + ' value="' + element['ID_Enfermero'] + '">' + element['ID_Enfermero'] + ' - ' + element['Nombre'] + ' ' + element['Apellido'] + ', DNI ' + element['DNI'] + '</option>');
            });
        }
    });

    var fila;

    $selectPaciente.on('change', function() {
        $("#formPacienteEdit").show();
    });

    $('#formPaciente').submit(function(e){
        e.preventDefault();
        nombre = $.trim($('#nombre').val());
        apellido = $.trim($('#apellido').val());
        dni = $.trim($('#dni').val());
        $.ajax({
            url: "../bd/crud Pacientes.php",
            type: "POST",
            datatype: "json",
            data:  {ID:ID, nombre:nombre, apellido:apellido, dni:dni, opcion:opcion},
            success: function() {
                tablaPacienteActivo.ajax.reload(null, false);
                tablaPacienteInactivo.ajax.reload(null, false);
            }
        });
        $('#modalCRUD').modal('hide');
    });
    
    $("#btnNuevo").click(function(){
        $('#formPaciente')[0].reset();
        opcion = 1;
        ID = null;
        $("#formPaciente").trigger("reset");
        $(".modal-header").css( "background-color", "var(--first-color)");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Paciente");
        $('#modalCRUD').modal('show');
        $('.modal-backdrop').css('width', '100%');
    });

    $(document).on("click", ".btnEditar", function(){
        $('#formPaciente')[0].reset();
        opcion = 2;
        fila = $(this).closest("tr");
        ID = parseInt(fila.find('td:eq(0)').text());
        nombre = fila.find('td:eq(1)').text();
        apellido = fila.find('td:eq(2)').text();
        dni = fila.find('td:eq(3)').text();
        $.ajax({
            async: false,
            url: "../bd/crud principal.php",
            type: "POST",
            datatype:"json",
            data:  {opcion:opcion, ID:ID},
            success: function(data) {
                data = JSON.parse(data);
                data = data[0];
                $selectAula.val(data['ID_Aula']).trigger("change");
                $selectMateria.val(data['ID_Materia']).trigger("change");
                $('#grupo').val(data['Grupo']);
                $selectDia.val(data['Dia']).trigger("change");
                $selectHorario.val(data['ID_Horario']).trigger("change");
                IDHorarioAnt = data['ID_Horario']
                $selectDocente.val(data['ID_Docente']).trigger("change");
                $selectSitRev.val(data['Situacion_Revista']).trigger("change");
                $('#desde').val(data['Desde']);
                $('#hasta').val(data['Hasta']);
            }
        });
        $("#nombre").val(nombre);
        $("#apellido").val(apellido);
        $("#dni").val(dni);
        $(".modal-header").css("background-color", "var(--first-color)");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Paciente");
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
                url: "../bd/crud Pacientes.php",
                type: "POST",
                datatype: "json",
                data:  {opcion:opcion, ID:ID},
                success: function() {
                    tablaPacienteActivo.ajax.reload(null, false);
                    tablaPacienteInactivo.ajax.reload(null, false);
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
                url: "../bd/crud Pacientes.php",
                type: "POST",
                datatype: "json",
                data:  {opcion:opcion, ID:ID},
                success: function() {
                    tablaPacienteActivo.ajax.reload(null, false);
                    tablaPacienteInactivo.ajax.reload(null, false);
                }
            });
        }
    });
});