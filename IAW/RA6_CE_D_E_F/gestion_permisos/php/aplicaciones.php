<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'C:/laragon/www/IAW/RA6_CE_D_E_F/gestion_permisos/bbdd/connect.php';

// VERIFICAR SESIÓN
if (!isset($_SESSION['usuario'])) {
    header("Location: http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/");
    exit();
}

// INSERTAR NUEVA APP
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insertar'])) {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    
    if (!empty($nombre)) {
        insertarApp($nombre, $descripcion);
    }
}

// BORRAR APP
if (isset($_GET['borrar'])) {
    $nombre = $_GET['borrar'];
    borrarApp($nombre);
    header("Location: http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/php/aplicaciones.php");
    exit();
}

$apps = getAplicaciones();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Aplicaciones</title>
    <link rel="stylesheet" href="http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/css/styles.css">
</head>
<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>📋 Gestión de Aplicaciones</h1>
            <a href="http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/php/principal.php" class="link">← Volver</a>
        </div>
        
        <!-- LISTADO DE APP -->
        <h3>Aplicaciones Existentes:</h3>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $apps->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nombre_aplicacion']); ?></td>
                        <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                        <td>
                            <button class="delete-btn" 
                                    onclick="if(confirm('¿Borrar esta aplicación?')) {
                                        window.location.href='http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/php/aplicaciones.php?borrar=<?php echo urlencode($row['nombre_aplicacion']); ?>'
                                    }">
                                Borrar
                            </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        
        <!-- FORMULARIO PARA AGREGAR -->
        <h3>Agregar Nueva Aplicación:</h3>
        <form method="POST" action="">
            <div >
                <label for="nombre">Nombre de la aplicación:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="3"></textarea>
            </div>
            
            <button type="submit" name="insertar" class="btn">Agregar Aplicación</button>
        </form>
        
        <div style="margin-top: 20px; text-align: center;">
            <a href="http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/php/logout.php" class="link">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>