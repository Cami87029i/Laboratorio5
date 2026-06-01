<?php
include('../conexion.php');
$sqlLibros = "select id, titulo, stock from libros where stock > 0";
$consultaLibros = mysqli_query($con, $sqlLibros);
$sqlUsuarios = "select id, nombre, carnet from usuarios";
$consultaUsuarios = mysqli_query($con, $sqlUsuarios);
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card-formulario">
            <h3 class="seccion-titulo">Registrar Prestamo</h3>
            <form id="form-prestamo">
                <div class="mb-3">
                    <label>Libro</label>
                    <select class="form-select" name="id_libro" id="id_libro">
                        <option value="">-- Seleccione un libro --</option>
                        <?php while ($libro = mysqli_fetch_array($consultaLibros)) { ?>
                            <option value="<?php echo $libro['id']; ?>">
                                <?php echo $libro['titulo']; ?> (stock: <?php echo $libro['stock']; ?>)
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Usuario</label>
                    <select class="form-select" name="id_usuario" id="id_usuario">
                        <option value="">-- Seleccione un usuario --</option>
                        <?php while ($usuario = mysqli_fetch_array($consultaUsuarios)) { ?>
                            <option value="<?php echo $usuario['id']; ?>">
                                <?php echo $usuario['nombre']; ?> - <?php echo $usuario['carnet']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Fecha de prestamo</label>
                    <input type="date" class="form-control" name="fecha_prestamo" id="fecha_prestamo">
                </div>
                <div class="mb-3">
                    <label>Fecha de devolucion esperada</label>
                    <input type="date" class="form-control" name="fecha_devolucion" id="fecha_devolucion">
                </div>
                <div class="mb-3">
                    <label>Observaciones (opcional)</label>
                    <textarea class="form-control" name="observaciones" rows="3"></textarea>
                </div>
                <button type="button" class="btn btn-primary" onclick="registrarPrestamo()">Registrar prestamo</button>
                <button type="button" class="btn btn-secondary" onclick="cargarContenido('prestamos/lista.php')">Cancelar</button>
            </form>
        </div>
    </div>
</div>

<?php $con->close(); ?>
