<?php
// Almacenar.php

// 1. INICIAR SESIÓN (IMPORTANTE)
session_start();

// 2. Crear el array si no existe
if(empty($_SESSION['fechas'])) {
    $_SESSION['fechas'] = array();
}

// 3. Añadir la fecha actual
$hoy = date('H:i:s');
$_SESSION['fechas'][] = $hoy;

// 4. MOSTRAR RESULTADO
echo "<h2>Ejercicio 3 - Fechas de Visitas</h2>";

// Mostrar todas las fechas guardadas
echo "Todas tus visitas:<br>";
foreach($_SESSION['fechas'] as $numero => $fecha) {
    $visita = $numero + 1;
    echo "Visita $visita: $fecha<br>";
}

// Mostrar cuántas visitas hay
echo "<br><strong>Total de visitas: " . count($_SESSION['fechas']) . "</strong>";

// Mensaje para probar
echo "<br><br><small>Recarga la página para añadir más visitas</small>";
?>