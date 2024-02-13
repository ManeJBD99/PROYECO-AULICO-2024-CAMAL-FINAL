<?php
include("config.php");
session_start();

if (!isset($_SESSION["id_usuario"])) {
    echo "La sesión ha caducado.";
    exit;
}

$peso = $_POST['peso'];
$marca_animal = $_POST['marca_animal'];
$color = $_POST['color'];
$enfermedad = $_POST['enfermedad'];
$guia_agrocalidad = $_POST['agrocalidad'];
$id_usuario = $_POST['id_usuario'];

$sql = "INSERT INTO animal (peso, marca_animal, color, enfermedad, guía_agrocalidad, id_registro) 
        VALUES ('$peso', '$marca_animal', '$color', '$enfermedad', $guia_agrocalidad, '$id_usuario')";

if (mysqli_query($mysqli, $sql)) {
    header("Location: animal.php");
    exit();
} else {
    echo "Error al registrar los datos del animal: " . mysqli_error($mysqli);
}
?>
