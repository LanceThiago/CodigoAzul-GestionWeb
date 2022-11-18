<?php
    session_start();
    if ($_SESSION['current_session']['user']['Rol'] == 'admin' || $_SESSION['current_session']['user']['Rol'] == 'editor') {
        include_once 'crud functions.php';
        $DBQuerys = new DBQuerys();
        $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
        $ID_Ubicacion = (isset($_POST['ID_Ubicacion'])) ? $_POST['ID_Ubicacion'] : '';
        $origen = (isset($_POST['origen'])) ? $_POST['origen'] : '';
        $ip = (isset($_POST['ip'])) ? $_POST['ip'] : '';
        $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
        $password = (isset($_POST['password'])) ? $_POST['password'] : '';
    
        $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
        $ID = (isset($_POST['ID'])) ? $_POST['ID'] : '';
    
        switch($opcion){
            case 1: //Insertar
                $columns = array('Descripcion', 'ID_Ubicacion', 'Origen', 'IP', 'Usuario', 'Password', 'Editado');
                $values = array($descripcion, $ID_Ubicacion, $origen, $ip, $usuario, $password, date('Y-m-d H:i:s'));
                $data = $DBQuerys->crearRegistro('alarmas', $columns, $values);
                break;
            case 2: //Editar
                $columns = array('Descripcion', 'ID_Ubicacion', 'Origen', 'IP', 'Usuario', 'Password', 'Editado');
                $values = array($descripcion, $ID_Ubicacion, $origen, $ip, $usuario, $password, date('Y-m-d H:i:s'));
                $data = $DBQuerys->editarRegistro('alarmas', $columns, $values, 'ID_Alarma', $ID);
                break;
            case 3: //Borrar
                $data = $DBQuerys->estadoRegistro('alarmas', 'ID_Alarma', $ID, 0);
                break;
            case 4: //Restaurar
                $data = $DBQuerys->estadoRegistro('alarmas', 'ID_Alarma', $ID, 1);
                break;
        }
    } else {
        $data = false;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);
?>