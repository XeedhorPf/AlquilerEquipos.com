<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'conexion.php';

// Variables para los estados de validación
$cliente_validado = false;
$equipo_validado = false;
$nombre_cliente = "";
$nombre_equipo = "";

// Paso 1: Validar cliente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['validar_cliente'])) {
    $id_cliente = $_POST['id_cliente'];
    $sql = "SELECT nombre_cliente FROM clientes WHERE id_cliente = $id_cliente";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $nombre_cliente = $row['nombre_cliente'];
        $cliente_validado = true;
    } else {
        echo "<div class='alert alert-danger'>Cliente no encontrado. Por favor, verifica el ID.</div>";
    }
}

// Paso 2: Validar equipo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['validar_equipo'])) {
    $id_cliente = $_POST['id_cliente'];
    $nombre_cliente = $_POST['nombre_cliente'];
    $id_equipo = $_POST['id_equipo'];
    $sql = "SELECT nombre_equipo FROM equipos WHERE id_equipo = $id_equipo";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $nombre_equipo = $row['nombre_equipo'];
        $cliente_validado = true;
        $equipo_validado = true;
    } else {
        echo "<div class='alert alert-danger'>Equipo no encontrado. Por favor, verifica el ID.</div>";
    }
}

// Paso 3: Registrar alquiler
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar_alquiler'])) {
    $id_cliente = $_POST['id_cliente'];
    $nombre_cliente = $_POST['nombre_cliente'];
    $id_equipo = $_POST['id_equipo'];
    $nombre_equipo = $_POST['nombre_equipo'];
    $tipo_equipo = $_POST['tipo_equipo'];
    $dias_alquiler = $_POST['dias_alquiler'];
    $precio_dia = $_POST['precio_dia'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Calcular el total
    $total = $precio_dia * $dias_alquiler;

    // Insertar datos en la tabla de alquileres
    $sql = "INSERT INTO alquileres (id_equipo, id_cliente, nombre_cliente, nombre_equipo, tipo_equipo, dias_alquiler, precio_dia, total, fecha_inicio, fecha_fin)
            VALUES ($id_equipo, $id_cliente, '$nombre_cliente', '$nombre_equipo', '$tipo_equipo', $dias_alquiler, $precio_dia, $total, '$fecha_inicio', '$fecha_fin')";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success'>Alquiler registrado correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al registrar el alquiler: " . mysqli_error($conn) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Alquiler</title>
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
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 800px; background-color: rgba(255, 255, 255, 0.85); border-radius: 10px;">

        <?php if (!$cliente_validado): ?>
        <!--  Validar cliente -->
        <h2 class="text-center mb-4 text-dark">Validar Cliente</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="id_cliente" class="form-label">ID del Cliente</label>
                <input type="number" class="form-control" id="id_cliente" name="id_cliente" required>
            </div>
            <button type="submit" name="validar_cliente" class="btn btn-primary btn-lg">Validar Cliente</button>
        </form>
        <?php elseif (!$equipo_validado): ?>
        <!-- Validar equipo -->
        <h2 class="text-center mb-4 text-dark">Validar Equipo</h2>
        <form method="POST">
            <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
            <input type="hidden" name="nombre_cliente" value="<?php echo $nombre_cliente; ?>">
            <div class="mb-3">
                <label for="id_equipo" class="form-label">ID del Equipo</label>
                <input type="number" class="form-control" id="id_equipo" name="id_equipo" required>
            </div>
            <button type="submit" name="validar_equipo" class="btn btn-primary btn-lg">Validar Equipo</button>
        </form>
        <?php else: ?>
        <!-- Registrar alquiler -->
        <h2 class="text-center mb-4 text-dark">Registrar Alquiler</h2>
        <form method="POST">
            <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
            <input type="hidden" name="nombre_cliente" value="<?php echo $nombre_cliente; ?>">
            <input type="hidden" name="id_equipo" value="<?php echo $id_equipo; ?>">
            <input type="hidden" name="nombre_equipo" value="<?php echo $nombre_equipo; ?>">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nombre_cliente" class="form-label">Nombre del Cliente</label>
                    <input type="text" class="form-control" id="nombre_cliente" value="<?php echo $nombre_cliente; ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label for="nombre_equipo" class="form-label">Nombre del Equipo</label>
                    <input type="text" class="form-control" id="nombre_equipo" value="<?php echo $nombre_equipo; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tipo_equipo" class="form-label">Tipo de Equipo</label>
                    <input type="text" class="form-control" id="tipo_equipo" name="tipo_equipo" required>
                </div>
                <div class="col-md-6">
                    <label for="dias_alquiler" class="form-label">Días de Alquiler</label>
                    <input type="number" class="form-control" id="dias_alquiler" name="dias_alquiler" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="precio_dia" class="form-label">Precio por Día</label>
                    <input type="number" step="0.01" class="form-control" id="precio_dia" name="precio_dia" required>
                </div>
                <div class="col-md-6">
                    <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                </div>
                <div class="col-md-6">
                    <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                </div>
            </div>
            <button type="submit" name="registrar_alquiler" class="btn btn-success btn-lg">Registrar Alquiler</button>
            <a href="principal.php" class="btn btn-secondary btn-lg">Volver al Inicio</a>
        </form>
        <?php endif; ?>

    </div>
</div>

</body>
</html>
