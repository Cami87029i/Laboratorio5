function cargarContenido(pagina) {
    var contenedor = document.getElementById('contenido');
    fetch(pagina)
        .then(response => response.text())
        .then(data => contenedor.innerHTML = data);
}

function mostrarMensaje(titulo, texto) {
    document.getElementById('modalMensajeTitulo').textContent = titulo;
    document.getElementById('modalMensajeTexto').textContent = texto;
    var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalMensaje'));
    modal.show();
}

// funciones para libros

function registrarLibro() {
    var inputTitulo = document.getElementById('titulo');
    var inputAutor = document.getElementById('autor');
    var inputIsbn = document.getElementById('isbn');
    var inputCategoria = document.getElementById('categoria');
    var inputStock = document.getElementById('stock');

    var mensajes = document.querySelectorAll('.error-mensaje');
    mensajes.forEach(m => m.innerText = '');

    var inputs = [
        inputTitulo,
        inputAutor,
        inputIsbn,
        inputCategoria,
        inputStock
    ];

    inputs.forEach(i => i.classList.remove('input-error', 'input-valido'));

    var esValido = true;

    if (inputTitulo.value.trim().length < 3) {
        document.getElementById('error-titulo').innerText =
            'Error: El título debe tener al menos 3 caracteres.';
        inputTitulo.classList.add('input-error');
        esValido = false;
    } else {
        inputTitulo.classList.add('input-valido');
    }

    if (inputAutor.value.trim().length < 3) {
        document.getElementById('error-autor').innerText =
            'Error: El autor debe tener al menos 3 caracteres.';
        inputAutor.classList.add('input-error');
        esValido = false;
    } else {
        inputAutor.classList.add('input-valido');
    }

    if (inputIsbn.value.trim() === '') {
        document.getElementById('error-isbn').innerText =
            'Error: El ISBN es obligatorio.';
        inputIsbn.classList.add('input-error');
        esValido = false;
    } else {
        inputIsbn.classList.add('input-valido');
    }

    if (inputCategoria.value.trim() === '') {
        document.getElementById('error-categoria').innerText =
            'Error: La categoría es obligatoria.';
        inputCategoria.classList.add('input-error');
        esValido = false;
    } else {
        inputCategoria.classList.add('input-valido');
    }

    if (
        inputStock.value.trim() === '' ||
        parseInt(inputStock.value) < 0
    ) {
        document.getElementById('error-stock').innerText =
            'Error: El stock debe ser mayor o igual a 0.';
        inputStock.classList.add('input-error');
        esValido = false;
    } else {
        inputStock.classList.add('input-valido');
    }

    if (!esValido) {
        return;
    }

    var datos = new FormData(document.getElementById('form-libro'));

    fetch('libros/create.php', {
        method: 'POST',
        body: datos
    })
    .then(response => response.json())
    .then(data => {
        mostrarMensaje(
            data.status == 'ok' ? 'Exito' : 'Error',
            data.mensaje
        );

        if (data.status == 'ok') {
            cargarContenido('libros/lista.php');
        }
    });
}

function cargarEditarLibro(id) {
    var contenedor = document.getElementById('contenido');
    fetch('libros/form-editar.php?id=' + id)
        .then(response => response.text())
        .then(data => contenedor.innerHTML = data);
}

function actualizarLibro() {

    var inputTitulo = document.getElementById('titulo');
    var inputAutor = document.getElementById('autor');
    var inputIsbn = document.getElementById('isbn');
    var inputCategoria = document.getElementById('categoria');
    var inputStock = document.getElementById('stock');

    var mensajes = document.querySelectorAll('.error-mensaje');
    mensajes.forEach(m => m.innerText = '');

    var inputs = [
        inputTitulo,
        inputAutor,
        inputIsbn,
        inputCategoria,
        inputStock
    ];

    inputs.forEach(i => {
        i.classList.remove('input-error', 'input-valido');
    });

    var esValido = true;

    if (inputTitulo.value.trim().length < 3) {
        document.getElementById('error-titulo').innerText =
            'Error: El título es obligatorio (mínimo 3 caracteres).';
        inputTitulo.classList.add('input-error');
        esValido = false;
    } else {
        inputTitulo.classList.add('input-valido');
    }

    

    if (inputAutor.value.trim().length < 3) {
        document.getElementById('error-autor').innerText =
            'Error: El autor es obligatorio (mínimo 3 caracteres).';
        inputAutor.classList.add('input-error');
        esValido = false;
    } else {
        inputAutor.classList.add('input-valido');
    }

    
    if (inputIsbn.value.trim() === '') {
        document.getElementById('error-isbn').innerText =
            'Error: El ISBN es obligatorio.';
        inputIsbn.classList.add('input-error');
        esValido = false;
    } else {
        inputIsbn.classList.add('input-valido');
    }

    if (inputCategoria.value.trim() === '') {
        document.getElementById('error-categoria').innerText =
            'Error: La categoría es obligatoria.';
        inputCategoria.classList.add('input-error');
        esValido = false;
    } else {
        inputCategoria.classList.add('input-valido');
    }

    if (
        inputStock.value.trim() === '' ||
        isNaN(inputStock.value) ||
        parseInt(inputStock.value) < 0
    ) {
        document.getElementById('error-stock').innerText =
            'Error: El stock debe ser mayor o igual a 0.';
        inputStock.classList.add('input-error');
        esValido = false;
    } else {
        inputStock.classList.add('input-valido');
    }

    if (!esValido) {
        return;
    }

    var datos = new FormData(document.getElementById('form-editar-libro'));

    fetch('libros/update.php', {
        method: 'POST',
        body: datos
    })
    .then(response => response.json())
    .then(data => {
        mostrarMensaje(
            data.status == 'ok' ? 'Exito' : 'Error',
            data.mensaje
        );

        if (data.status == 'ok') {
            cargarContenido('libros/lista.php');
        }
    });
}

function eliminarLibro(id) {
    var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEliminar'));
    modal.show();

    document.getElementById('btn-confirmar-eliminar').onclick = function() {
        fetch('libros/delete.php?id=' + id)
            .then(response => response.json())
            .then(data => {
                modal.hide();
                mostrarMensaje(data.status == 'ok' ? 'Exito' : 'Error', data.mensaje);
                if (data.status == 'ok') {
                    cargarContenido('libros/lista.php');
                }
            });
    };
}

// funciones para usuarios

function registrarUsuario() {
    var inputNombre = document.getElementById('nombre');
    var inputCarnet = document.getElementById('carnet');
    var inputCorreo = document.getElementById('correo');
    var inputTelefono = document.getElementById('telefono');

    var mensajes = document.querySelectorAll('.error-mensaje');
    mensajes.forEach(m => m.innerText = '');
    
    var inputs = [inputNombre, inputCarnet, inputCorreo, inputTelefono];
    inputs.forEach(i => i.classList.remove('input-error', 'input-valido'));

    var esValido = true;

    
    if (inputNombre.value.trim().length < 3) {
        document.getElementById('error-nombre').innerText = 'Error: Este campo es obligatorio (mínimo 3 caracteres).';
        inputNombre.classList.add('input-error');
        esValido = false;
    } else {
        inputNombre.classList.add('input-valido');
    }

    if (inputCarnet.value.trim().length < 6) {
        document.getElementById('error-carnet').innerText = 'Error: Carnet inválido.';
        inputCarnet.classList.add('input-error');
        esValido = false;
    } else {
        inputCarnet.classList.add('input-valido');
    }

    if (inputTelefono.value.trim().length < 8) {
        document.getElementById('error-telefono').innerText = 'Error: Teléfono inválido.';
        inputTelefono.classList.add('input-error');
        esValido = false;
    } else {
        inputTelefono.classList.add('input-valido');
    }

    if (inputCorreo.value.trim() === '') {
        document.getElementById('error-correo').innerText = 'Error: Este campo es obligatorio.';
        inputCorreo.classList.add('input-error');
        esValido = false;
    } else if (!inputCorreo.value.includes('@')) {
        document.getElementById('error-correo').innerText = 'Error: El formato del correo no es válido.';
        inputCorreo.classList.add('input-error');
        esValido = false;
    } else {
        inputCorreo.classList.add('input-valido');
    }

    if (!esValido) {
        return; 
    }

    var datos = new FormData(document.getElementById('form-usuario'));
    fetch('usuarios/create.php', {
        method: 'POST',
        body: datos
    })
    .then(response => response.json())
    .then(data => {
        mostrarMensaje(data.status == 'ok' ? 'Exito' : 'Error', data.mensaje);
        if (data.status == 'ok') {
            cargarContenido('usuarios/lista.php');
        }
    });
}


function cargarEditarUsuario(id) {
    var contenedor = document.getElementById('contenido');
    fetch('usuarios/form-editar.php?id=' + id)
        .then(response => response.text())
        .then(data => contenedor.innerHTML = data);
}


function actualizarUsuario() {
    var inputNombre = document.getElementById('nombre');
    var inputCarnet = document.getElementById('carnet');
    var inputCorreo = document.getElementById('correo');
    var inputTelefono = document.getElementById('telefono');

    var mensajes = document.querySelectorAll('.error-mensaje');
    mensajes.forEach(m => m.innerText = '');
    
    var inputs = [inputNombre, inputCarnet, inputCorreo, inputTelefono];
    inputs.forEach(i => i.classList.remove('input-error', 'input-valido'));

    var esValido = true;


    if (inputNombre.value.trim().length < 3) {
        document.getElementById('error-nombre').innerText = 'Error: El nombre debe tener al menos 3 caracteres.';
        inputNombre.classList.add('input-error');
        esValido = false;
    } else {
        inputNombre.classList.add('input-valido');
    }

    if (inputCarnet.value.trim().length < 6) {
        document.getElementById('error-carnet').innerText = 'Error: Carnet inválido (mínimo 6 dígitos).';
        inputCarnet.classList.add('input-error');
        esValido = false;
    } else {
        inputCarnet.classList.add('input-valido');
    }

    if (inputTelefono.value.trim().length < 8) {
        document.getElementById('error-telefono').innerText = 'Error: Teléfono inválido (mínimo 8 dígitos).';
        inputTelefono.classList.add('input-error');
        esValido = false;
    } else {
        inputTelefono.classList.add('input-valido');
    }

    if (inputCorreo.value.trim() === '') {
        document.getElementById('error-correo').innerText = 'Error: Este campo es obligatorio.';
        inputCorreo.classList.add('input-error');
        esValido = false;
    } else if (!inputCorreo.value.includes('@')) {
        document.getElementById('error-correo').innerText = 'Error: El formato del correo no es válido.';
        inputCorreo.classList.add('input-error');
        esValido = false;
    } else {
        inputCorreo.classList.add('input-valido');
    }

    if (!esValido) {
        return; 
    }

    var datos = new FormData(document.getElementById('form-editar-usuario'));
    fetch('usuarios/update.php', {
        method: 'POST',
        body: datos
    })
    .then(response => response.json())
    .then(data => {
        mostrarMensaje(data.status == 'ok' ? 'Exito' : 'Error', data.mensaje);
        if (data.status == 'ok') {
            cargarContenido('usuarios/lista.php');
        }
    });
}

function eliminarUsuario(id) {
    var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEliminar'));
    modal.show();

    document.getElementById('btn-confirmar-eliminar').onclick = function() {
        fetch('usuarios/delete.php?id=' + id)
            .then(response => response.json())
            .then(data => {
                modal.hide();
                mostrarMensaje(data.status == 'ok' ? 'Exito' : 'Error', data.mensaje);
                if (data.status == 'ok') {
                    cargarContenido('usuarios/lista.php');
                }
            });
    };
}

// funciones para prestamos 

function registrarPrestamo() {

    var inputLibro = document.getElementById('id_libro');
    var inputUsuario = document.getElementById('id_usuario');
    var inputFechaPrestamo = document.getElementById('fecha_prestamo');
    var inputFechaDevolucion = document.getElementById('fecha_devolucion');

    var mensajes = document.querySelectorAll('.error-mensaje');
    mensajes.forEach(m => m.innerText = '');
    var inputs = [
        inputLibro,
        inputUsuario,
        inputFechaPrestamo,
        inputFechaDevolucion
    ];

    inputs.forEach(i => {
        i.classList.remove('input-error', 'input-valido');
    });

    var esValido = true;

    
    if (inputLibro.value === '') {
        document.getElementById('error-libro').innerText =
            'Error: Debe seleccionar un libro.';
        inputLibro.classList.add('input-error');
        esValido = false;
    } else {
        inputLibro.classList.add('input-valido');
    }

    if (inputUsuario.value === '') {
        document.getElementById('error-usuario').innerText =
            'Error: Debe seleccionar un usuario.';
        inputUsuario.classList.add('input-error');
        esValido = false;
    } else {
        inputUsuario.classList.add('input-valido');
    }

    if (inputFechaPrestamo.value === '') {
        document.getElementById('error-fecha-prestamo').innerText =
            'Error: Debe ingresar la fecha de préstamo.';
        inputFechaPrestamo.classList.add('input-error');
        esValido = false;
    } else {
        inputFechaPrestamo.classList.add('input-valido');
    }

    if (inputFechaDevolucion.value === '') {
        document.getElementById('error-fecha-devolucion').innerText =
            'Error: Debe ingresar la fecha de devolución.';
        inputFechaDevolucion.classList.add('input-error');
        esValido = false;
    }
    else if (
        inputFechaPrestamo.value !== '' &&
        inputFechaDevolucion.value < inputFechaPrestamo.value
    ) {
        document.getElementById('error-fecha-devolucion').innerText =
            'Error: La fecha de devolución no puede ser anterior a la fecha de préstamo.';
        inputFechaDevolucion.classList.add('input-error');
        esValido = false;
    }
    else {
        inputFechaDevolucion.classList.add('input-valido');
    }

    if (!esValido) {
        return;
    }

    var datos = new FormData(document.getElementById('form-prestamo'));

    fetch('prestamos/create.php', {
        method: 'POST',
        body: datos
    })
    .then(response => response.json())
    .then(data => {

        mostrarMensaje(
            data.status == 'ok' ? 'Exito' : 'Error',
            data.mensaje
        );

        if (data.status == 'ok') {
            cargarContenido('prestamos/lista.php');
        }
    });
}

function cambiarEstado(id, nuevoEstado) {
    var datos = new FormData();
    datos.append('id', id);
    datos.append('estado', nuevoEstado);

    fetch('prestamos/cambiar_estado.php', {
        method: 'POST',
        body: datos
    })
    .then(response => response.json())
    .then(data => {
        mostrarMensaje(data.status == 'ok' ? 'Exito' : 'Error', data.mensaje);
        if (data.status == 'ok') {
            cargarContenido('prestamos/lista.php');
        }
    });
}

function eliminarPrestamo(id) {
    var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEliminar'));
    modal.show();

    document.getElementById('btn-confirmar-eliminar').onclick = function() {
        fetch('prestamos/delete.php?id=' + id)
            .then(response => response.json())
            .then(data => {
                modal.hide();
                mostrarMensaje(data.status == 'ok' ? 'Exito' : 'Error', data.mensaje);
                if (data.status == 'ok') {
                    cargarContenido('prestamos/lista.php');
                }
            });
    };
}

function filtrarPrestamos() {
    var libro   = document.getElementById('filtro-libro').value;
    var usuario = document.getElementById('filtro-usuario').value;
    var estado  = document.getElementById('filtro-estado').value;

    var url = 'prestamos/lista.php?libro='   + encodeURIComponent(libro) +
              '&usuario=' + encodeURIComponent(usuario) +
              '&estado='  + encodeURIComponent(estado);

    cargarContenido(url);
}






function volverInicio() {
    var contenedor = document.getElementById('contenido');
    contenedor.innerHTML = ' \
        <div class="row g-4 justify-content-center"> \
            <div class="col-md-4"> \
                <div class="card h-100 border-0 shadow-sm text-center"> \
                    <div class="card-body p-4"> \
                        <h4 class="fw-bold text-usfx-blue">Catálogo de Libros</h4> \
                        <p class="text-muted small">Administración del inventario, registro de nuevos títulos, autores y volúmenes.</p> \
                        <button class="btn btn-usfx-red btn-sm px-4 mt-2" onclick="cargarContenido(\'libros/lista.php\')">Ingresar</button> \
                    </div> \
                </div> \
            </div> \
            <div class="col-md-4"> \
                <div class="card h-100 border-0 shadow-sm text-center"> \
                    <div class="card-body p-4"> \
                        <h4 class="fw-bold text-usfx-blue">Registro de Usuarios</h4> \
                        <p class="text-muted small">Control y seguimiento de estudiantes inscritos, edición de datos y carnets.</p> \
                        <button class="btn btn-usfx-red btn-sm px-4 mt-2" onclick="cargarContenido(\'usuarios/lista.php\')">Ingresar</button> \
                    </div> \
                </div> \
            </div> \
            <div class="col-md-4"> \
                <div class="card h-100 border-0 shadow-sm text-center"> \
                    <div class="card-body p-4"> \
                        <h4 class="fw-bold text-usfx-blue">Préstamos y Control</h4> \
                        <p class="text-muted small">Gestión de salida de libros, devoluciones y alertas de préstamos vencidos.</p> \
                        <button class="btn btn-usfx-red btn-sm px-4 mt-2" onclick="cargarContenido(\'prestamos/lista.php\')">Ingresar</button> \
                    </div> \
                </div> \
            </div> \
        </div>';
}