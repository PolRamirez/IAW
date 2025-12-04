<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'C:/laragon/www/IAW/RA6_CE_D_E_F/gestion_permisos/bbdd/connect.php';

// VERIFICAR SESIÓN
if (!isset($_SESSION['usuario'])) {
    header("Location: http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/css/styles.css">
</head>
<body>
    <div class="container">
        <div class="logout">
            <small>Usuario: <strong><?php echo $_SESSION['usuario']; ?></strong></small>
            <a href="http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/php/logout.php" class="link">Cerrar Sesión</a>
        </div>
        
        <h1>🏠 Panel de Control</h1>
        <p>Bienvenido al sistema de gestión de permisos de aplicaciones.</p>
        
        <div style="margin: 30px 0; text-align: center;">
            <a href="http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/php/aplicaciones.php" class="btn" style="width: 300px; display: inline-block;">
                📋 Gestionar Aplicaciones
            </a>
        </div>
        
        <h3>Acciones disponibles:</h3>
        <ul style="margin: 20px 0 20px 30px; font-size: 18px;">
            <li>Ver listado de aplicaciones</li>
            <li>Agregar nuevas aplicaciones</li>
            <li>Eliminar aplicaciones existentes</li>
        </ul>
        
        <a href="http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/" class="link">← Volver al Inicio</a>
    </div>
</body>
</html>