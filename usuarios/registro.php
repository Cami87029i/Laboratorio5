<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card-formulario">
            <h3 class="seccion-titulo">Registrar Usuario</h3>

            <!-- formulario para registrar un usuario nuevo -->
            <form id="form-usuario">
                <div class="mb-3">
                    <label>Nombre completo</label>
                    <input type="text" class="form-control" name="nombre" id="nombre">
                    <span class="error-mensaje" id="error-nombre"></span>
                </div>
                <div class="mb-3">
                    <label>Carnet de identidad</label>
                    <input type="text" class="form-control" name="carnet" id="carnet">
                    <span class="error-mensaje" id="error-carnet"></span>
                </div>
                <div class="mb-3">
                    <label>Telefono</label>
                    <input type="text" class="form-control" name="telefono" id="telefono">
                    <span class="error-mensaje" id="error-telefono"></span>
                </div>
                <div class="mb-3">
                    <label>Correo electronico</label>
                    <input type="email" class="form-control" name="correo" id="correo">
                    <span class="error-mensaje" id="error-correo"></span>
                </div>
                <button type="button" class="btn btn-primary" onclick="registrarUsuario()">Registrar</button>
                <button type="button" class="btn btn-secondary" onclick="cargarContenido('usuarios/lista.php')">Cancelar</button>
            </form>
        </div>
    </div>
</div>
