<?php
    include('../includes/head.php');
?>
<h1 class="pt-2">Tabla Displays</h1>
<?php if (isset($roleBool)): ?>
<div class="row pb-3">
    <div class="col-6"><button id="btnNuevo" type="button" class="btn table_button col-12" data-toggle="modal"><i class="bx bx-add-to-queue"></i> Nuevo</button></div>
    <div class="col-6"><button id="btnEstado" type="button" class="btn table_button col-12" data-toggle="modal"><i class="bx bx-copy-alt"></i> Cambiar Vista</button></div>
</div>
<?php endif; ?>

<table id="tablaDisplaysActivo" class="table" style="width:100%">
    <thead class="text-center">
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Ubicacion</th>
            <th>IP</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Creado</th>
            <th>Ultimo Cambio</th>
            <th>Activo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<table id="tablaDisplaysInactivo" class="table" style="width:100%">
    <thead class="text-center">
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Ubicacion</th>
            <th>Creado</th>
            <th>IP</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Ultimo Cambio</th>
            <th>Activo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<div style="width:100%;" class="modal fade" id="modalCRUD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" id="formDisplay">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="descripcion" placeholder=" ">
                        <label for="descripcion">Descipcion</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="ID_Ubicacion" id="ID_Ubicacion">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="ip" placeholder=" ">
                        <label for="ip">IP</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="usuario" placeholder=" ">
                        <label for="usuario">Usuario</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="password" placeholder=" ">
                        <label for="password">Contraseña</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-white" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-outline-white table_button">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    include('../includes/footer.php');
?>