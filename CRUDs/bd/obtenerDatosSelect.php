<?php
    include_once 'crud functions.php';
    $DBQuerys = new DBQuerys();
    
    $table = (isset($_POST['table'])) ? $_POST['table'] : '';
    $indexColumn = (isset($_POST['indexColumn'])) ? $_POST['indexColumn'] : '';
    $columns = (isset($_POST['columns'])) ? $_POST['columns'] : '';
    $where = (isset($_POST['where'])) ? $_POST['where'] : '';

    $data = $DBQuerys->select($table, $indexColumn, $columns, $where);
    echo json_encode($data);
?>