<?php
include("config.php");
session_start();

if (!isset($_SESSION["id_usuario"])) {
    echo "La sesión ha caducado.";
    exit;
}

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$cedula = $_POST['cedula'];
$celular = $_POST['celular'];
$direccion = $_POST['direccion'];
$id_usuario = $_POST['id_usuario'];

$check_sql = "SELECT id_inspector FROM inspector WHERE id_registro = '$id_usuario'";
$result = mysqli_query($mysqli, $check_sql);

if (mysqli_num_rows($result) > 0) {
    $update_sql = "UPDATE inspector SET nombres = '$nombres', apellidos = '$apellidos', cedula = '$cedula', celular = '$celular', direccion = '$direccion' WHERE id_registro = '$id_usuario'";
    
    if (mysqli_query($mysqli, $update_sql)) {
        header("Location: datosInspector.php");
        exit();
    } else {
        echo "Error al actualizar los datos del inspector: " . mysqli_error($mysqli);
    }
} else {


    $insert_sql = "INSERT INTO inspector (nombres, apellidos, cedula, celular, direccion, id_registro) 
                   VALUES ('$nombres', '$apellidos', '$cedula', '$celular', '$direccion', '$id_usuario')";

    if (mysqli_query($mysqli, $insert_sql)) {
        header("Location: datosInspector.php");
        exit();
    } else {
        echo "Error al registrar los datos del inspector: " . mysqli_error($mysqli);
    }
}

?>
