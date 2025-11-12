<?php
/**
 * Clase Database - Maneja la conexión a la base de datos
 * Patrón Singleton para una única instancia de conexión
 */
class Database {
    // Configuración de la base de datos
    private $host = "localhost";
    private $db_name = "api_productos";
    private $username = "root";
    private $password = ""; // En WampServer por defecto está vacío
    private $conn;

    /**
     * Obtiene la conexión a la base de datos
     * @return PDO|null Objeto de conexión o null en caso de error
     */
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            
            // Configurar el conjunto de caracteres a UTF-8
            $this->conn->exec("set names utf8mb4");
            
            // Configurar el modo de error de PDO a excepción
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>