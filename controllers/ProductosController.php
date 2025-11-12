<?php
/**
 * Controlador de Productos
 * Maneja las peticiones HTTP para el recurso productos
 */

// Headers requeridos
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Incluir archivos necesarios
include_once '../config/Database.php';
include_once '../models/Producto.php';

// Instanciar la base de datos y el producto
$database = new Database();
$db = $database->getConnection();
$producto = new Producto($db);

// Obtener el método HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Centralización con switch según el método HTTP
switch($method) {
    
    case 'GET':
        /**
         * 🛠 ACTIVIDAD 1: Método GET implementado
         * Lista todos los productos o uno específico por ID
         */
        
        // Verificar si se solicita un producto específico por ID
        if(isset($_GET['id'])) {
            $producto->id = $_GET['id'];
            $producto->leerUno();

            if($producto->codigo != null) {
                // Crear array del producto
                $producto_arr = array(
                    "id" => $producto->id,
                    "codigo" => $producto->codigo,
                    "producto" => $producto->producto,
                    "precio" => $producto->precio,
                    "cantidad" => $producto->cantidad,
                    "fecha_creacion" => $producto->fecha_creacion,
                    "fecha_actualizacion" => $producto->fecha_actualizacion
                );

                http_response_code(200);
                echo json_encode($producto_arr);
            } else {
                http_response_code(404);
                echo json_encode(array("mensaje" => "Producto no encontrado."));
            }
        } else {
            // Listar todos los productos
            $stmt = $producto->leer();
            $num = $stmt->rowCount();

            if($num > 0) {
                $productos_arr = array();
                $productos_arr["registros"] = array();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);

                    $producto_item = array(
                        "id" => $id,
                        "codigo" => $codigo,
                        "producto" => $producto,
                        "precio" => $precio,
                        "cantidad" => $cantidad,
                        "fecha_creacion" => $fecha_creacion,
                        "fecha_actualizacion" => $fecha_actualizacion
                    );

                    array_push($productos_arr["registros"], $producto_item);
                }

                http_response_code(200);
                echo json_encode($productos_arr);
            } else {
                http_response_code(404);
                echo json_encode(array("mensaje" => "No se encontraron productos."));
            }
        }
        break;

    case 'POST':
        /**
         * Método POST - Crear un nuevo producto
         */
        
        // Obtener datos enviados
        $data = json_decode(file_get_contents("php://input"));

        // Verificar que los datos no estén vacíos
        if(!empty($data->codigo) && !empty($data->producto) && !empty($data->precio) && !empty($data->cantidad)) {
            
            // Asignar valores al producto
            $producto->codigo = $data->codigo;
            $producto->producto = $data->producto;
            $producto->precio = $data->precio;
            $producto->cantidad = $data->cantidad;

            // Crear el producto
            if($producto->crear()) {
                http_response_code(201);
                echo json_encode(array("mensaje" => "Producto creado exitosamente."));
            } else {
                http_response_code(503);
                echo json_encode(array("mensaje" => "No se pudo crear el producto."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("mensaje" => "Datos incompletos. No se puede crear el producto."));
        }
        break;

    case 'PUT':
        /**
         * 🛠 ACTIVIDAD 2: Método PUT implementado
         * Actualiza un producto existente por ID
         */
        
        // Obtener datos enviados
        $data = json_decode(file_get_contents("php://input"));

        // Verificar que el ID y los datos no estén vacíos
        if(!empty($data->id) && !empty($data->codigo) && !empty($data->producto) && !empty($data->precio) && !empty($data->cantidad)) {
            
            // Asignar valores al producto
            $producto->id = $data->id;
            $producto->codigo = $data->codigo;
            $producto->producto = $data->producto;
            $producto->precio = $data->precio;
            $producto->cantidad = $data->cantidad;

            // Actualizar el producto
            if($producto->actualizar()) {
                http_response_code(200);
                echo json_encode(array("mensaje" => "Producto actualizado exitosamente."));
            } else {
                http_response_code(503);
                echo json_encode(array("mensaje" => "No se pudo actualizar el producto."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("mensaje" => "Datos incompletos. No se puede actualizar el producto."));
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(array("mensaje" => "Método no permitido."));
        break;
}
?>