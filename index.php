<?php
/**
 * Punto de entrada principal de la API
 * Redirige las peticiones al controlador correspondiente
 */

// Activar la visualización de errores (solo para desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Headers básicos
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Verificar si se está accediendo al endpoint de productos
if(isset($_GET['recurso']) && $_GET['recurso'] == 'productos') {
    include_once 'controllers/ProductosController.php';
} else {
    // Mensaje de bienvenida a la API
    http_response_code(200);
    echo json_encode(array(
        "mensaje" => "Bienvenido a la API REST de Productos",
        "version" => "1.0",
        "endpoints" => array(
            "GET" => "index.php?recurso=productos",
            "GET por ID" => "index.php?recurso=productos&id=1",
            "POST" => "index.php?recurso=productos",
            "PUT" => "index.php?recurso=productos"
        )
    ));
}
?>