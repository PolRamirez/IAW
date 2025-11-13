<?php
// Array con nombres de películas (del uno al diez en español)
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

// Verificamos si se envió el formulario de búsqueda
if (isset($_POST['buscar'])) {
    $termino_busqueda = $_POST['busqueda']; // Obtenemos lo que escribió el usuario
    $resultados = array(); // Array para guardar las películas que coincidan
    
    // Recorremos todas las películas
    foreach ($peliculas as $pelicula) {
        // Buscamos si el término está en el nombre de la película
        // stripos busca sin distinguir mayúsculas/minúsculas
        if (stripos($pelicula, $termino_busqueda) !== false) {
            $resultados[] = $pelicula; // Añadimos al array de resultados
        }
    }
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html>
<head>
    <title>Buscador de Películas</title>
</head>
<body>
    <h2>Buscador de Películas</h2>
    
    <!-- Formulario para buscar -->
    <form method="post">
        <input type="text" name="busqueda" placeholder="Buscar película...">
        <input type="submit" name="buscar" value="Buscar">
    </form>
    
    <?php
    // Mostramos resultados si se realizó una búsqueda
    if (isset($resultados)) {
        echo "<h3>Resultados de la búsqueda:</h3>";
        
        if (count($resultados) > 0) {
            // Si hay resultados, los mostramos en una lista
            echo "<ul>";
            foreach ($resultados as $resultado) {
                echo "<li>" . $resultado . "</li>";
            }
            echo "</ul>";
        } else {
            // Si no hay resultados
            echo "<p>No se encontraron películas con ese nombre.</p>";
        }
    }
    ?>
</body>
</html>