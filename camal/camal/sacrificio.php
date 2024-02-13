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
    <title>Sacrificio</title>
</head>
<body>
     <!-- Creamos un menu     -->
     <div class="icon-bar">
     <a href="inspector.php"><i class="fa fa-home"></i></a>
        <a href="salidaAnimal.php"><i class="fa-solid fa-cow"></i></a>
        <a href="sacrificio.php"><i class="fa-solid fa-book-skull"></i></a>
        <a href="datosInspector.php"><i class="fa-solid fa-user"></i></a>
        <a href="inspectorTabla.php"><i class="fa-solid fa-table"></i></a>
        <a href="salir.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
    </div>

    <div class="formulario-caja">
        <h2 class="titulo">Sacrifico</h2>
        
        <form class="formulario" action="procesarSacrificio.php" method="POST">

            <label for="metodo_sacrificio">Metodo de sacrificio:</label><br>
            <input type="text" id="metodo_sacrificio" name="metodo_sacrificio" required><br>

            <label for="fecha_sacrificio">Fecha sacrificio:</label><br>
            <input type="date" id="fecha_sacrificio" name="fecha_sacrificio" required><br>

            <label for="id_animal">Marca del Animal:</label><br>
            <select id="id_animal" name="id_animal" required>
            <?php
                    $query = "SELECT id_animal, marca_animal FROM animal WHERE estado = 'sin_eliminar' AND enfermedad = 'sano'";
                    $result = $mysqli->query($query);
                    if (!$result) {
                        die('Error en la consulta SQL: ' . $mysqli->error);
                    }
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"{$row['id_animal']}\">{$row['marca_animal']}</option>";
                    }

                    $result->free();
                ?>
            </select><br>

            
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

            <div class="boton">
                <button type="submit">Subir Datos</button>
            </div>
        </form>
    </div>
    
</body>
</html>

