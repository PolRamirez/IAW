<?php

session_start();


$host = "localhost";
$usuario = "root";      
$password = "";         
$basedatos = "gestion_permisos";


function conectar() {
    
    $conexion = new mysqli('localhost', 'root', '', 'gestion_permisos');
    
    if ($conexion->connect_error) {
        die("ERROR DE CONEXIÓN: " . $conexion->connect_error);
    }
    
    $conexion->set_charset("utf8");
    return $conexion;
}

//LOGIN
function login($user, $pass) {
    $conn = conectar();
    $sql = "SELECT * FROM Logins WHERE usuario = ? AND passwd = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows == 1) {
        $_SESSION['usuario'] = $user;
        return true;
    }
    return false;
}

//REGISTRAR USUARIO
function registrar($user, $pass) {
    $conn = conectar();
    $sql = "INSERT INTO Logins (usuario, passwd) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    return $stmt->execute();
}

//OBTENER APP
function getAplicaciones() {
    $conn = conectar();
    $sql = "SELECT * FROM Aplicaciones ORDER BY nombre_aplicacion";
    $resultado = $conn->query($sql);
    return $resultado;
}

//INSERTAR APP
function insertarApp($nombre, $descripcion) {
    $conn = conectar();
    $sql = "INSERT INTO Aplicaciones (nombre_aplicacion, descripcion) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nombre, $descripcion);
    return $stmt->execute();
}

// BORRAR APP
function borrarApp($nombre) {
    $conn = conectar();
    $sql = "DELETE FROM Aplicaciones WHERE nombre_aplicacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre);
    return $stmt->execute();
}
?>