<?php
// UltimaVista.php

// Establecemos la zona horaria para que muestre la hora local 
date_default_timezone_set('Europe/Madrid');

// Comprobamos si existe la cookie 'ultima_visita'
if(isset($_COOKIE['ultima_visita'])) {
    // Si existe, mostramos la fecha de la última visita
    $ultima_visita = $_COOKIE['ultima_visita'];
    echo "Tu última visita fue: $ultima_visita";
} else {
    // Si no existe, es la primera visita
    echo "¡Bienvenido por primera vez!";
}

// Guardamos la fecha y hora actual en una cookie
$ahora = date('d/m/Y H:i:s');
// setcookie(nombre, valor, expiración, ruta)
setcookie('ultima_visita', $ahora, time() + (86400 * 30), "/"); // La cookie expira en 30 días
?>