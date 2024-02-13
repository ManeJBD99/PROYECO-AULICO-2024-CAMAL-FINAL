<?php
include("config.php");
session_start();

if (!isset($_SESSION["id_usuario"])) {
    echo "La sesión ha caducado.";
    exit;
}

$metodo_sacrificio = $_POST['metodo_sacrificio'];
$fecha_sacrificio = $_POST['fecha_sacrificio'];
$id_animal = $_POST['id_animal'];
$id_usuario = $_POST['id_usuario'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO tb_registro_sacrificio (metodo_sacrificio, dia_sacrificio, id_animal, id_registro) 
        VALUES ('$metodo_sacrificio', '$fecha_sacrificio', '$id_animal', '$id_usuario')";

if (mysqli_query($mysqli, $sql)) {
    // Redirigir al usuario a la página de entradaAnimal.php (o donde sea apropiado)
    header("Location: sacrificio.php");
    exit();
} else {
    echo "Error al registrar la entrada del animal: " . mysqli_error($mysqli);
}
?>
