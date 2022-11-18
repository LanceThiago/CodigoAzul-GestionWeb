<?php
    session_start();
    if ($_SESSION['current_session']['user']['Rol'] == 'admin' || $_SESSION['current_session']['user']['Rol'] == 'editor') {
        include_once 'crud functions.php';
        $DBQuerys = new DBQuerys();

        $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
        $apellido = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
        $dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';

        $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
        $ID = (isset($_POST['ID'])) ? $_POST['ID'] : '';

        switch($opcion){
            case 1: //Insertar
                $columns = array('Nombre', 'Apellido', 'DNI');
                $values = array($nombre, $apellido, $dni);
                $data = $DBQuerys->crearRegistro('Enfermeros', $columns, $values);
                break;
            case 2: //Editar
                $columns = array('Nombre', 'Apellido', 'DNI');
                $values = array($nombre, $apellido, $dni);
                $data = $DBQuerys->editarRegistro('Enfermeros', $columns, $values, 'ID_Enfermero', $ID);
                break;
            case 3: //Borrar
                $data = $DBQuerys->estadoRegistro('Enfermeros', 'ID_Enfermero', $ID, 0);
                break;
            case 4: //Restaurar
                $data = $DBQuerys->estadoRegistro('Enfermeros', 'ID_Enfermero', $ID, 1);
                break;
        }
    } else {
        $data = false;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);
?>  