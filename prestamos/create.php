<?php
include('../conexion.php');

$id_libro        = $_POST['id_libro'];
$id_usuario      = $_POST['id_usuario'];
$fecha_prestamo  = $_POST['fecha_prestamo'];
$fecha_devolucion = $_POST['fecha_devolucion'];
$observaciones   = $_POST['observaciones'];

$checkStock = mysqli_query($con, "select stock from libros where id = " . $id_libro);
$libro = mysqli_fetch_array($checkStock);

if ($libro['stock'] <= 0) {
    echo json_encode(["status" => "error", "mensaje" => "El libro no tiene stock disponible"]);
    exit;
}

$sql  = "insert into prestamos (id_libro, id_usuario, fecha_prestamo, fecha_devolucion, observaciones)
         values (?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("iisss", $id_libro, $id_usuario, $fecha_prestamo, $fecha_devolucion, $observaciones);

if ($stmt->execute()) {
    $sqlUpdate = "update libros set stock = stock - 1 where id = ?";
    $stmtUpdate = $con->prepare($sqlUpdate);
    $stmtUpdate->bind_param("i", $id_libro);
    $stmtUpdate->execute();

    echo json_encode(["status" => "ok", "mensaje" => "Prestamo registrado correctamente"]);
} else {
    echo json_encode(["status" => "error", "mensaje" => "Error al registrar el prestamo"]);
}
?>
