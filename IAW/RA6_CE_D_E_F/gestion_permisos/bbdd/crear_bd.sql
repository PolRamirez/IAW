CREATE DATABASE IF NOT EXISTS gestion_permisos ;
USE gestion_permisos;

CREATE TABLE Logins (
    usuario VARCHAR(50) PRIMARY KEY,
    passwd VARCHAR(32) NOT NULL
);

CREATE TABLE Aplicaciones (
    nombre_aplicacion VARCHAR(50) PRIMARY KEY,
    descripcion VARCHAR(300)
);

-- DATO PRUEBAS
INSERT INTO Logins (usuario, passwd) VALUES 
('admin', 'admin123'),
('maria', 'clave123'),
('carlos', 'password456');

INSERT INTO Aplicaciones (nombre_aplicacion, descripcion) VALUES 
('Visual Studio Code', 'Editor de código'),
('Word', 'Procesador de textos'),
('Excel', 'Hoja de cálculo'),
('Photoshop', 'Editor de imágenes');