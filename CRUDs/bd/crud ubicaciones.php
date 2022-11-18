<?php
    session_start();
    if ($_SESSION['current_session']['user']['Rol'] == 'admin' || $_SESSION['current_session']['user']['Rol'] == 'editor') {
        include_once 'crud functions.php';
        $DBQuerys = new DBQuerys();

        $piso = (isset($_POST['piso'])) ? $_POST['piso'] : '';
        $area = (isset($_POST['area'])) ? $_POST['area'] : '';
        $sala = (isset($_POST['sala'])) ? $_POST['sala'] : '';

        $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
        $ID = (isset($_POST['ID'])) ? $_POST['ID'] : '';

        switch($opcion){
            case 1: //Insertar
                $columns = array('Piso', 'Area', 'Sala', 'Editado');
                $values = array($piso, $area, $sala, date('Y-m-d H:i:s'));
                $data = $DBQuerys->crearRegistro('ubicaciones', $columns, $values);
                break;
            case 2: //Editar
                $columns = array('Piso', 'Area', 'Sala', 'Editado');
                $values = array($piso, $area, $sala, date('Y-m-d H:i:s'));
                $data = $DBQuerys->editarRegistro('ubicaciones', $columns, $values, 'ID_Ubicacion', $ID);
                break;
            case 3: //Borrar
                $data = $DBQuerys->estadoRegistro('ubicaciones', 'ID_Ubicacion', $ID, 0);
                break;
            case 4: //Restaurar
                $data = $DBQuerys->estadoRegistro('ubicaciones', 'ID_Ubicacion', $ID, 1);
                break;
        }
    } else {
        $data = false;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);
?>