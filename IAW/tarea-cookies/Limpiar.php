<?php
// ejercicio4.php

// Iniciar sesión - OBLIGATORIO para usar $_SESSION
session_start();

// Simulamos que el usuario se autenticó correctamente
if(!isset($_SESSION['usuario_autenticado'])) {
       
    // Como es un ejercicio, simulamos que la autenticación fue exitosa
    $_SESSION['usuario_autenticado'] = true;
    $_SESSION['nombre_usuario'] = "usuario_ejemplo"; // Nombre del usuario logueado
}
    // El usuario está autenticado, podemos mostrar el contenido
if($_SESSION['usuario_autenticado']) {
    
    // Crear el array de visitas si no existe (primera vez)
    if(!isset($_SESSION['historial_visitas'])) {
        $_SESSION['historial_visitas'] = array();
    }
    
    // Obtener la fecha y hora actual para registrar la visita
    $fecha_actual = date('d/m/Y H:i:s');
    
    // Añadir la visita actual al historial
    array_push($_SESSION['historial_visitas'], $fecha_actual);
    
    // MOSTRAR LA INFORMACIÓN AL USUARIO     
    echo "<h2>Control de Visitas - Usuario: " . $_SESSION['nombre_usuario'] . "</h2>";
    
    // Comprobar si es la primera visita
    $total_visitas = count($_SESSION['historial_visitas']);
    
    if($total_visitas == 1) {
        echo "<p style='color: green;'><strong>¡Bienvenido por primera vez!</strong></p>";
    } else {
        echo "<p><strong>Tus visitas anteriores:</strong></p>";
        echo "<ul>";
        
        // Mostrar todas las visitas guardadas
        foreach($_SESSION['historial_visitas'] as $indice => $fecha_visita) {
            $numero_visita = $indice + 1; // Para que empiece en 1 en lugar de 0
            echo "<li>Visita $numero_visita: $fecha_visita</li>";
        }
        
        echo "</ul>";
        echo "<p><strong>Total de visitas: $total_visitas</strong></p>";
    }
    
    // BOTÓN PARA BORRAR EL HISTORIAL  
    echo '<form method="post" style="margin-top: 20px;">';
    echo '<button type="submit" name="borrar_historial">Borrar Historial de Visitas</button>';
    echo '</form>';
    
    // PROCESAR EL BORRADO DEL HISTORIAL    
    if(isset($_POST['borrar_historial'])) {
        // Vaciar el array del historial
        $_SESSION['historial_visitas'] = array();
        
        // Mostrar mensaje de confirmación
        echo "<p style='color: red;'><strong>El historial de visitas ha sido borrado.</strong></p>";
        
        // Recargar la página para actualizar la vista
        header("Location: Limpiar.php");
        exit();
    }
    
} else {
    // USUARIO NO AUTENTICADO    
    echo "<h2>Acceso Denegado</h2>";
    echo "<p>No estás autenticado. Debes iniciar sesión para acceder a esta página.</p>";
    echo "<p>En una aplicación real, aquí redirigiríamos al formulario de login.</p>";
}

// INFORMACIÓN ADICIONAL (PARA ENTENDER MEJOR)
echo "<hr>";
echo "<h3>Información de la Sesión:</h3>";
echo "<p>ID de sesión: " . session_id() . "</p>";
echo "<p>Usuario autenticado: " . ($_SESSION['usuario_autenticado'] ? 'SÍ' : 'NO') . "</p>";
echo "<p>Total de visitas registradas: " . (isset($_SESSION['historial_visitas']) ? count($_SESSION['historial_visitas']) : 0) . "</p>";
?>