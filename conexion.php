<?php
$servername = "localhost"; 
$username = "root"; 
$password = "admin123"; 
$database = "agencia";

$connecion = mysqli_connect($servername, $username, $password, $database);
if (!$connecion) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
