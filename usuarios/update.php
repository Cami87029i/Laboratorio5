<?php
include('../conexion.php');

$id       = $_POST['id'];
$nombre   = $_POST['nombre'];
$carnet   = $_POST['carnet'];
$telefono = $_POST['telefono'];
$correo   = $_POST['correo'];

$sql  = "update usuarios set nombre=?, carnet=?, telefono=?, correo=? where id=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssssi", $nombre, $carnet, $telefono, $correo, $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "ok", "mensaje" => "Usuario actualizado correctamente"]);
} else {
    echo json_encode(["status" => "error", "mensaje" => "Error al actualizar el usuario"]);
}
?>
