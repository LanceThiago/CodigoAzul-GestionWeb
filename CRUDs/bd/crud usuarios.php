<?php
    include_once 'crud functions.php';
    $DBQuerys = new DBQuerys();

    $user = (isset($_POST['user'])) ? $_POST['user'] : '';
    $NombreCompleto = (isset($_POST['NombreCompleto'])) ? $_POST['NombreCompleto'] : '';
    $password = (isset($_POST['password'])) ? $_POST['password'] : '';
    $rol = (isset($_POST['rol'])) ? $_POST['rol'] : '';
    $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
    $table = (isset($_POST['table'])) ? $_POST['table'] : '';

    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $ID = (isset($_POST['ID'])) ? $_POST['ID'] : '';

    switch($opcion){
        case 1: //Insertar
            $columns = array('Usuario', 'NombreCompleto', 'Password', 'rol');
            $password = password_hash($password, PASSWORD_DEFAULT);
            $values = array($user, $NombreCompleto, $password, $rol);
            $data = $DBQuerys->crearRegistro('usuarios', $columns, $values);
            break;
        case 2: //Editar
            if ($password != '') {
                $columns = array('Usuario', 'NombreCompleto', 'Password', 'rol');
                $password = password_hash($password, PASSWORD_DEFAULT);
                $values = array($user, $NombreCompleto, $password, $rol);
            } else {
                $columns = array('Usuario', 'NombreCompleto', 'rol');
                $values = array($user, $NombreCompleto, $rol);
            }
            $data = $DBQuerys->editarRegistro('usuarios', $columns, $values, 'ID_Usuario', $ID);
            break;
        case 3: //Borrar
            $data = $DBQuerys->estadoRegistro('usuarios', 'ID_Usuario', $ID, 0);
            break;
        case 4: //Restaurar
            $data = $DBQuerys->estadoRegistro('usuarios', 'ID_Usuario', $ID, 1);
            break;
        case 5: //Verificar existencia de registro
            $where = "Estado = $estado";
            $data = $DBQuerys->verificarExistenciaRegistro($table, 'ID_Usuario', 'Usuario', $user, $where, ['count', 'ID_Usuario']);
            break;
    }

    print json_encode($data, JSON_UNESCAPED_UNICODE);
?>