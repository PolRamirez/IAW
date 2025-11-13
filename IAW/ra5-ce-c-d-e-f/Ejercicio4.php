<?php
// Array con nombres de películas (en mayúsculas)
$peliculas = array(
    "UNA PELICULA",
    "DOS PELICULAS", 
    "TRES PELICULAS",
    "CUATRO PELICULAS",
    "CINCO PELICULAS",
    "SEIS PELICULAS",
    "SIETE PELICULAS",
    "OCHO PELICULAS",
    "NUEVE PELICULAS",
    "DIEZ PELICULAS"
);

// Función que convierte una cadena de mayúsculas a minúsculas
function pasar_minuscula($cadena) {
    return strtolower($cadena); // strtolower convierte todo a minúsculas
}

// Verificamos si se envió el formulario de búsqueda
if (isset($_POST['buscar'])) {
    $termino_busqueda = $_POST['busqueda'];
    $resultados = array();
    
    foreach ($peliculas as $pelicula) {
        // Usamos la función para convertir a minúsculas antes de buscar
        $pelicula_minuscula = pasar_minuscula($pelicula);
        $termino_minuscula = pasar_minuscula($termino_busqueda);
        
        // Buscamos en las versiones en minúsculas
        if (stripos($pelicula_minuscula, $termino_minuscula) !== false) {
            $resultados[] = $pelicula; // Guardamos el nombre original
        }
    }
}
?>

<!--  HTML -->
<!DOCTYPE html>
<html>
<head>
    <title>Buscador de Películas</title>
</head>
<body>
    <h2>Buscador de Películas</h2>
    
    <form method="post">
        <input type="text" name="busqueda" placeholder="Buscar película...">
        <input type="submit" name="buscar" value="Buscar">
    </form>
    
    <?php
    if (isset($resultados)) {
        echo "<h3>Resultados de la búsqueda:</h3>";
        
        if (count($resultados) > 0) {
            echo "<ul>";
            foreach ($resultados as $resultado) {
                // Mostramos el resultado en minúsculas usando nuestra función
                echo "<li>" . pasar_minuscula($resultado) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No se encontraron películas con ese nombre.</p>";
        }
    }
    ?>
</body>
</html>