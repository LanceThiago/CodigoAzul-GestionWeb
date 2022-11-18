<?php
    session_start();

    if (!isset($_SESSION['current_session'])) {
        header ('location:../../login/login.php');
    }
    require 'serverside.php';
    $estado = (isset($_GET['estado'])) ? $_GET['estado'] : '1';
    $table_data->get(array('ubicaciones'), 'ID_Ubicacion', array('ID_Ubicacion','Piso','Area','Sala','Creado','Editado','Estado'), array('ID_Ubicacion','Piso','Area','Sala','Creado','Editado','Estado'), '', $estado, 0);
?>