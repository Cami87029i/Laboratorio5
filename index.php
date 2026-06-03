<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Biblioteca - USFX</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navB shadow-sm py-3">
        <div class="container">
            <h3 class="Logo" onclick="volverInicio()" style="cursor: pointer;">Biblioteca USFX</h3>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-light btn-sm px-3 fw-semibold" onclick="cargarContenido('libros/lista.php')">Libros</button>
                <button class="btn btn-outline-light btn-sm px-3 fw-semibold" onclick="cargarContenido('usuarios/lista.php')">Usuarios</button>
                <button class="btn btn-outline-light btn-sm px-3 fw-semibold" onclick="cargarContenido('prestamos/lista.php')">Préstamos</button>
            </div>
        </div>
    </nav>

    <div class="hero-usfx text-white py-5 text-center shadow-sm">
        <div class="container">
            <h1 class="fw-bold display-5">Sistema de Gestión Bibliotecaria</h1>
            <p class="lead opacity-75">Ciencias de la Computación</p>
        </div>
    </div>

    <div class="container mt-5">
        <div id="contenido">
            
            <div class="row g-4 justify-content-center">
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <h4 class="fw-bold text-usfx-blue">Catálogo de Libros</h4>
                            <p class="text-muted small">Administración del inventario, registro de nuevos títulos, autores y volúmenes.</p>
                            <button class="btn btn-usfx-red btn-sm px-4 mt-2" onclick="cargarContenido('libros/lista.php')">Ingresar</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <h4 class="fw-bold text-usfx-blue">Registro de Usuarios</h4>
                            <p class="text-muted small">Control y seguimiento de estudiantes inscritos, edición de datos y carnets.</p>
                            <button class="btn btn-usfx-red btn-sm px-4 mt-2" onclick="cargarContenido('usuarios/lista.php')">Ingresar</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <h4 class="fw-bold text-usfx-blue">Préstamos y Control</h4>
                            <p class="text-muted small">Gestión de salida de libros, devoluciones y alertas de préstamos vencidos.</p>
                            <button class="btn btn-usfx-red btn-sm px-4 mt-2" onclick="cargarContenido('prestamos/lista.php')">Ingresar</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="modal fade" id="modalEliminar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirmar eliminación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    ¿Está seguro que desea eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btn-confirmar-eliminar">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalMensaje" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMensajeTitulo">Mensaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p id="modalMensajeTexto" class="mb-0"></p>
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