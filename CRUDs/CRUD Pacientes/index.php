<?php
    include('../includes/head.php');
?>
<h1 class="pt-2">Tabla Pacientes <span id="activo"></span></h1>
<?php if (isset($roleBool)): ?>
<div class="row pb-3">
    <div class="col-6"><button id="btnNuevo" type="button" class="btn table_button col-12" data-toggle="modal"><i class="bx bx-add-to-queue"></i> Nuevo</button></div>
    <div class="col-6"><button id="btnEstado" type="button" class="btn table_button col-12" data-toggle="modal"><i class="bx bx-copy-alt"></i> Cambiar Vista</button></div>
</div>
<?php endif; ?>

<select id="ID_Paciente">
    <option value=""></option>
</select>


<form style="display:none;" action="" id="formPacienteEdit">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nombreEdit" placeholder=" ">
            <label for="nombreEdit">Nombre/s</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="apellidoEdit" placeholder=" ">
            <label for="apellidoEdit">Apellido/s</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="dniEdit" placeholder=" ">
            <label for="dniEdit">DNI</label>
        </div>
        <div class="form-floating mb-3">
            <input type="tel" class="form-control" id="telefonoEdit" placeholder=" ">
            <label for="telefonoEdit">Telefono</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="dirEdit" placeholder=" ">
            <label for="dirEdit">Direccion</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="localidadEdit" placeholder=" ">
            <label for="localidadEdit">Localidad</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="provinciaEdit" placeholder=" ">
            <label for="provinciaEdit">Provincia</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="obraEdit" placeholder=" ">
            <label for="obraEdit">Obra Social</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="obraNroEdit" placeholder=" ">
            <label for="obraNroEdit">Numero de Obra Social</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="medicoEdit" placeholder=" ">
            <label for="medicoEdit">Medico de Cabecera</label>
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" id="padecimientoEdit" placeholder=" "></textarea>
            <label for="padecimientoEdit">Padecimiento</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="grupoEdit" placeholder=" ">
            <label for="grupoEdit">Grupo Sanguineo</label>
        </div>
        <div class="form-floating mb-3">
            <select id="ID_EnfermeroEdit">
                <option value=""></option>
            </select>
        </div>
        <div class="form-floating mb-3">
            <select id="ID_UbicacionEdit">
                <option value=""></option>
            </select>
        </div>
        <button type="submit" id="btnGuardar" class="col-12 mb-3 btn btn-outline-white table_button">Guardar</button>
        <button type="button" class="col-12 mb-3 btn btn-outline-white table_button btnBorrar"><i class="bx bx-eraser"></i> Eliminar registro</button>
</form>

<button style="display:none;" type="button" class="col-12 mt-3 btn btn-outline-white table_button btnRestaurar"><i class="bx bx-edit"></i> Restaurar registro</button>

<div id="date" class="row">
    <div id="creado" class="col"></div>
    <div id="editado" class="col"></div>
</div>

<div style="width:100%;" class="modal fade" id="modalCRUD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" id="formPaciente">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombre" placeholder=" ">
                        <label for="nombre">Nombre/s</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="apellido" placeholder=" ">
                        <label for="apellido">Apellido/s</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="dni" placeholder=" ">
                        <label for="dni">DNI</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="telefono" placeholder=" ">
                        <label for="telefono">Telefono</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="dir" placeholder=" ">
                        <label for="dir">Direccion</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="localidad" placeholder=" ">
                        <label for="localidad">Localidad</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="provincia" placeholder=" ">
                        <label for="provincia">Provincia</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="obra" placeholder=" ">
                        <label for="obra">Obra Social</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="obraNro" placeholder=" ">
                        <label for="obraNro">Numero de Obra Social</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="medico" placeholder=" ">
                        <label for="medico">Medico de Cabecera</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="padecimiento" placeholder=" "></textarea>
                        <label for="padecimiento">Padecimiento</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="grupo" placeholder=" ">
                        <label for="grupo">Grupo Sanguineo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="ID_Enfermero">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="ID_Ubicacion">
                            <option value=""></option>
                        </select>
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