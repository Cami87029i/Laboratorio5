<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card-formulario">
            <h3 class="seccion-titulo">Registrar Libro</h3>

            <form id="form-libro">

                <div class="mb-3">
                    <label>Titulo</label>
                    <input type="text" class="form-control" name="titulo" id="titulo">
                    <small id="error-titulo" class="error-mensaje"></small>
                </div>

                <div class="mb-3">
                    <label>Autor</label>
                    <input type="text" class="form-control" name="autor" id="autor">
                    <small id="error-autor" class="error-mensaje"></small>
                </div>

                <div class="mb-3">
                    <label>ISBN</label>
                    <input type="text" class="form-control" name="isbn" id="isbn">
                    <small id="error-isbn" class="error-mensaje"></small>
                </div>

                <div class="mb-3">
                    <label>Categoria</label>
                    <input type="text" class="form-control" name="categoria" id="categoria">
                    <small id="error-categoria" class="error-mensaje"></small>
                </div>

                <div class="mb-3">
                    <label>Stock inicial</label>
                    <input type="number" class="form-control" name="stock" id="stock" value="1" min="0">
                    <small id="error-stock" class="error-mensaje"></small>
                </div>

                <button type="button" class="btn btn-primary" onclick="registrarLibro()">Registrar</button>

                <button type="button" class="btn btn-secondary" onclick="cargarContenido('libros/lista.php')">Cancelar</button>

            </form>
        </div>
    </div>
</div>