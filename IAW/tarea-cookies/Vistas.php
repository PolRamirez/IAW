<?php
// Vistas.php

// ESTA LÍNEA ES OBLIGATORIA - debe ser lo PRIMERO en el archivo
session_start();

// Comprobamos si existe el contador de visitas
if(isset($_SESSION['visitas'])) {
    // Si existe, aumentamos el contador en 1
    $_SESSION['visitas']++;
} else {
    // Si no existe, inicializamos el contador en 1 (primera visita)
    $_SESSION['visitas'] = 1;
}

// Mostramos el número total de visitas
echo "<h2>Contador de visitas</h2>";
echo "Número de visitas a esta página: " . $_SESSION['visitas'];

// Mensaje adicional para entender cómo funciona
echo "<br><br><p>Recarga la página para aumentar el contador.</p>";
?>