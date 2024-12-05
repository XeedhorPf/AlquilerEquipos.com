<?php
include("conexion.php");
$datos = new basedatos();

// Verificar si los datos fueron enviados mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar si las claves 'usuario' y 'clave' existen en $_POST
    if (isset($_POST['usuario']) && isset($_POST['clave'])) {
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];

        $resultado = $datos->login($usuario, $clave);
        $array = mysqli_fetch_array($resultado);

        if ($array && $array['registros'] > 0) {
            session_start();
            $_SESSION['username'] = $usuario;
            header("location:principal.php");
            exit();
        } else {
            echo "Datos inválidos.";
        }
    } else {
        echo "Por favor, completa ambos campos.";
    }
} else {
    echo "Acceso no válido.";
}
?>
