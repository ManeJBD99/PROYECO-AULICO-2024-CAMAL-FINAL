<?php
session_start(); 
include("config.php");

if (isset($_SESSION["id_usuario"])) {
    $id_usuario = $_SESSION["id_usuario"];

    $sql = "SELECT animal.marca_animal, animal.color, animal.enfermedad, animal.guía_agrocalidad, entrada_animal.fecha_entrada, entrada_animal.id_animal, entrada_animal.lote
    FROM entrada_animal
    LEFT JOIN animal ON entrada_animal.id_animal = animal.id_animal
    WHERE animal.estado = 'sin_eliminar' 
    AND entrada_animal.estado = 'sin_eliminar' 
    AND animal.enfermedad = 'sano'";

    $result = mysqli_query($mysqli, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://kit.fontawesome.com/e46e9d73a7.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/mystyle1.css" />
    <title>Veterinario</title>
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
    <h2>Veterinario</h2>
    <hr>
    <div class="container">
        <!-- Tabla para mostrar las áreas de la base de datos -->
        <?php
        echo "<table border='1'>
        <tr>
            <th>Marca del Animal</th>
            <th>Color</th>
            <th>Enfermedad</th>
            <th>Guía Agrocalidad</th>
            <th>Fecha de Entrada</th>
            <th>Lote</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>";
        while ($row = mysqli_fetch_array($result)) {
            // Recorre cada fila del resultado y muestra los datos
            echo "<tr>";
            echo "<td>" . $row['marca_animal'] . "</td>";
            echo "<td>" . $row['color'] . "</td>";
            echo "<td>" . $row['enfermedad'] . "</td>";
            echo "<td>" . $row['guía_agrocalidad'] . "</td>";
            echo "<td>" . $row['fecha_entrada'] . "</td>";
            echo "<td>" . $row['lote'] . "</td>";
            echo "<td><a href='edit.php?id=" . $row['id_animal'] . "'><img src='./images/icons8-Edit-32.png' alt='Edit'></a></td>";
            echo "<td><a href='delete.php?id=" . $row['id_animal'] . "'><img src='./images/icons8-Trash-32.png' alt='Delete'></a></td>";
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
