<?php
include('../conexion.php');

$id     = $_POST['id'];
$estado = $_POST['estado'];

if ($estado == 'Devuelto') {

    $checkLibro = mysqli_query($con, "select id_libro from prestamos where id = " . $id);
    $prestamo   = mysqli_fetch_array($checkLibro);
    $sqlStock = "update libros set stock = stock + 1 where id = ?";
    $stmtStock = $con->prepare($sqlStock);
    $stmtStock->bind_param("i", $prestamo['id_libro']);
    $stmtStock->execute();
}

$sql  = "update prestamos set estado = ? where id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("si", $estado, $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "ok", "mensaje" => "Estado cambiado a " . $estado]);
} else {
    echo json_encode(["status" => "error", "mensaje" => "Error al cambiar el estado"]);
}
?>
