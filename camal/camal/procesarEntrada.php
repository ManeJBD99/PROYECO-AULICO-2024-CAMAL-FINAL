<?php
include("config.php");
session_start();

// Verifica si la sesión "id_usuario" está establecida
if (!isset($_SESSION["id_usuario"])) {
    echo "La sesión ha caducado.";
    exit;
}

// Obtener los datos del formulario
$fecha_entrada = $_POST['fecha_entrada'];
$lote = $_POST['lote'];
$id_animal = $_POST['id_animal'];
$id_usuario = $_POST['id_usuario'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO entrada_animal (fecha_entrada, lote, id_animal, id_registro) 
        VALUES ('$fecha_entrada', '$lote', '$id_animal', '$id_usuario')";

if (mysqli_query($mysqli, $sql)) {
    // Redirigir al usuario a la página de entradaAnimal.php (o donde sea apropiado)
    header("Location: entradaAnimal.php");
    exit();
} else {
    echo "Error al registrar la entrada del animal: " . mysqli_error($mysqli);
}
?>
