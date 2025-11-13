<?php
//Nombre del ejercicio
echo "<h1>Ejercicio 3 - Información de variable</h1>"; 

//variable string
$nombre = "pol";
echo "Informacion de variable 'nombre' : ";
//Esta funcion nos da el tipo de valor que tiene la variable
var_dump($nombre); echo "<br>";
echo "<br>Contenido de la variable: " . $nombre;echo "<br>";echo "<br>";echo "<br>";

//variable nula
$nulo = null;
echo "Despues de asignarle un valor nulo: ";
var_dump($nulo);echo "<br>";echo "<br>";echo "<br>";

//Variable int
$edad = 21;
echo "Informacion de la variable 'edad' : "; 
var_dump($edad); echo "<br>";
echo "<br>Contenido de la variable: " . $edad;echo "<br>";echo "<br>";echo "<br>";



?>