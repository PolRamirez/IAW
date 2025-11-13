<?php
//Titulo del Ejercicio
echo "<h1>Ejecicio4</h1>"; 

//Inicializamos la variable temporal
$temporal = "Pol";
echo"La varible a sido " .$temporal. "<br>"; 
echo gettype($temporal) . "<br>","<br>";

$temporal = 3.14;
echo"La varible a sido " .$temporal;echo"<br>";
echo gettype($temporal) . "<br>","<br>";


$temporal = false;
echo"La varible a sido FALSE" .$temporal;echo"<br>";
echo gettype($temporal) . "<br>","<br>";


$temporal = 3;
echo"La varible a sido " .$temporal;echo"<br>";
echo gettype($temporal) . "<br>","<br>";


$temporal = null;
echo"La varible a sido NULL" .$temporal;echo"<br>";
echo gettype($temporal) . "<br>","<br>";
?>