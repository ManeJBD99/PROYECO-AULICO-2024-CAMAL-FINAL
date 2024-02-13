<?php
include("config.php");
session_start(); 

if (!isset($_SESSION["id_usuario"])) {
    echo "SESION CADUCADA.";
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
        <h2 class="titulo">Subir Datos del Animal</h2>
        
        <form class="formulario" action="procesarAnimal.php" method="POST">
            <label for="peso">Peso:</label><br>
            <input type="text" id="peso" name="peso" required><br>
            
            <label for="marca_animal">Marca del animal:</label><br>
            <input type="text" id="marca_animal" name="marca_animal" required><br>
            
            <label for="color">Color:</label><br>
            <input type="text" id="color" name="color" required><br>
            
            <!--<label for="fecha_fin">Fecha de Fin:</label><br>
            <input type="date" id="fecha_fin" name="fecha_fin" required><br>-->
            
            <label for="enfermedad">Estado del animal:</label><br>
            <select id="enfermedad" name="enfermedad" required>
                <option value="enfermo">Enfermo</option>
                <option value="sano">Sano</option>
            </select><br>

            <label for="agrocalidad">Guía Agrocalidad:</label><br>
            <input type="text" id="agrocalidad" name="agrocalidad" required><br>
            
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

            <div class="boton">
                <button type="submit">Subir Datos</button>
            </div>
        </form>
    </div>

    
    
</body>
</html>

