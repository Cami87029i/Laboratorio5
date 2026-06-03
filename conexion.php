<?php
// conexion a la base de datos
$con = new mysqli("localhost", "root", "", "bd_biblioteca", 3307);

if ($con->connect_error) {
    die("error al conectarse: " . $con->connect_error);
}
?>
