<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Biblioteca</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand fw-bold">Biblioteca USFX</span>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-light btn-sm" onclick="cargarContenido('libros/lista.php')">Libros</button>
                <button class="btn btn-outline-light btn-sm" onclick="cargarContenido('usuarios/lista.php')">Usuarios</button>
                <button class="btn btn-outline-light btn-sm" onclick="cargarContenido('prestamos/lista.php')">Prestamos</button>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div id="contenido">
            <div class="text-center mt-5">
                <h2>Sistema de Gestion de Biblioteca</h2>
                <p class="text-muted">Selecciona una opcion del menu para comenzar</p>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEliminar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar eliminacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Esta seguro que desea eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btn-confirmar-eliminar">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalMensaje" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMensajeTitulo">Mensaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMensajeTexto"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/fetch.js"></script>
</body>
</html>
