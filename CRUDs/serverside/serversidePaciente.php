<?php
    session_start();

    if (!isset($_SESSION['current_session'])) {
        header ('location:../../login/login.php');
    }
    require 'serverside.php';
    $estado = (isset($_GET['estado'])) ? $_GET['estado'] : '1';
    $table_data->get(array('alarmas'), 'ID_Alarma', array('ID_Alarma','Descripcion','ID_Ubicacion','Origen','Creado','Editado','Estado'), array('ID_Alarma','Descripcion','ID_Ubicacion','Origen','Creado','Editado','Estado'), '', $estado, 0);
?>