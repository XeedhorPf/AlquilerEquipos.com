<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'conexion.php';

// Consulta SQL para filtrar alquileres
$sql = "SELECT e.id_equipo, e.nombre_equipo, c.nombre_cliente, a.total, a.dias_alquiler
        FROM alquileres a
        JOIN equipos e ON a.id_equipo = e.id_equipo
        JOIN clientes c ON a.id_cliente = c.id_cliente
        WHERE a.total >= 50000 AND a.dias_alquiler >= 5";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Alquileres</title>
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

<div class="container mt-5">
    <h2 class="text-center mb-4">Alquileres con Deuda Mayor a $50,000 y Más de 5 Días</h2>
    <div class="card shadow-lg" style="background-color: rgba(255, 255, 255, 0.85);">
        <div class="card-body">
            <table class="table table-hover table-bordered text-dark">
                <thead class="table-dark">
                    <tr>
                        <th>ID del Equipo</th>
                        <th>Nombre del Equipo</th>
                        <th>Nombre del Cliente</th>
                        <th>Total Deuda</th>
                        <th>Días de Alquiler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id_equipo']; ?></td>
                        <td><?php echo $row['nombre_equipo']; ?></td>
                        <td><?php echo $row['nombre_cliente']; ?></td>
                        <td><?php echo number_format($row['total'], 2); ?></td>
                        <td><?php echo $row['dias_alquiler']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="text-center mt-4">
                <a href="principal.php" class="btn btn-secondary btn-lg">Volver al Inicio</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
