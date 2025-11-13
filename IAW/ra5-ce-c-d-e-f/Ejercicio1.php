<?php
// Primer bucle: controla las filas (de 10 a 1)
for ($i = 10; $i >= 1; $i--) {
    // Segundo bucle: controla los números en cada fila
    for ($j = $i; $j >= 1; $j--) {
        echo $j . " "; // Muestra el número seguido de un espacio
    }
    
    echo "<br>"; // Salto de línea después de cada fila
}
?>