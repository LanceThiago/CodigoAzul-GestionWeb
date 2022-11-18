$(document).ready(function() {
    var ID, opcion, estado = 1;
    estado = 1;
    $('#activo').text('(activos)');

    $('#pacientes').addClass('active');
    $('title').text('Control Panel - CRUD Pacientes');

    var $selectPaciente = $('#ID_Paciente');
    $selectPaciente.select2({
        placeholder: 'Paciente',
        width: '100%'
    });

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
    
    var $select2 = $('.select2-selection');
    $('.select2-selection__arrow').height('58px');
    $select2.height('58px');
    $select2.addClass('d-flex align-items-center');
    $select2.css('border-color', '#ced4da');

    $selectPaciente.on('change', function() {
        if (estado == 1) {
            $('#formPacienteEdit')[0].reset();
            $("#formPacienteEdit").show();
            ID = $(this).val();
            table = 'pacientes';
            indexColumn = 'ID_Paciente';
            columns = ['Nombre', 'Apellido', 'DNI', 'Telefono', 'Direccion', 'Localidad', 'Provincia', 'Obra_Social', 'NroObraSocial', 'Medico_Cabecera', 'Padecimiento', 'GrupoSanguineo', 'ID_Enfermero', 'ID_Ubicacion', 'Creado', 'Editado'];
            where = 'ID_Paciente = "' + $(this).val() + '"';
            $.ajax({
                url: "../bd/obtenerDatosSelect.php",
                type: "POST",
                datatype: "json",
                data: {table:table, indexColumn:indexColumn, columns:columns, where:where},
                success: function(data) {
                    data = JSON.parse(data);
                    $("#nombreEdit").val(data[0]['Nombre']);
                    $("#apellidoEdit").val(data[0]['Apellido']);
                    $("#dniEdit").val(data[0]['DNI']);
                    $("#telefonoEdit").val(data[0]['Telefono']);
                    $("#dirEdit").val(data[0]['Direccion']);
                    $("#localidadEdit").val(data[0]['Localidad']);
                    $("#provinciaEdit").val(data[0]['Provincia']);
                    $("#obraEdit").val(data[0]['Obra_Social']);
                    $("#obraNroEdit").val(data[0]['NroObraSocial']);
                    $("#medicoEditEdit").val(data[0]['Medico_Cabecera']);
                    $("#padecimientoEdit").val(data[0]['Padecimiento']);
                    $selectEnfermeroEdit.val(data[0]['ID_Enfermero']).trigger("change");
                    $selectUbicacionEdit.val(data[0]['ID_Ubicacion']).trigger("change");
                    $('.btnBorrar').attr('data-id', ID);
                    $('#btnGuardar').attr('data-id', ID);
                    $('#creado').text('Creado: ' + data[0]['Creado']);
                    $('#editado').text('Editado: ' + data[0]['Editado']);
                }
            });
            where = 'Estado = ' + estado;
        } else {
            $(".btnRestaurar").show();
            $('.btnRestaurar').attr('data-id', ID);
        }
    });

    $('#btnEstado').on('click', function(e) {
        e.preventDefault();
        if (estado == 1) {
            where = 'Estado = 0';
            $("#formPacienteEdit").hide();
            estado = 0;
            $('#activo').text('(inactivos)');
        } else {
            where = '';
            estado = 1;
            $(".btnRestaurar").hide();
            $('#activo').text('(activos)');
        }
        restaurarPacientes();
        $('#creado').text('');
        $('#editado').text('');
    });

    $('#formPaciente').submit(function(e){
        e.preventDefault();
        nombre = $.trim($('#nombre').val());
        apellido = $.trim($('#apellido').val());
        dni = $.trim($('#dni').val());
        telefono = $.trim($('#telefono').val());
        dir = $.trim($('#dir').val());
        localidad = $.trim($('#localidad').val());
        provincia = $.trim($('#provincia').val());
        obra = $.trim($('#obra').val());
        obraNro = $.trim($('#obraNro').val());
        medico = $.trim($('#medico').val());
        padecimiento = $.trim($('#padecimiento').val());
        grupo = $.trim($('#grupo').val());
        ID_Enfermero = $.trim($('#ID_Enfermero').val());
        ID_Ubicacion = $.trim($('#ID_Ubicacion').val());
        opcion = 1;
        $.ajax({
            url: "../bd/crud Pacientes.php",
            type: "POST",
            datatype: "json",
            data:  {nombre:nombre, apellido:apellido, dni:dni, telefono:telefono, dir:dir, localidad:localidad, provincia:provincia, obra:obra, obraNro:obraNro, medico:medico, padecimiento:padecimiento, grupo:grupo, ID_Enfermero:ID_Enfermero, ID_Ubicacion:ID_Ubicacion, opcion:opcion},
            success: function(data) {
                restaurarPacientes();
                $('#modalCRUD').modal('hide');
            }
        });
    });

    $('#formPacienteEdit').submit(function(e){
        e.preventDefault();
        nombre = $.trim($('#nombreEdit').val());
        apellido = $.trim($('#apellidoEdit').val());
        dni = $.trim($('#dniEdit').val());
        telefono = $.trim($('#telefonoEdit').val());
        dir = $.trim($('#dirEdit').val());
        localidad = $.trim($('#localidadEdit').val());
        provincia = $.trim($('#provinciaEdit').val());
        obra = $.trim($('#obraEdit').val());
        obraNro = $.trim($('#obraNroEdit').val());
        medico = $.trim($('#medicoEdit').val());
        padecimiento = $.trim($('#padecimientoEdit').val());
        grupo = $.trim($('#grupoEdit').val());
        ID_Enfermero = $.trim($('#ID_EnfermeroEdit').val());
        ID_Ubicacion = $.trim($('#ID_UbicacionEdit').val());
        opcion = 2;
        $.ajax({
            url: "../bd/crud Pacientes.php",
            type: "POST",
            datatype: "json",
            data:  {ID:ID, nombre:nombre, apellido:apellido, dni:dni, telefono:telefono, dir:dir, localidad:localidad, provincia:provincia, obra:obra, obraNro:obraNro, medico:medico, padecimiento:padecimiento, grupo:grupo, ID_Enfermero:ID_Enfermero, ID_Ubicacion:ID_Ubicacion, opcion:opcion},
            success: function() {
                restaurarPacientes();
                $('#formPacienteEdit')[0].reset();
                $("#formPacienteEdit").hide();
            }
        });
    });
    
    $("#btnNuevo").click(function(){
        $('#formPaciente')[0].reset();
        ID = null;
        $("#formPaciente").trigger("reset");
        $(".modal-header").css( "background-color", "var(--first-color)");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Paciente");
        $('#modalCRUD').modal('show');
        $('.modal-backdrop').css('width', '100%');
    });

    $(document).on("click", ".btnBorrar", function(){
        ID = $('.btnBorrar').attr('data-id');
        opcion = 3;
        var respuesta = confirm("¿Está seguro de que desesa borrar el registro " + ID + "?");
        if (respuesta) {
            $.ajax({
                url: "../bd/crud Pacientes.php",
                type: "POST",
                datatype: "json",
                data:  {opcion:opcion, ID:ID},
                success: function() {
                    restaurarPacientes();
                    $('#formPacienteEdit')[0].reset();
                    $("#formPacienteEdit").hide();
                }
            });
        }
    });

    $(document).on("click", ".btnRestaurar", function(){
        ID = $('.btnBorrar').attr('data-id');
        opcion = 4;
        var respuesta = confirm("¿Está seguro de que desea restaurar el registro " + ID + "?");
        if (respuesta) {
            $.ajax({
                url: "../bd/crud Pacientes.php",
                type: "POST",
                datatype: "json",
                data:  {opcion:opcion, ID:ID},
                success: function() {
                    restaurarPacientes();
                }
            });
        }
    });

    function restaurarPacientes() {
        $selectPaciente.children().remove();
        $('#ID_Paciente').append('<option value=""></option>');
        $('#formPacienteEdit')[0].reset();

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
    }
});