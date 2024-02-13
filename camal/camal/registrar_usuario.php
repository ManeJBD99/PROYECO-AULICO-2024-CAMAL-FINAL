<?php
include("config.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mystyle1.css">
    <title>Login</title>
</head>
<body>
<div class="vaca">
         <img src="/images/vaca2.jpg">
    </div>
<div class="registro-container login-container" id="registroContainer">
        <h2>Registro de usuarios</h2>
        <form action="procesarRegistro.php" method="POST">
            <div class="grupo-registro">
                <label for="nombres">Nombres:</label>
                <input type="text" id="nombres" name="nombres" required>
            </div>
            <div class="grupo-registro">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" required>
            </div>
            <div class="grupo-registro">
                <label for="correo_registro">Correo electrónico:</label>
                <input type="email" id="correo_registro" name="correo_registro" required>
            </div>
            <div class="grupo-registro">
                <label for="contraseña_registro">Contraseña:</label>
                <input type="password" id="contraseña_registro" name="contraseña_registro" required>
            </div>
            <div class="boton">
                <button type="submit">Registrarse</button>
            </div>
        </form>
        <div class="enlace">
            <a href="login.php" >Regresar al Login</a>
        </div>
    </div>
    
</body>
</html>