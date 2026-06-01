<?php
include('../conexion.php');

$nombre   = $_POST['nombre'];
$carnet   = $_POST['carnet'];
$telefono = $_POST['telefono'];
$correo   = $_POST['correo'];

$sql  = "insert into usuarios (nombre, carnet, telefono, correo) values (?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssss", $nombre, $carnet, $telefono, $correo);

if ($stmt->execute()) {
    echo json_encode(["status" => "ok", "mensaje" => "Usuario registrado correctamente"]);
} else {
    echo json_encode(["status" => "error", "mensaje" => "Error al registrar. El carnet puede que ya exista"]);
}
?>
