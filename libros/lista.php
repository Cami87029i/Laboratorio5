<?php
include('../conexion.php');

$sql = "select id, titulo, autor, isbn, categoria, stock from libros";
$consulta = mysqli_query($con, $sql);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="seccion-titulo">Lista de Libros</h3>
    <button class="btn btn-success btn-sm" onclick="cargarContenido('libros/registro.php')">+ Nuevo libro</button>
</div>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Autor</th>
            <th>ISBN</th>
            <th>Categoria</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($libro = mysqli_fetch_array($consulta)) { ?>
            <tr>
                <td><?php echo $libro['titulo']; ?></td>
                <td><?php echo $libro['autor']; ?></td>
                <td><?php echo $libro['isbn']; ?></td>
                <td><?php echo $libro['categoria']; ?></td>
                <td><?php echo $libro['stock']; ?></td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="cargarEditarLibro(<?php echo $libro['id']; ?>)">Editar</button>
                    <button class="btn btn-sm btn-danger"  onclick="eliminarLibro(<?php echo $libro['id']; ?>)">Eliminar</button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php $con->close(); ?>
