<?php
    require_once('./functions/Login.php');
    if (isset($_POST) && count($_POST) > 0) {
        $Response = Login($_POST);
    }
    if (isset($_SESSION['current_session'])) {
        header ('location:../CRUDs/dashboard/index.php');
    }
    include './includes/header.php';
?>
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-6 border rounded">
            <h3 class="text-center mb-3">Login</h3>
            <?php if (isset($Response['error'])): ?>
                <div class="alert alert-danger alert-dismissable mb-3"><?php echo $Response['error']; ?></div>
            <?php endif; ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="user">Usuario</label>
                            <input type="text" name="user" id="user" placeholder="Nombre de Usuario" class="form-control">
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
                            <button type="submit" class="btn btn-success btn-block">Login</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    include './includes/footer.php';
?>