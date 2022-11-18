<?php
    session_start();

    if (!isset($_SESSION['current_session'])) {
        header ('location:../../login/login.php');
    }
    require 'serverside.php';
    $estado = (isset($_GET['estado'])) ? $_GET['estado'] : '1';
    $table_data->get(array('displays', 'ubicaciones'), 'ID_Display', array('ID_Display','Descripcion','CONCAT(ubicaciones.Area, " ", ubicaciones.Sala, ", Piso ", ubicaciones.Piso)','IP','Usuario','Password','displays.Creado','displays.Editado','displays.Estado'), array('ID_Display', 'Descripcion', 'Ubicacion','IP','Usuario','Password', 'Creado', 'Editado', 'Estado'), 'ubicaciones.ID_Ubicacion = displays.ID_Ubicacion', $estado, 0);
?>