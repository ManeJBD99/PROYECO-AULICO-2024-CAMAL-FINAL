<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];

        include("config.php");

        $sql = "SELECT * FROM login WHERE correo = '$correo' AND contraseña = '$contraseña'";
        $result = $mysqli->query($sql);

        if ($result->num_rows == 1) {
            // Si las credenciales son correctas, obtener el ID de usuario asociado con el correo electrónico
            $row = $result->fetch_assoc();
            $id_usuario = $row['id_registro'];

            // Asignar el ID de usuario a la variable de sesión
            $_SESSION["id_usuario"] = $id_usuario;

            // Redirigir al usuario según su rol
            $rol = $row['rol'];
            switch ($rol) {
                case 'veterinario':
                    header("Location: veterinario.php");
                    exit;
                    break;
                case 'inspector':
                    header("Location: inspector.php");
                    exit;
                    break;
                default:
                    echo "Rol no válido.";
                    break;
            }
        } else {
            echo "Correo electrónico o contraseña incorrectos. Por favor, inténtalo de nuevo.";
        }

        $result->free();
        $mysqli->close();
    
} else {
    // Si no se envió un formulario POST, redirigir a la página de inicio de sesión
    header("Location: login.php");
    exit;
}
?>
