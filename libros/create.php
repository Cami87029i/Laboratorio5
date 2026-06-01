<?php
include('../conexion.php');

$titulo    = $_POST['titulo'];
$autor     = $_POST['autor'];
$isbn      = $_POST['isbn'];
$categoria = $_POST['categoria'];
$stock     = $_POST['stock'];

if ($stock < 0) {
    echo json_encode(["status" => "error", "mensaje" => "El stock no puede ser negativo"]);
    exit;
}

$sql = "insert into libros (titulo, autor, isbn, categoria, stock) values (?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssssi", $titulo, $autor, $isbn, $categoria, $stock);

if ($stmt->execute()) {
    echo json_encode(["status" => "ok", "mensaje" => "Libro registrado correctamente"]);
} else {
    echo json_encode(["status" => "error", "mensaje" => "Error al registrar el libro"]);
}
?>
