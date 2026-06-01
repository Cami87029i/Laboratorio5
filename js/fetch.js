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

function registrarLibro() {
    var titulo = document.getElementById('titulo').value;
    var autor  = document.getElementById('autor').value;
    var stock  = document.getElementById('stock').value;
    if (titulo == '' || autor == '') {
        mostrarMensaje('Error', 'El titulo y el autor son obligatorios');
        return;
    }
    if (stock < 0) {
        mostrarMensaje('Error', 'El stock no puede ser negativo');
        return;
    }

    var datos = new FormData(document.getElementById('form-libro'));
    fetch('libros/create.php', {
        method: 'POST',
        body: datos
    })
    .then(response => response.json())
    .then(data => {
        mostrarMensaje(data.status == 'ok' ? 'Exito' : 'Error', data.mensaje);
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
    var stock = document.getElementById('stock').value;
    if (stock < 0) {
        mostrarMensaje('Error', 'El stock no puede ser negativo');
        return;
    }

    var datos = new FormData(document.getElementById('form-editar-libro'));
    fetch('libros/update.php', {
        method: 'POST',
        body: datos
    })
    .then(response => response.json())
    .then(data => {
        mostrarMensaje(data.status == 'ok' ? 'Exito' : 'Error', data.mensaje);
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

function registrarUsuario() {
    var nombre = document.getElementById('nombre').value;
    var carnet = document.getElementById('carnet').value;
    var correo = document.getElementById('correo').value;

    if (nombre == '' || carnet == '') {
        mostrarMensaje('Error', 'El nombre y el carnet son obligatorios');
        return;
    }
    if (correo != '' && !correo.includes('@')) {
        mostrarMensaje('Error', 'El formato del correo no es valido');
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
    var correo = document.getElementById('correo').value;
    if (correo != '' && !correo.includes('@')) {
        mostrarMensaje('Error', 'El formato del correo no es valido');
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
function registrarPrestamo() {
    var idLibro    = document.getElementById('id_libro').value;
    var idUsuario  = document.getElementById('id_usuario').value;
    var fechaPrest = document.getElementById('fecha_prestamo').value;

    if (idLibro == '' || idUsuario == '' || fechaPrest == '') {
        mostrarMensaje('Error', 'Libro, usuario y fecha de prestamo son obligatorios');
        return;
    }

    var datos = new FormData(document.getElementById('form-prestamo'));
    fetch('prestamos/create.php', {
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
