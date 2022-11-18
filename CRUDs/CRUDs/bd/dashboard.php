<?php
    session_start();
    if ($_SESSION['current_session']['user']['Rol'] == 'admin' || $_SESSION['current_session']['user']['Rol'] == 'editor') {
        include_once 'crud functions.php';
        $DBQuerys = new DBQuerys();

        $table = (isset($_POST['table'])) ? $_POST['table'] : '';
        $indexColumn = (isset($_POST['indexColumn'])) ? $_POST['indexColumn'] : '';
        $columns = (isset($_POST['columns'])) ? $_POST['columns'] : '';
        $where = (isset($_POST['where'])) ? $_POST['where'] : '';
        $status = (isset($_POST['status'])) ? $_POST['status'] : '';
        $columnInicio = (isset($_POST['columnInicio'])) ? $_POST['columnInicio'] : '';
        $columnFinal = (isset($_POST['columnFinal'])) ? $_POST['columnFinal'] : '';
        $as = (isset($_POST['as'])) ? $_POST['as'] : '';
    
        $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
        $ID = (isset($_POST['ID'])) ? $_POST['ID'] : '';
    
        switch($opcion){
            case 1: //Contar registros
                $data = $DBQuerys->count($table, $indexColumn, $where, $status);
                break;
            case 2: //Promedio respuesta
                $data = $DBQuerys->promedioRespuesta($table, $columnInicio, $columnFinal, $as);
                break;
            case 3: //Minimo tiemo de respuesta
                $data = $DBQuerys->min($table, $columnInicio, $columnFinal, $as);
            break;
            case 4: //maximo tiempo de respuesta
                $data = $DBQuerys->max($table, $columnInicio, $columnFinal, $as);
                break;
        }
    } else {
        $data = false;
    }
    print json_encode($data, JSON_UNESCAPED_UNICODE);
?>