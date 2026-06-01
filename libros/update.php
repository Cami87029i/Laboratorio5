<?php
include('../conexion.php');

$id        = $_POST['id'];
$titulo    = $_POST['titulo'];
$autor     = $_POST['autor'];
$isbn      = $_POST['isbn'];
$categoria = $_POST['categoria'];
$stock     = $_POST['stock'];

if ($stock < 0) {
    echo json_encode(["status" => "error", "mensaje" => "El stock no puede ser negativo"]);
    exit;
}

$sql = "update libros set titulo=?, autor=?, isbn=?, categoria=?, stock=? where id=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssssii", $titulo, $autor, $isbn, $categoria, $stock, $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "ok", "mensaje" => "Libro actualizado correctamente"]);
} else {
    echo json_encode(["status" => "error", "mensaje" => "Error al actualizar el libro"]);
}
?>
