<?php
include('../conexion.php');

$id = $_GET['id'];

$check = mysqli_query($con, "select count(*) as total from prestamos where id_libro = " . $id);
$fila  = mysqli_fetch_array($check);

if ($fila['total'] > 0) {
    echo json_encode(["status" => "error", "mensaje" => "No se puede eliminar, el libro tiene prestamos registrados"]);
    exit;
}

$sql  = "delete from libros where id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "ok", "mensaje" => "Libro eliminado correctamente"]);
} else {
    echo json_encode(["status" => "error", "mensaje" => "Error al eliminar el libro"]);
}
?>
