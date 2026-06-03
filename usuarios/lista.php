<?php
include('../conexion.php');

$sql = "select id, nombre, carnet, telefono, correo from usuarios";
$consulta = mysqli_query($con, $sql);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="seccion-titulo">Lista de Usuarios</h3>
    <button class="btn btn-success btn-sm" onclick="cargarContenido('usuarios/registro.php')">+ Nuevo usuario</button>
</div>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Carnet</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($usuario = mysqli_fetch_array($consulta)) { ?>
            <tr>
                <td><?php echo $usuario['nombre']; ?></td>
                <td><?php echo $usuario['carnet']; ?></td>
                <td><?php echo $usuario['telefono']; ?></td>
                <td><?php echo $usuario['correo']; ?></td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="cargarEditarUsuario(<?php echo $usuario['id']; ?>)">Editar</button>
                    <button class="btn btn-sm btn-danger"  onclick="eliminarUsuario(<?php echo $usuario['id']; ?>)">Eliminar</button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php $con->close(); ?>
