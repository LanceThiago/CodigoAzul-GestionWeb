<?php
    session_start();
    if ($_SESSION['current_session']['user']['Rol'] == 'admin' || $_SESSION['current_session']['user']['Rol'] == 'editor') {
        include_once 'crud functions.php';
        $DBQuerys = new DBQuerys();

        $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
        $apellido = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
        $dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
        $telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
        $dir = (isset($_POST['dir'])) ? $_POST['dir'] : '';
        $localidad = (isset($_POST['localidad'])) ? $_POST['localidad'] : '';
        $provincia = (isset($_POST['provincia'])) ? $_POST['provincia'] : '';
        $obra = (isset($_POST['obra'])) ? $_POST['obra'] : '';
        $obraNro = (isset($_POST['obraNro'])) ? $_POST['obraNro'] : '';
        $medico = (isset($_POST['medico'])) ? $_POST['medico'] : '';
        $padecimiento = (isset($_POST['padecimiento'])) ? $_POST['padecimiento'] : '';
        $grupo = (isset($_POST['grupo'])) ? $_POST['grupo'] : '';
        $ID_Enfermero = (isset($_POST['ID_Enfermero'])) ? $_POST['ID_Enfermero'] : '';
        $ID_Ubicacion = (isset($_POST['ID_Ubicacion'])) ? $_POST['ID_Ubicacion'] : '';

        $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
        $ID = (isset($_POST['ID'])) ? $_POST['ID'] : '';

        switch($opcion){
            case 1: //Insertar
                $columns = array('Nombre', 'Apellido', 'DNI', 'Telefono', 'Direccion', 'Localidad', 'Provincia', 'Obra_Social', 'NroObraSocial', 'Medico_Cabecera', 'Padecimiento', 'GrupoSanguineo', 'ID_Enfermero', 'ID_Ubicacion', 'Editado');
                $values = array($nombre, $apellido, $dni, $telefono, $dir, $localidad, $provincia, $obra, $obraNro, $medico, $padecimiento, $grupo, $ID_Enfermero, $ID_Ubicacion, date('Y-m-d H:i:s'));
                $data = $DBQuerys->crearRegistro('pacientes', $columns, $values);
                break;
            case 2: //Editar
                $columns = array('Nombre', 'Apellido', 'DNI', 'Telefono', 'Direccion', 'Localidad', 'Provincia', 'Obra_Social', 'NroObraSocial', 'Medico_Cabecera', 'Padecimiento', 'GrupoSanguineo', 'ID_Enfermero', 'ID_Ubicacion', 'Editado');
                $values = array($nombre, $apellido, $dni, $telefono, $dir, $localidad, $provincia, $obra, $obraNro, $medico, $padecimiento, $grupo, $ID_Enfermero, $ID_Ubicacion, date('Y-m-d H:i:s'));
                $data = $DBQuerys->editarRegistro('pacientes', $columns, $values, 'ID_Paciente', $ID);
                break;
            case 3: //Borrar
                $data = $DBQuerys->estadoRegistro('pacientes', 'ID_Paciente', $ID, 0);
                break;
            case 4: //Restaurar
                $data = $DBQuerys->estadoRegistro('pacientes', 'ID_Paciente', $ID, 1);
                break;
        }
    } else {
        $data = false;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);
?>  