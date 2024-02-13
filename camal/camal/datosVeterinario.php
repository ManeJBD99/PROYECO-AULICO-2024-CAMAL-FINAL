<?php
include("config.php");
session_start(); 

if (!isset($_SESSION["id_usuario"])) {
    echo "La sesión ha caducado.";
    exit;
}

$id_usuario = $_SESSION["id_usuario"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<script src="https://kit.fontawesome.com/e46e9d73a7.js" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/mystyle1.css" />
    <title>animal</title>
</head>
<body>
     <!-- Creamos un menu     -->
     <div class="icon-bar">
     <a href="veterinario.php"><i class="fa fa-home"></i></a>
        <a href="animal.php"><i class="fa-solid fa-cow"></i></a>
        <a href="entradaAnimal.php"><i class="fa-solid fa-list-ol"></i></a>
        <a href="datosVeterinario.php"><i class="fa-solid fa-user"></i></a>
        <a href="inspectorTabla2.php"><i class="fa-solid fa-table"></i></a>
        <a href="salir.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
    </div>

    <div class="formulario-caja">
        <h2 class="titulo">Subir Datos Personales</h2>
        
        <form class="formulario" action="procesarDatosPersonalesVeterinario.php" method="POST">
            <label for="nombres">Nombres:</label><br>
            <input type="text" id="nombres" name="nombres" required><br>

            <label for="apellidos">Apellidos:</label><br>
            <input type="text" id="apellidos" name="apellidos" required><br>
            
            <label for="cedula">Cedula:</label><br>
            <input type="text" id="cedula" name="cedula" required><br>

            <label for="celular">Celular:</label><br>
            <input type="text" id="celular" name="celular" required><br>
            
            <label for="direccion">Direccion:</label><br>
            <input type="text" id="direccion" name="direccion" required><br>
            
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

            <div class="boton">
                <button type="submit">Subir Datos</button>
            </div>
        </form>
    </div>

    
    
</body>
</html>

