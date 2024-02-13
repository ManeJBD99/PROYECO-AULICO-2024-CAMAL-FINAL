<?php
include("config.php");
session_start();

if (!isset($_SESSION["id_usuario"])) {
    echo "La sesión ha caducado.";
    exit;
}

$fecha_salida = $_POST['fecha_salida'];
$destino = $_POST['destino'];
$id_usuario = $_POST['id_usuario'];
$id_animal = $_POST['id_animal'];

$sql = "INSERT INTO tb_salida_animal (fecha_salida, destino, id_registro, id_animal) 
        VALUES ('$fecha_salida', '$destino', '$id_usuario', '$id_animal')";

if (mysqli_query($mysqli, $sql)) {
    header("Location: salidaAnimal.php");
    exit();
} else {
    echo "Error al registrar la salida del animal: " . mysqli_error($mysqli);
}
?>
