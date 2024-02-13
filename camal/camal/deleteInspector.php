<?php
session_start(); 
include("config.php");

if (isset($_SESSION["id_usuario"])) {
    $id_usuario = $_SESSION["id_usuario"];

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id_animal = $_GET['id'];

        $update_sql_salida = "UPDATE tb_salida_animal SET estado = 'eliminado' WHERE id_animal = $id_animal";
        $update_sql_sacrificio = "UPDATE tb_registro_sacrificio SET estado = 'eliminado' WHERE id_animal = $id_animal";

        if (mysqli_query($mysqli, $update_sql_salida) && mysqli_query($mysqli, $update_sql_sacrificio)) {
            header("Location: inspectorTabla.php");
            exit();
        } else {
            echo "Error al eliminar el animal: " . mysqli_error($mysqli);
        }
    } else {
        echo "Error: ID de animal no proporcionado.";
        exit;
    }
}
?>
