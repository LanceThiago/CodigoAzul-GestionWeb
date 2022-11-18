<?php
    session_start();
    if (!isset($_SESSION['current_session'])) {
        header('Location: ../../login/login.php');
    }
    if ($_SESSION['current_session']['user']['Rol'] == 'admin' || $_SESSION['current_session']['user']['Rol'] == 'editor') {
        $roleBool = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" type="text/css" href="../../datatables/Responsive-2.3.0/css/responsive.bootstrap5.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../../select2/css/select2.min.css">
    <title></title>
</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="navbar_icon"> <i class='bx bx-menu' id="header-toggle"></i></div>
        <div class="text-center"> 
            <a href="../../login/functions/logout.php" class="navbar_link">
                <i class='bx bx-log-out navbar_icon'></i>
            </a>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="../" class="nav_logo">
                    <i class='bx bx-plus-medical nav_logo-icon'></i>
                    <span class="nav_logo-name">Codigo Azul</span>
                </a>
                <div class="nav_list">
                    <a id="dashboard" href="../dashboard/" class="nav_link">
                        <i class='bx bx-clipboard nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    <a id="alarmas" href="../crud alarmas/" class="nav_link">
                        <i class='bx bx-bell nav_icon'></i>
                        <span class="nav_name">Alarmas</span>
                    </a>
                    <a id="enfermeros" href="../crud enfermeros/" class="nav_link">
                        <i class='bx bx-male nav_icon'></i>
                        <span class="nav_name">Enfermeros</span>
                    </a>
                    <a id="pacientes" href="../crud pacientes/" class="nav_link">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Pacientes</span>
                    </a>
                    <a id="ubicaciones" href="../crud ubicaciones/" class="nav_link">
                        <i class='bx bx-door-open nav_icon'></i>
                        <span class="nav_name">Ubicaciones</span>
                    </a>
                    <?php if (isset($roleBool)): ?>
                    <a id="usuarios" href="../crud usuarios/" class="nav_link">
                        <i class='bx bx-group nav_icon'></i>
                        <span class="nav_name">Usuarios</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <a href="#" class="nav_link">
                <i class='bx bx-info-circle nav_icon'></i>
                <span class="nav-blind">Info</span>
            </a>
        </nav>
    </div>
    <main>
        <div class="row">
            <div class="col-12">