<?php
    session_start();

    if (!isset($_SESSION['current_session'])) {
        header ('location:../../login/login.php');
    }
    require 'serverside.php';
    $estado = '';
    $table_data->get(array('registros', 'alarmas'), 'ID_Registro', array('ID_Registro','Descripcion','Origen','FechaHora','Tipo','Atendido','FechaHoraAtendido', 'SEC_TO_TIME(TIMESTAMPDIFF(SECOND, FechaHora, FechaHoraAtendido))'), array('ID_Registro','Descripcion','Origen','FechaHora','Tipo','Atendido','FechaHoraAtendido', 'TiempoRespuestart'), 'registros.ID_Alarma = alarmas.ID_Alarma', $estado, 0);
?>