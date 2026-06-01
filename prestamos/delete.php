<?php
include('../conexion.php');

$id = $_GET['id'];

$check   = mysqli_query($con, "select estado from prestamos where id = " . $id);
$prestamo = mysqli_fetch_array($check);

if ($prestamo['estado'] == 'Activo') {
    echo json_encode(["status" => "error", "mensaje" => "No se puede eliminar un prestamo activo"]);
    exit;
}

$sql  = "delete from prestamos where id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "ok", "mensaje" => "Prestamo eliminado correctamente"]);
} else {
    echo json_encode(["status" => "error", "mensaje" => "Error al eliminar el prestamo"]);
}
?>
