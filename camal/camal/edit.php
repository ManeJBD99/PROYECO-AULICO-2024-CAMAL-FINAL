<?php
session_start(); 
include("config.php");

// Verifica si la sesión "id_usuario" está establecida
if (isset($_SESSION["id_usuario"])) {
    $id_usuario = $_SESSION["id_usuario"];

    // Verifica si se ha proporcionado un ID de animal para editar
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id_animal = $_GET['id'];

        $sql = "SELECT animal.marca_animal, animal.peso, animal.color, animal.enfermedad, animal.guía_agrocalidad, animal.guía_agrocalidad, entrada_animal.fecha_entrada, entrada_animal.lote, entrada_animal.id_entrada_animal
        FROM entrada_animal
        LEFT JOIN animal ON entrada_animal.id_animal = animal.id_animal
        WHERE animal.id_animal = $id_animal";


        $result = mysqli_query($mysqli, $sql);

        if ($result && mysqli_num_rows($result) == 1) {
            $animal = mysqli_fetch_assoc($result);
        } else {
            echo "Error: Animal no encontrado.";
            exit;
        }
    } else {
        echo "Error: ID de animal no proporcionado.";
        exit;
    }
}

// Si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $marca_animal = $_POST['marca_animal'];
    $peso = $_POST['peso'];
    $enfermedad = $_POST['enfermedad'];
    $agrocalidad = $_POST['agrocalidad'];
    $color = $_POST['color'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $lote = $_POST['lote'];

    // Actualiza los datos del animal en la tabla animal
    $update_sql_animal = "UPDATE animal SET marca_animal = '$marca_animal', peso = '$peso', enfermedad = '$enfermedad', guía_agrocalidad = '$agrocalidad', color = '$color' WHERE id_animal = $id_animal";

    // Actualiza la fecha de entrada y el lote en la tabla entrada_animal
    $update_sql_entrada = "UPDATE entrada_animal SET fecha_entrada = '$fecha_entrada', lote = '$lote' WHERE id_entrada_animal = {$animal['id_entrada_animal']}";

    // Ejecuta ambas consultas SQL
    if (mysqli_query($mysqli, $update_sql_animal) && mysqli_query($mysqli, $update_sql_entrada)) {
        // Redirige de vuelta a la página de visualización de animales después de la actualización
        header("Location: veterinario.php");
        exit();
    } else {
        echo "Error al actualizar el animal: " . mysqli_error($mysqli);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/mystyle1.css" />
    <title>Editar Animal</title>
</head>
<body>
    <div class="formulario-caja">
        <h2 class="titulo">Editar Animal</h2>
        <form action="" method="post">
            <label for="marca_animal">Marca del Animal:</label><br>
            <input type="text" id="marca_animal" name="marca_animal" value="<?php echo $animal['marca_animal']; ?>"><br>
    
            <label for="peso">Peso:</label><br>
            <input type="text" id="peso" name="peso" value="<?php echo $animal['peso']; ?>"><br>
    
            <label for="enfermedad">Estado del animal:</label><br>
            <select id="enfermedad" name="enfermedad">
                <option value="enfermo" <?php if($animal['enfermedad'] == 'enfermo') echo 'selected="selected"'; ?>>Enfermo</option>
                <option value="sano" <?php if($animal['enfermedad'] == 'sano') echo 'selected="selected"'; ?>>Sano</option>
            </select><br>

            <label for="agrocalidad">Guía Agrocalidad:</label><br>
            <input type="text" id="agrocalidad" name="agrocalidad" value="<?php echo $animal['guía_agrocalidad']; ?>"><br>

            <label for="color">Color:</label><br>
            <input type="text" id="color" name="color" value="<?php echo $animal['color']; ?>"><br>
    
            <label for="fecha_entrada">Fecha de Entrada:</label><br>
            <input type="date" id="fecha_entrada" name="fecha_entrada" value="<?php echo $animal['fecha_entrada']; ?>"><br>

            <label for="lote">Lote:</label><br>
            <input type="text" id="lote" name="lote" value="<?php echo $animal['lote']; ?>"><br>

            <div class="boton">
                <button type="submit">Actualizar</button>
            </div>
        </form>
    </div>
</body>
</html>
