<?php
include('../conexion.php');

$id = $_GET['id'];
$sql = "select * from libros where id = " . $id;
$consulta = mysqli_query($con, $sql);
$libro = mysqli_fetch_array($consulta);
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card-formulario">
            <h3 class="seccion-titulo">Editar Libro</h3>

            <form id="form-editar-libro">
                <input type="hidden" name="id" value="<?php echo $libro['id']; ?>">

                <div class="mb-3">
                    <label>Titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $libro['titulo']; ?>">
                    <small id="error-titulo" class="error-mensaje"></small>
                </div>

                <div class="mb-3">
                    <label>Autor</label>
                    <input type="text" class="form-control" id="autor" name="autor" value="<?php echo $libro['autor']; ?>">
                    <small id="error-autor" class="error-mensaje"></small>
                </div>

                <div class="mb-3">
                    <label>ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $libro['isbn']; ?>">
                    <small id="error-isbn" class="error-mensaje"></small>
                </div>

                <div class="mb-3">
                    <label>Categoria</label>
                    <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $libro['categoria']; ?>">
                    <small id="error-categoria" class="error-mensaje"></small>
                </div>

                <div class="mb-3">
                    <label>Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $libro['stock']; ?>" min="0">
                    <small id="error-stock" class="error-mensaje"></small>
                </div>

                <button type="button" class="btn btn-primary" onclick="actualizarLibro()">Actualizar</button>

                <button type="button" class="btn btn-secondary" onclick="cargarContenido('libros/lista.php')">Cancelar</button>
            </form>
        </div>
    </div>
</div>

<?php $con->close(); ?>
