<?php
include("config.php");
session_start();

// Verifica si la sesión "id_usuario" está establecida
if (isset($_SESSION["id_usuario"])) {
    $id_usuario = $_SESSION["id_usuario"];

    // Verifica si se ha proporcionado un ID de animal para eliminar
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id_animal = $_GET['id'];

        // Actualiza el estado en la tabla animal
        $update_animal_sql = "UPDATE animal SET estado = 'eliminado' WHERE id_animal = $id_animal";
        mysqli_query($mysqli, $update_animal_sql);

        // Actualiza el estado en la tabla entrada_animal si existe
        $update_entrada_sql = "UPDATE entrada_animal SET estado = 'eliminado' WHERE id_animal = $id_animal";
        mysqli_query($mysqli, $update_entrada_sql);

        // Redirige de vuelta a la página principal
        header("Location: veterinario.php");
        exit();
    } else {
        echo "Error: ID de animal no proporcionado.";
        exit();
    }
} else {
    echo "Error: Sesión no iniciada.";
    exit();
}
?>
