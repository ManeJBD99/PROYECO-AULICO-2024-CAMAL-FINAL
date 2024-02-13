<?php
session_start(); 
include("config.php");

if (isset($_SESSION["id_usuario"])) {
    $id_usuario = $_SESSION["id_usuario"];

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id_animal = $_GET['id'];

        $sql = "SELECT tb_salida_animal.fecha_salida, tb_salida_animal.destino,
                       animal.id_animal, animal.marca_animal, tb_registro_sacrificio.metodo_sacrificio, tb_registro_sacrificio.dia_sacrificio
                FROM entrada_animal
                LEFT JOIN animal ON entrada_animal.id_animal = animal.id_animal
                LEFT JOIN tb_salida_animal ON animal.id_animal = tb_salida_animal.id_animal
                LEFT JOIN tb_registro_sacrificio ON animal.id_animal = tb_registro_sacrificio.id_animal
                WHERE animal.id_animal = $id_animal
                AND animal.estado = 'sin_eliminar' 
                AND entrada_animal.estado = 'sin_eliminar'
                AND (tb_salida_animal.estado IS NULL OR tb_salida_animal.estado = 'sin_eliminar')
                AND (tb_registro_sacrificio.estado IS NULL OR tb_registro_sacrificio.estado = 'sin_eliminar')";

        $result = mysqli_query($mysqli, $sql);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "Error: Animal no encontrado.";
            exit;
        }
    } else {
        echo "Error: ID de animal no proporcionado.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha_salida = $_POST['fecha_salida'];
    $destino = $_POST['destino'];
    $metodo_sacrificio = $_POST['metodo_sacrificio'];
    $dia_sacrificio = $_POST['dia_sacrificio'];

    $update_sql_salida = "UPDATE tb_salida_animal SET fecha_salida = '$fecha_salida', destino = '$destino' WHERE id_animal = $id_animal";

    $update_sql_sacrificio = "UPDATE tb_registro_sacrificio SET metodo_sacrificio = '$metodo_sacrificio', dia_sacrificio = '$dia_sacrificio' WHERE id_animal = $id_animal";

    if (mysqli_query($mysqli, $update_sql_salida) && mysqli_query($mysqli, $update_sql_sacrificio)) {
        header("Location: inspectorTabla.php");
        exit();
    } else {
        echo "Error al actualizar los datos: " . mysqli_error($mysqli);
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
            <input type="text" id="marca_animal" name="marca_animal" value="<?php echo $row['marca_animal']; ?>" disabled><br>
    
            <label for="fecha_salida">Fecha de Salida:</label><br>
            <input type="date" id="fecha_salida" name="fecha_salida" value="<?php echo $row['fecha_salida']; ?>"><br>
    
            <label for="destino">Destino:</label><br>
            <input type="text" id="destino" name="destino" value="<?php echo $row['destino']; ?>"><br>

            <label for="metodo_sacrificio">Método de Sacrificio:</label><br>
            <input type="text" id="metodo_sacrificio" name="metodo_sacrificio" value="<?php echo $row['metodo_sacrificio']; ?>"><br>
    
            <label for="dia_sacrificio">Fecha de Sacrificio:</label><br>
            <input type="date" id="dia_sacrificio" name="dia_sacrificio" value="<?php echo $row['dia_sacrificio']; ?>"><br>

            <div class="boton">
                <button type="submit">Actualizar</button>
            </div>
        </form>
    </div>
</body>
</html>
