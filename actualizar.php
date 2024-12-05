<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'conexion.php';

// Si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Si estamos actualizando un alquiler
    if (isset($_POST['id_alquiler'])) {
        // Captura el id de alquiler del formulario
        $id_alquiler = $_POST['id_alquiler'];
        
        // Consulta para obtener los datos del alquiler
        $sql = "SELECT * FROM alquileres WHERE id_alquiler = $id_alquiler";
        $result = mysqli_query($conn, $sql);

        // Si encontramos el alquiler, mostramos los datos
        if ($row = mysqli_fetch_assoc($result)) {
            // Asignar los datos al array para su visualización
            $id_equipo = $row['id_equipo'];
            $id_cliente = $row['id_cliente'];
            $nombre_cliente = $row['nombre_cliente'];
            $nombre_equipo = $row['nombre_equipo'];
            $tipo_equipo = $row['tipo_equipo'];
            $dias_alquiler = $row['dias_alquiler'];
            $precio_dia = $row['precio_dia'];
            $fecha_inicio = $row['fecha_inicio'];
            $fecha_fin = $row['fecha_fin'];
        } else {
            echo "<div class='alert alert-danger'>Alquiler no encontrado.</div>";
        }
    }

    // Si se está actualizando el alquiler
    if (isset($_POST['actualizar'])) {
        $id_equipo = $_POST['id_equipo'];
        $id_cliente = $_POST['id_cliente'];
        $nombre_cliente = $_POST['nombre_cliente'];
        $nombre_equipo = $_POST['nombre_equipo'];
        $tipo_equipo = $_POST['tipo_equipo'];
        $dias_alquiler = $_POST['dias_alquiler'];
        $precio_dia = $_POST['precio_dia'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];

        $total = $precio_dia * $dias_alquiler;

        $sql = "UPDATE alquileres 
                SET id_equipo='$id_equipo', id_cliente='$id_cliente', nombre_cliente='$nombre_cliente', nombre_equipo='$nombre_equipo', tipo_equipo='$tipo_equipo', dias_alquiler='$dias_alquiler', precio_dia='$precio_dia', total='$total', fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin'
                WHERE id_alquiler=$id_alquiler";

        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success'>Alquiler actualizado correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al actualizar el alquiler: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>



<!-- Formulario para buscar alquiler por ID -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Alquiler</title>
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
        <h2 class="text-center mb-4 text-dark">Actualizar Alquiler</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="id_alquiler" class="form-label">ID del Alquiler</label>
                <input type="number" class="form-control" id="id_alquiler" name="id_alquiler" required>
            </div>
            <button type="submit" class="btn btn-info btn-lg btn-block">Buscar Alquiler</button>
        </form>
    </div>
</div>

<?php if (isset($id_alquiler)): ?>
<!-- Formulario de actualización del alquiler -->
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; background-color: rgba(255, 255, 255, 0.85); border-radius: 10px;">
        <form method="POST">
            <input type="hidden" name="id_alquiler" value="<?php echo $id_alquiler; ?>">

            <div class="mb-3">
                <label for="id_equipo" class="form-label">ID del Equipo</label>
                <input type="number" class="form-control" id="id_equipo" name="id_equipo" value="<?php echo $id_equipo; ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_cliente" class="form-label">ID del Cliente</label>
                <input type="number" class="form-control" id="id_cliente" name="id_cliente" value="<?php echo $id_cliente; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nombre_cliente" class="form-label">Nombre del Cliente</label>
                <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" value="<?php echo $nombre_cliente; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nombre_equipo" class="form-label">Nombre del Equipo</label>
                <input type="text" class="form-control" id="nombre_equipo" name="nombre_equipo" value="<?php echo $nombre_equipo; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tipo_equipo" class="form-label">Tipo de Equipo</label>
                <input type="text" class="form-control" id="tipo_equipo" name="tipo_equipo" value="<?php echo $tipo_equipo; ?>" required>
            </div>
            <div class="mb-3">
                <label for="dias_alquiler" class="form-label">Días de Alquiler</label>
                <input type="number" class="form-control" id="dias_alquiler" name="dias_alquiler" value="<?php echo $dias_alquiler; ?>" required>
            </div>
            <div class="mb-3">
                <label for="precio_dia" class="form-label">Precio por Día</label>
                <input type="number" step="0.01" class="form-control" id="precio_dia" name="precio_dia" value="<?php echo $precio_dia; ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo $fecha_fin; ?>" required>
            </div>

            <div class="text-center">
                <button type="submit" name="actualizar" class="btn btn-success btn-lg">Actualizar Alquiler</button>
                <a href="principal.php" class="btn btn-secondary btn-lg">Volver al Inicio</a>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>
</body>
</html>
