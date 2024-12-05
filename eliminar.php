<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'conexion.php'; // Conexión a la base de datos

    $id = $_POST['id']; // Captura del ID ingresado en el formulario

    // Consulta para eliminar un registro de la tabla 'alquileres'
    $sql = "DELETE FROM alquileres WHERE id_alquiler=$id";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success text-center'>Registro eliminado correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error al eliminar el registro: " . mysqli_error($conn) . "</div>";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
 <!-- Barra de navegación -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-secondary  shadow-sm rounded">
            <div class="container-fluid">
              
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="insertar.php">Insertar Registro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="actualizar.php">Actualizar Registro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="eliminar.php">Eliminar Registro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listar.php">Listar Registros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="consultar.php">Consulta SQL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="salir.php">Cerrar Sesión</a>
                        </li>
                    </ul> 
                </div>
            </div>
        </nav>
    </div>
<body class="bg-dark text-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; background-color: rgba(255, 255, 255, 0.85); border-radius: 10px;">
        <h2 class="text-center mb-4 text-dark">Eliminar Registro</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="id" class="form-label">ID a eliminar</label>
                <input type="text" class="form-control" id="id" name="id" placeholder="Ingresa el ID" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="principal.php" class="btn btn-secondary btn-lg">Volver al Inicio</a>
                <button type="submit" class="btn btn-danger btn-lg">Eliminar</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

