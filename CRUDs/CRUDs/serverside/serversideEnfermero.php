<?php
    session_start();

    if (!isset($_SESSION['current_session'])) {
        header ('location:../../login/login.php');
    }
    require 'serverside.php';
    $estado = (isset($_GET['estado'])) ? $_GET['estado'] : '1';
    $table_data->get(array('Enfermeros'), 'ID_Enfermero', array('ID_Enfermero','Nombre','Apellido','DNI','Creado','Editado','Estado'), array('ID_Enfermero','Nombre','Apellido','DNI','Creado','Editado','Estado'), '', $estado, 0);
?>