<?php
    require_once('./functions/Edit.php');
    if (isset($_POST) && count($_POST) > 0) {
        $Response = Edit($_POST);
    }
    if (!isset($_SESSION['current_session'])) header('Location: login.php');
    $user = $_SESSION['current_session']['user']['Usuario'];
    $NombreCompleto = $_SESSION['current_session']['user']['NombreCompleto'];
    include './includes/header.php';
?>
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-6 border rounded">
            <h3 class="text-center mb-3">Editar</h3>
            <?php if (isset($Response['error'])): ?>
                <div class="alert alert-danger alert-dismissable mb-3"><?php echo $Response['error']; ?></div>
            <?php endif; ?>
            <form id="editForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="user">Nombre de Usuario</label>
                            <input type="text" name="user" id="user" placeholder="Nombre de Usuario" value="<?php echo $user ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="nombreCompleto">Nombre Completo</label>
                            <input type="text" name="nombreCompleto" id="nombreCompleto" placeholder="Nombre Completo" value="<?php echo $NombreCompleto ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="passwordVerify">Confirmar contraseña</label>
                            <input type="password" name="passwordVerify" id="passwordVerify" placeholder="Confirmar contraseña" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <a href="./login.php">Volver</a>
    </div>
</div>
<?php
    include './includes/footer.php';
?>
<script src="./js/validation.js"></script>