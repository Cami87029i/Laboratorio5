<?php
include('../conexion.php');

$id = $_GET['id'];

$sql  = "delete from usuarios where id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "ok", "mensaje" => "Usuario eliminado correctamente"]);
} else {
    echo json_encode(["status" => "error", "mensaje" => "Error al eliminar el usuario"]);
}
?>
