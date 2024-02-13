<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("config.php");
    
    $nombres =  $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo_registro'];
    $contraseña = $_POST['contraseña_registro'];
    
    $sql = "INSERT INTO registro (nombres, apellidos, correo_electronico, contraseña) 
            VALUES ('$nombres', '$apellidos', '$correo', '$contraseña')";
    
    if (mysqli_query($mysqli, $sql)) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
    }
    
} else {
    header("Location: registrar_usuario.php");
    exit();
}
?>
