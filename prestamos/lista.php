<?php
include('../conexion.php');

$filtroLibro   = isset($_GET['libro'])   ? $_GET['libro']   : '';
$filtroUsuario = isset($_GET['usuario']) ? $_GET['usuario'] : '';
$filtroEstado  = isset($_GET['estado'])  ? $_GET['estado']  : '';

$sql = "select p.id, l.titulo, u.nombre, p.fecha_prestamo, p.fecha_devolucion, p.estado, p.observaciones
        from prestamos p
        join libros   l on p.id_libro   = l.id
        join usuarios u on p.id_usuario = u.id
        where 1=1";

if ($filtroLibro != '') {
    $sql .= " and l.titulo like '%" . $con->real_escape_string($filtroLibro) . "%'";
}
if ($filtroUsuario != '') {
    $sql .= " and u.nombre like '%" . $con->real_escape_string($filtroUsuario) . "%'";
}
if ($filtroEstado != '') {
    $sql .= " and p.estado = '" . $con->real_escape_string($filtroEstado) . "'";
}

$consulta = mysqli_query($con, $sql);
$hoy = date('Y-m-d');
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="seccion-titulo">Prestamos</h3>
    <button class="btn btn-success btn-sm" onclick="cargarContenido('prestamos/registro.php')">+ Nuevo prestamo</button>
</div>

<div class="row mb-3 g-2">
    <div class="col-md-4">
        <input type="text" class="form-control form-control-sm" id="filtro-libro"
               placeholder="Filtrar por libro" value="<?php echo $filtroLibro; ?>">
    </div>
    <div class="col-md-4">
        <input type="text" class="form-control form-control-sm" id="filtro-usuario"
               placeholder="Filtrar por usuario" value="<?php echo $filtroUsuario; ?>">
    </div>
    <div class="col-md-3">
        <select class="form-select form-select-sm" id="filtro-estado">
            <option value="">Todos los estados</option>
            <option value="Activo"   <?php if ($filtroEstado == 'Activo')   echo 'selected'; ?>>Activo</option>
            <option value="Devuelto" <?php if ($filtroEstado == 'Devuelto') echo 'selected'; ?>>Devuelto</option>
            <option value="Vencido"  <?php if ($filtroEstado == 'Vencido')  echo 'selected'; ?>>Vencido</option>
        </select>
    </div>
    <div class="col-md-1">
        <button class="btn btn-primary btn-sm w-100" onclick="filtrarPrestamos()">Buscar</button>
    </div>
</div>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Libro</th>
            <th>Usuario</th>
            <th>Fecha prestamo</th>
            <th>Fecha devolucion</th>
            <th>Estado</th>
            <th>Observaciones</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($prestamo = mysqli_fetch_array($consulta)) {
            $vencido = ($prestamo['estado'] == 'Activo'
                     && $prestamo['fecha_devolucion'] != ''
                     && $prestamo['fecha_devolucion'] < $hoy);
        ?>
            <tr class="<?php if ($vencido) echo 'fila-vencida'; ?>">
                <td><?php echo $prestamo['titulo']; ?></td>
                <td><?php echo $prestamo['nombre']; ?></td>
                <td><?php echo $prestamo['fecha_prestamo']; ?></td>
                <td><?php echo $prestamo['fecha_devolucion']; ?></td>
                <td>
                    <?php if ($prestamo['estado'] == 'Activo')   echo '<span class="badge bg-primary">Activo</span>'; ?>
                    <?php if ($prestamo['estado'] == 'Devuelto') echo '<span class="badge bg-success">Devuelto</span>'; ?>
                    <?php if ($prestamo['estado'] == 'Vencido')  echo '<span class="badge bg-danger">Vencido</span>'; ?>
                </td>
                <td><?php echo $prestamo['observaciones']; ?></td>
                <td>
                    <?php if ($prestamo['estado'] == 'Activo') { ?>
                        <button class="btn btn-sm btn-success" onclick="cambiarEstado(<?php echo $prestamo['id']; ?>, 'Devuelto')">Devuelto</button>
                        <button class="btn btn-sm btn-warning" onclick="cambiarEstado(<?php echo $prestamo['id']; ?>, 'Vencido')">Vencido</button>
                    <?php } else { ?>
                        <button class="btn btn-sm btn-danger" onclick="eliminarPrestamo(<?php echo $prestamo['id']; ?>)">Eliminar</button>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php $con->close(); ?>
