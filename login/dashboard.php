<?php
    session_start();
    if (!isset($_SESSION['current_session'])) {
        header('Location: login.php');
    } else {
        if ($_SESSION['current_session']['user']['Rol'] != 'admin') {
            header('Location: login.php');
        }
    }
    include './includes/header.php';
?>
<div class="container mb-8">
    <div class="row center-align">
        <div class="jumbotron col-12">
                <div class="row">
                    <div class="col-6">
                        <p class="mb-4">Dashboard</p>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="functions/Logout.php" class="mb-4">Sing-Out</a>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="./edit.php" class="mb-4">Editar datos de usuario</a>
                    </div>
                </div>
            <hr>
        </div>
    </div>
</div>
<?php
    include './includes/footer.php';
?>