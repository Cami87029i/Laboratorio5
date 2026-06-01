<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card-formulario">
            <h3 class="seccion-titulo">Registrar Libro</h3>
            <form id="form-libro">
                <div class="mb-3">
                    <label>Titulo</label>
                    <input type="text" class="form-control" name="titulo" id="titulo">
                </div>
                <div class="mb-3">
                    <label>Autor</label>
                    <input type="text" class="form-control" name="autor" id="autor">
                </div>
                <div class="mb-3">
                    <label>ISBN</label>
                    <input type="text" class="form-control" name="isbn" id="isbn">
                </div>
                <div class="mb-3">
                    <label>Categoria</label>
                    <input type="text" class="form-control" name="categoria" id="categoria">
                </div>
                <div class="mb-3">
                    <label>Stock inicial</label>
                    <input type="number" class="form-control" name="stock" id="stock" value="1" min="0">
                </div>
                <button type="button" class="btn btn-primary" onclick="registrarLibro()">Registrar</button>
                <button type="button" class="btn btn-secondary" onclick="cargarContenido('libros/lista.php')">Cancelar</button>
            </form>
        </div>
    </div>
</div>
