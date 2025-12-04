<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'C:/laragon/www/IAW/RA6_CE_D_E_F/gestion_permisos/bbdd/connect.php';

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $pass1 = trim($_POST['pass1']);
    $pass2 = trim($_POST['pass2']);
    
    if ($pass1 !== $pass2) {
        $mensaje = '<div class="error">Las contraseñas no coinciden</div>';
    } elseif (strlen($pass1) < 4) {
        $mensaje = '<div class="error">La contraseña debe tener al menos 4 caracteres</div>';
    } else {
        if (registrar($usuario, $pass1)) {
            $mensaje = '<div class="success">Usuario registrado correctamente</div>';
        } else {
            $mensaje = '<div class="error">El usuario ya existe o hubo un error</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>📝 Registro de Nuevo Usuario</h1>
        
        <?php echo $mensaje; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="usuario">Nombre de usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            
            <div class="form-group">
                <label for="pass1">Contraseña:</label>
                <input type="password" id="pass1" name="pass1" required>
            </div>
            
            <div class="form-group">
                <label for="pass2">Repetir contraseña:</label>
                <input type="password" id="pass2" name="pass2" required>
            </div>
            
            <button type="submit" class="btn">Registrarse</button>
        </form>
        
        <a href="http://localhost/IAW/RA6_CE_D_E_F/gestion_permisos/" class="link">← Volver al Login</a>
    </div>
</body>
</html>