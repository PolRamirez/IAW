<?php
echo "<h1>Ejercicio 2 Calculadora</h1>"; 
//Variables
$operador1 = 13;
$operador2 = 4;

echo "El primer num es " .$operador1; echo"<br>";echo"<br>";
echo "El segundo num es " .$operador2; echo"<br>";echo"<br>";

// Resta
$resultado = $operador1 - $operador2;
echo "13 - 4 = $resultado<br>";

// Suma
$resultado = $operador1 + $operador2;
echo "13 + 4 = $resultado<br>";

// Multiplicación
$resultado = $operador1 * $operador2;
echo "13 * 4 = $resultado<br>";

// División
$resultado = $operador1 / $operador2;
echo "13 / 4 = $resultado<br>";

// Módulo (resto de la división)
$resultado = $operador1 % $operador2;
echo "13 % 4 = $resultado<br>";
?>