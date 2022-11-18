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
<style>
    body{
        background-color: #001D6E;
    }
    #titulo{
        color:white !important;
    }
    ::placeholder{
        color:white !important;
    }


</style>
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-12 col-lg-6">
            <h3 id="titulo" class="text-center mb-3 ">Gestion de Alarma Codigo Azul</h3>
            <?php if (isset($Response['error'])): ?>
                <div class="alert alert-danger alert-dismissable mb-3"><?php echo $Response['error']; ?></div>
            <?php endif; ?>
            <div class="d-flex justify-content-center">
                <div style="width:min-content;  background-color:#7FB5FF;  border-radius: 50%">
                    <img src="../images/logoicono.png" class="m-5 d-flex justify-content-center" height="200px">
                </div>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="row">
                    <div class="col-12">
                        <div class="input-group rounded-0 bg-transparent mb-3 pt-3">
                                <span class="input-group-text rounded-0 bg-transparent border-0 border-bottom" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"></path>
                                </svg></span>
                                <input type="text" name="user" id="user" placeholder="Usuario" class="form-control rounded-0 bg-transparent border-0 border-bottom" >
                        </div>
                        
                    </div>

                    <div class="col-12">
                    <div class="input-group rounded-0 bg-transparent mb-3">
                                <span class="input-group-text rounded-0 bg-transparent border-0 border-bottom" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-lock" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                                </svg></span>
                                
                                <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control rounded-0 bg-transparent border-0 border-bottom" >
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group d-flex justify-content-center mt-4 mb-4">
                            <button type="submit" class="btn btn-light">Login</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
<?php
    include './includes/footer.php';
?>