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
<div class="login-container" >
        <h2>Iniciar Sesion</h2>
       
        <form class="loginForm" action="procesarLogin.php" method="POST">
            <div class="grupo-login">
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="grupo-login">
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" required>
            </div>
            <div class="boton">
                <button type="submit">Iniciar Sesion</button>
            </div>

        </form>
        <div class="enlace">
        <a href="registrar_usuario.php" id="mostrarRegistro">Crear cuenta</a>
        </div>

    </div>

    
</body>
</html>