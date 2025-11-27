<?php
include_once 'constantes.php';

// CONEXIONES PDO 
function getConexionPDO()
{
    try {
        $conexion = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE . ";charset=utf8", USERNAME, PASSWORD);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        die("Error de conexión PDO: " . $e->getMessage());
    }
}

function getConexionPDO_sin_bbdd()
{
    try {
        $conexion = new PDO("mysql:host=" . HOST . ";charset=utf8", USERNAME, PASSWORD);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        die("Error de conexión PDO: " . $e->getMessage());
    }
}

// CONEXIONES MySQLi 
function getConexionMySQLi()
{
    $conexion = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if (!$conexion) {
        die("Error de conexión MySQLi: " . mysqli_connect_error());
    }
    return $conexion;
}

function getConexionMySQLi_sin_bbdd()
{
    $conexion = mysqli_connect(HOST, USERNAME, PASSWORD);
    if (!$conexion) {
        die("Error de conexión MySQLi: " . mysqli_connect_error());
    }
    return $conexion;
}

// CREACIÓN DE BD Y TABLAS (MySQLi) 
function crearBBDD_MySQLi($basedatos)
{
    $conexion = getConexionMySQLi_sin_bbdd();
    $sql = "CREATE DATABASE IF NOT EXISTS $basedatos";
    
    if (mysqli_query($conexion, $sql)) {
        mysqli_close($conexion);
        return 1; // Éxito
    } else {
        mysqli_close($conexion);
        return 0; // Error
    }
}

function crearTablas_MySQLi($basedatos)
{
    $conexion = getConexionMySQLi();
    
    // Crear tabla logins
    $sql_logins = "CREATE TABLE IF NOT EXISTS logins (
        usuario VARCHAR(50) PRIMARY KEY,
        passwd CHAR(32) NOT NULL
    )";
    
    // Crear tabla libros
    $sql_libros = "CREATE TABLE IF NOT EXISTS libros (
        numero_ejemplar INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(50) NOT NULL,
        anyo_edicion INT NOT NULL,
        precio DECIMAL(8,2) NOT NULL,
        fecha_adquisicion DATE NOT NULL
    )";
    
    $exito = true;
    
    if (!mysqli_query($conexion, $sql_logins)) {
        $exito = false;
    }
    
    if (!mysqli_query($conexion, $sql_libros)) {
        $exito = false;
    }
    
    mysqli_close($conexion);
    return $exito ? 1 : 0;
}

// CREACIÓN DE BD Y TABLAS (PDO) 
function crearBBDD($basedatos)
{
    $conexion = getConexionPDO_sin_bbdd();
    $sql = "CREATE DATABASE IF NOT EXISTS $basedatos";
    
    try {
        $conexion->exec($sql);
        return 1;
    } catch (PDOException $e) {
        return 0;
    }
}

function crearTablas($basedatos)
{
    $conexion = getConexionPDO();
    
    $sql_logins = "CREATE TABLE IF NOT EXISTS logins (
        usuario VARCHAR(50) PRIMARY KEY,
        passwd CHAR(32) NOT NULL
    )";
    
    $sql_libros = "CREATE TABLE IF NOT EXISTS libros (
        numero_ejemplar INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(50) NOT NULL,
        anyo_edicion INT NOT NULL,
        precio DECIMAL(8,2) NOT NULL,
        fecha_adquisicion DATE NOT NULL
    )";
    
    try {
        $conexion->exec($sql_logins);
        $conexion->exec($sql_libros);
        return 1;
    } catch (PDOException $e) {
        return 0;
    }
}

// AUTENTICACIÓN DE USUARIOS 
function usuarioCorrecto_MySQLi($usuario, $password)
{
    $conexion = getConexionMySQLi();
    $password_md5 = md5($password);
    
    $sql = "SELECT * FROM logins WHERE usuario = ? AND passwd = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $usuario, $password_md5);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $valido = (mysqli_num_rows($result) > 0);
    
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    
    return $valido;
}

function usuarioCorrecto($usuario, $password)
{
    $conexion = getConexionPDO();
    $password_md5 = md5($password);
    
    $sql = "SELECT * FROM logins WHERE usuario = ? AND passwd = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$usuario, $password_md5]);
    
    $valido = ($stmt->rowCount() > 0);
    
    return $valido;
}

function registrarUsuario_MySQLi($usuario, $password)
{
    $conexion = getConexionMySQLi();
    $password_md5 = md5($password);
    
    $sql = "INSERT INTO logins (usuario, passwd) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $usuario, $password_md5);
    
    $exito = mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    
    return $exito;
}

function registrarUsuario($usuario, $password)
{
    $conexion = getConexionPDO();
    $password_md5 = md5($password);
    
    $sql = "INSERT INTO logins (usuario, passwd) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    
    try {
        $exito = $stmt->execute([$usuario, $password_md5]);
        return $exito;
    } catch (PDOException $e) {
        return false;
    }
}

// OPERACIONES CRUD DE LIBROS
function insertarLibro_MySQLi($titulo, $anyo, $precio, $fechaAdquisicion)
{
    $conexion = getConexionMySQLi();
    
    $sql = "INSERT INTO libros (titulo, anyo_edicion, precio, fecha_adquisicion) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sids", $titulo, $anyo, $precio, $fechaAdquisicion);
    
    $exito = mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    
    return $exito;
}

function insertarLibro($titulo, $anyo, $precio, $fechaAdquisicion)
{
    $conexion = getConexionPDO();
    
    $sql = "INSERT INTO libros (titulo, anyo_edicion, precio, fecha_adquisicion) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    
    try {
        $exito = $stmt->execute([$titulo, $anyo, $precio, $fechaAdquisicion]);
        return $exito;
    } catch (PDOException $e) {
        return false;
    }
}

function getLibros_MySQLi()
{
    $conexion = getConexionMySQLi();
    $sql = "SELECT * FROM libros";
    $result = mysqli_query($conexion, $sql);
    
    $libros = [];
    while ($fila = mysqli_fetch_object($result)) {
        $libros[] = $fila;
    }
    
    mysqli_close($conexion);
    return $libros;
}

function getLibros()
{
    $conexion = getConexionPDO();
    $sql = "SELECT * FROM libros";
    $stmt = $conexion->query($sql);
    
    $libros = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $libros;
}

function getLibrosTitulo_MySQLi()
{
    $conexion = getConexionMySQLi();
    $sql = "SELECT titulo FROM libros";
    $result = mysqli_query($conexion, $sql);
    
    $titulos = [];
    while ($fila = mysqli_fetch_assoc($result)) {
        $titulos[] = $fila['titulo'];
    }
    
    mysqli_close($conexion);
    return $titulos;
}

function getLibrosTitulo()
{
    $conexion = getConexionPDO();
    $sql = "SELECT titulo FROM libros";
    $stmt = $conexion->query($sql);
    
    $titulos = $stmt->fetchAll(PDO::FETCH_COLUMN);
    return $titulos;
}

function borrarLibro($numeroEjemplar)
{
    $conexion = getConexionPDO();
    
    // Primero obtener el precio del libro a borrar
    $sql_precio = "SELECT precio FROM libros WHERE numero_ejemplar = ?";
    $stmt_precio = $conexion->prepare($sql_precio);
    $stmt_precio->execute([$numeroEjemplar]);
    $precio = $stmt_precio->fetchColumn();
    
    // Luego borrar el libro
    $sql_borrar = "DELETE FROM libros WHERE numero_ejemplar = ?";
    $stmt_borrar = $conexion->prepare($sql_borrar);
    $exito = $stmt_borrar->execute([$numeroEjemplar]);
    
    return $exito ? $precio : false;
}

function borrarLibro_MySQLi($numeroEjemplar)
{
    $conexion = getConexionMySQLi();
    
    // Obtener precio
    $sql_precio = "SELECT precio FROM libros WHERE numero_ejemplar = ?";
    $stmt_precio = mysqli_prepare($conexion, $sql_precio);
    mysqli_stmt_bind_param($stmt_precio, "i", $numeroEjemplar);
    mysqli_stmt_execute($stmt_precio);
    mysqli_stmt_bind_result($stmt_precio, $precio);
    mysqli_stmt_fetch($stmt_precio);
    mysqli_stmt_close($stmt_precio);
    
    // Borrar libro
    $sql_borrar = "DELETE FROM libros WHERE numero_ejemplar = ?";
    $stmt_borrar = mysqli_prepare($conexion, $sql_borrar);
    mysqli_stmt_bind_param($stmt_borrar, "i", $numeroEjemplar);
    $exito = mysqli_stmt_execute($stmt_borrar);
    
    mysqli_stmt_close($stmt_borrar);
    mysqli_close($conexion);
    
    return $exito ? $precio : false;
}

function modificarLibroAnyo_MySQLi($numero_ejemplar, $anyo_edicion)
{
    $conexion = getConexionMySQLi();
    
    $sql = "UPDATE libros SET anyo_edicion = ? WHERE numero_ejemplar = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $anyo_edicion, $numero_ejemplar);
    
    $exito = mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    
    return $exito;
}

function modificarLibroAnyo($numero_ejemplar, $anyo_edicion)
{
    $conexion = getConexionPDO();
    
    $sql = "UPDATE libros SET anyo_edicion = ? WHERE numero_ejemplar = ?";
    $stmt = $conexion->prepare($sql);
    
    try {
        $exito = $stmt->execute([$anyo_edicion, $numero_ejemplar]);
        return $exito;
    } catch (PDOException $e) {
        return false;
    }
}

// Funciones auxiliares para actualizar página
function getLibrosAnyo_MySQLi($libro)
{
    $conexion = getConexionMySQLi();
    
    $sql = "SELECT numero_ejemplar, titulo, anyo_edicion FROM libros WHERE titulo = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $libro);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $libros = [];
    while ($fila = mysqli_fetch_assoc($result)) {
        $libros[] = $fila;
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    
    return $libros;
}

function getLibrosAnyo($libro)
{
    $conexion = getConexionPDO();
    
    $sql = "SELECT numero_ejemplar, titulo, anyo_edicion FROM libros WHERE titulo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$libro]);
    
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $libros;
}

// Funciones adicionales (para completar todas las del archivo)
function modificarLibro_MySQLi($numero_ejemplar, $precio)
{
    $conexion = getConexionMySQLi();
    
    $sql = "UPDATE libros SET precio = ? WHERE numero_ejemplar = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "di", $precio, $numero_ejemplar);
    
    $exito = mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    
    return $exito;
}

function modificarLibro($numero_ejemplar, $precio)
{
    $conexion = getConexionPDO();
    
    $sql = "UPDATE libros SET precio = ? WHERE numero_ejemplar = ?";
    $stmt = $conexion->prepare($sql);
    
    try {
        $exito = $stmt->execute([$precio, $numero_ejemplar]);
        return $exito;
    } catch (PDOException $e) {
        return false;
    }
}

function arrayFlotante($array) {
    return array_map('floatval', $array);
}

function getLibrosPrecio_MySQLi($libro)
{
    $conexion = getConexionMySQLi();
    
    $sql = "SELECT precio FROM libros WHERE titulo = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $libro);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $precio);
    mysqli_stmt_fetch($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    
    return $precio;
}

function getLibrosPrecio($libro)
{
    $conexion = getConexionPDO();
    
    $sql = "SELECT precio FROM libros WHERE titulo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$libro]);
    
    $precio = $stmt->fetchColumn();
    return $precio;
}
?>