<?php
session_start(); 
include("config.php");

if (isset($_SESSION["id_usuario"])) {
    $id_usuario = $_SESSION["id_usuario"];

    $sql = "SELECT tb_salida_animal.fecha_salida, tb_salida_animal.destino,
                   animal.id_animal, animal.marca_animal, tb_registro_sacrificio.metodo_sacrificio, tb_registro_sacrificio.dia_sacrificio
            FROM entrada_animal
            LEFT JOIN animal ON entrada_animal.id_animal = animal.id_animal
            LEFT JOIN tb_salida_animal ON animal.id_animal = tb_salida_animal.id_animal
            LEFT JOIN tb_registro_sacrificio ON animal.id_animal = tb_registro_sacrificio.id_animal
            WHERE animal.estado = 'sin_eliminar' 
            AND entrada_animal.estado = 'sin_eliminar'
            AND (tb_salida_animal.estado IS NULL OR tb_salida_animal.estado = 'sin_eliminar')
            AND (tb_registro_sacrificio.estado IS NULL OR tb_registro_sacrificio.estado = 'sin_eliminar')";


    $result = mysqli_query($mysqli, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://kit.fontawesome.com/e46e9d73a7.js" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/mystyle1.css" />
    <title>Inspeccionar</title>
</head>
<body>
    <!-- Menú -->
    <div class="icon-bar">
    <a href="veterinario.php"><i class="fa fa-home"></i></a>
        <a href="animal.php"><i class="fa-solid fa-cow"></i></a>
        <a href="entradaAnimal.php"><i class="fa-solid fa-list-ol"></i></a>
        <a href="datosVeterinario.php"><i class="fa-solid fa-user"></i></a>
        <a href="inspectorTabla2.php"><i class="fa-solid fa-table"></i></a>
        <a href="salir.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <h2>Tabla - Inspector</h2>
    <hr>
    <div class="container">
        <!-- Tabla para mostrar las áreas de la base de datos -->
        <?php
        echo "<table border='1'>
        <tr>
            <th>Marca del Animal</th>
            <th>Fecha de Salida</th>
            <th>Destino</th>
            <th>Método de Sacrificio</th>
            <th>Fecha de Sacrificio</th>
        </tr>";
        while ($row = mysqli_fetch_array($result)) {
            // Recorre cada fila del resultado y muestra los datos
            echo "<tr>";
            echo "<td>" . $row['marca_animal'] . "</td>";
            echo "<td>" . $row['fecha_salida'] . "</td>";
            echo "<td>" . $row['destino'] . "</td>";
            echo "<td>" . $row['metodo_sacrificio'] . "</td>";
            echo "<td>" . $row['dia_sacrificio'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
</body>
</html>
<?php
// Cierra el bloque PHP
}
?>
