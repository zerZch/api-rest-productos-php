<?php
/**
 * Modelo Producto - Representa la entidad Producto
 * Contiene las operaciones CRUD
 */
class Producto {
    // Conexión a la base de datos
    private $conn;
    private $table_name = "productos";

    // Propiedades del producto
    public $id;
    public $codigo;
    public $producto;
    public $precio;
    public $cantidad;
    public $fecha_creacion;
    public $fecha_actualizacion;

    /**
     * Constructor - recibe la conexión a la base de datos
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Crear un nuevo producto (POST)
     * @return bool True si se creó correctamente, False en caso contrario
     */
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . "
                  (codigo, producto, precio, cantidad)
                  VALUES
                  (:codigo, :producto, :precio, :cantidad)";

        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->codigo = htmlspecialchars(strip_tags($this->codigo));
        $this->producto = htmlspecialchars(strip_tags($this->producto));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));

        // Vincular los valores
        $stmt->bindParam(":codigo", $this->codigo);
        $stmt->bindParam(":producto", $this->producto);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":cantidad", $this->cantidad);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Leer todos los productos (GET)
     * @return PDOStatement Resultado de la consulta
     */
    public function leer() {
        $query = "SELECT 
                    id, codigo, producto, precio, cantidad, 
                    fecha_creacion, fecha_actualizacion
                  FROM " . $this->table_name . "
                  ORDER BY id ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    /**
     * Leer un solo producto por ID (GET)
     * @return void
     */
    public function leerUno() {
        $query = "SELECT 
                    id, codigo, producto, precio, cantidad,
                    fecha_creacion, fecha_actualizacion
                  FROM " . $this->table_name . "
                  WHERE id = :id
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->codigo = $row['codigo'];
            $this->producto = $row['producto'];
            $this->precio = $row['precio'];
            $this->cantidad = $row['cantidad'];
            $this->fecha_creacion = $row['fecha_creacion'];
            $this->fecha_actualizacion = $row['fecha_actualizacion'];
        }
    }

    /**
     * Actualizar un producto (PUT)
     * @return bool True si se actualizó correctamente, False en caso contrario
     */
    public function actualizar() {
        $query = "UPDATE " . $this->table_name . "
                  SET
                    codigo = :codigo,
                    producto = :producto,
                    precio = :precio,
                    cantidad = :cantidad
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->codigo = htmlspecialchars(strip_tags($this->codigo));
        $this->producto = htmlspecialchars(strip_tags($this->producto));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Vincular los valores
        $stmt->bindParam(":codigo", $this->codigo);
        $stmt->bindParam(":producto", $this->producto);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>