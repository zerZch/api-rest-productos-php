-- ============================================
-- Script de Base de Datos para API REST de Productos
-- Sistema de Gestión de Productos en PHP
-- ============================================

-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS api_productos;

-- Usar la base de datos
USE api_productos;

-- Eliminar la tabla si existe (para instalación limpia)
DROP TABLE IF EXISTS productos;

-- Crear la tabla productos
CREATE TABLE productos (
    id INT(11) NOT NULL AUTO_INCREMENT,
    codigo VARCHAR(20) NOT NULL,
    producto VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    cantidad INT(11) NOT NULL,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY codigo_unique (codigo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================
-- Datos de Ejemplo (Opcional)
-- ============================================

-- Puedes descomentar las siguientes líneas para insertar datos de prueba

INSERT INTO productos (codigo, producto, precio, cantidad) VALUES
('PROD001', 'Laptop HP 15', 899.99, 15),
('PROD002', 'Mouse Inalámbrico Logitech', 25.50, 50),
('PROD003', 'Teclado Mecánico RGB', 75.00, 30),
('PROD004', 'Monitor Samsung 24"', 199.99, 20),
('PROD005', 'Audífonos Bluetooth Sony', 120.00, 25),
('PROD006', 'Webcam Logitech HD', 65.00, 40),
('PROD007', 'Disco Duro Externo 1TB', 55.99, 35),
('PROD008', 'Memoria USB 64GB', 15.99, 100),
('PROD009', 'Cable HDMI 2.0', 12.50, 80),
('PROD010', 'Hub USB 3.0 4 Puertos', 22.00, 45);

-- ============================================
-- Verificar los datos insertados
-- ============================================

SELECT * FROM productos;

-- ============================================
-- Fin del Script
-- ============================================
