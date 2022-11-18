<?php
    session_start();

    if (!isset($_SESSION['current_session']) || $_SESSION['current_session']['user']['Rol'] != 'admin') {
        header ('location:../../login/login.php');
    }
    
    require 'serverside.php';
    $estado = (isset($_GET['estado'])) ? $_GET['estado'] : '1';
    $table_data->get(array('usuarios'), 'ID_Usuario', array('ID_Usuario','Usuario','NombreCompleto','rol','Creado','Editado','Estado'), array('ID_Usuario','Usuario','NombreCompleto','rol','Creado','Editado','Estado'), '', $estado, 0);
?>