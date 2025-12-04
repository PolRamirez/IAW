<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'C:/laragon/www/IAW/RA6_CE_D_E_F/gestion_permisos/bbdd/connect.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $passwd = trim($_POST['passwd']);
    
    if (login($usuario, $passwd)) {
        header("Location: http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/php/principal.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Gestión</title>
    <link rel="stylesheet" href="http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>🔐¡ Sistema de Gestión de Permisos</h1>
        
        
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            
            <div class="form-group">
                <label for="passwd">Contraseña:</label>
                <input type="password" id="passwd" name="passwd" required>
            </div>
            
            <button type="submit" class="btn">Iniciar Sesión</button>
        </form>
        
        <a href="http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/php/registrarse.php" class="link">
            ¿No tienes cuenta? Regístrate aquí
        </a>
    </div>
</body>
</html>