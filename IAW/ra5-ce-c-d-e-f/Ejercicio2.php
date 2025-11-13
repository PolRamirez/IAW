<?php
// Función para verificar si un número es primo
function esPrimo($numero) {
    // Comprobamos divisores desde 2 hasta la mitad del número
    for ($i = 2; $i <= $numero / 2; $i++) {
        if ($numero % $i == 0) {
            return false; // No es primo si encuentra un divisor
        }
    }
    return true; // Es primo si no encontró divisores
}

// Recorremos todos los números del 3 al 999
for ($num = 3; $num <= 999; $num++) {
    // Si el número es primo, lo mostramos
    if (esPrimo($num)) {
        echo $num . ",  <b>";
    }
}
?>