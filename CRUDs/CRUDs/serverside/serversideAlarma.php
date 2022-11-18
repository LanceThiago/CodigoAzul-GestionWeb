<?php
    session_start();

    if (!isset($_SESSION['current_session'])) {
        header ('location:../../login/login.php');
    }
    require 'serverside.php';
    $estado = (isset($_GET['estado'])) ? $_GET['estado'] : '1';
    $table_data->get(array('alarmas', 'ubicaciones'), 'ID_Alarma', array('ID_Alarma','Descripcion','CONCAT(ubicaciones.Area, " ", ubicaciones.Sala, ", Piso ", ubicaciones.Piso)','Origen','IP','Usuario','Password','alarmas.Creado','alarmas.Editado','alarmas.Estado'), array('ID_Alarma', 'Descripcion', 'Ubicacion', 'Origen','IP','Usuario','Password', 'Creado', 'Editado', 'Estado'), 'ubicaciones.ID_Ubicacion = alarmas.ID_Ubicacion', $estado, 0);
?>