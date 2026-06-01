<?php
include('../conexion.php');

// carga los datos del usuario para editar
$id = $_GET['id'];
$sql = "select * from usuarios where id = " . $id;
$consulta = mysqli_query($con, $sql);
$usuario  = mysqli_fetch_array($consulta);
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card-formulario">
            <h3 class="seccion-titulo">Editar Usuario</h3>

            <!-- formulario con datos del usuario precargados -->
            <form id="form-editar-usuario">
                <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                <div class="mb-3">
                    <label>Nombre completo</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $usuario['nombre']; ?>">
                </div>
                <div class="mb-3">
                    <label>Carnet de identidad</label>
                    <input type="text" class="form-control" name="carnet" value="<?php echo $usuario['carnet']; ?>">
                </div>
                <div class="mb-3">
                    <label>Telefono</label>
                    <input type="text" class="form-control" name="telefono" value="<?php echo $usuario['telefono']; ?>">
                </div>
                <div class="mb-3">
                    <label>Correo electronico</label>
                    <input type="email" class="form-control" name="correo" id="correo" value="<?php echo $usuario['correo']; ?>">
                </div>
                <button type="button" class="btn btn-primary" onclick="actualizarUsuario()">Actualizar</button>
                <button type="button" class="btn btn-secondary" onclick="cargarContenido('usuarios/lista.php')">Cancelar</button>
            </form>
        </div>
    </div>
</div>

<?php $con->close(); ?>
