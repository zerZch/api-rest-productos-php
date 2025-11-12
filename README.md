# 🛍️ Sistema CRUD de Productos con Fetch API y MySQL

## 📝 Descripción
Sistema de gestión de productos desarrollado con PHP (POO), MySQL, JavaScript (Fetch API) y Bootstrap 5.
Proyecto para el curso de Ingeniería Web - Universidad Tecnológica.

## 🚀 Características
- ✅ Crear nuevos productos
- ✅ Editar productos existentes  
- ✅ Buscar productos por ID
- ✅ Listar todos los productos
- ✅ Validación de formularios
- ✅ Alertas con SweetAlert2
- ✅ Diseño responsive con Bootstrap 5

## 💻 Tecnologías Utilizadas
- **Backend:** PHP 7.4+ (POO)
- **Base de Datos:** MySQL
- **Frontend:** HTML5, JavaScript (ES6+), Bootstrap 5
- **AJAX:** Fetch API
- **Alertas:** SweetAlert2
- **Servidor:** WampServer

## 📦 Instalación

### Requisitos Previos
- WampServer o XAMPP instalado
- PHP 7.4 o superior
- MySQL 5.7 o superior

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/TU-USUARIO/crud-productos.git
```

2. **Configurar la base de datos**
```sql
CREATE DATABASE productosdb;
USE productosdb;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(20) NOT NULL,
    producto VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    cantidad INT NOT NULL
);
```

3. **Configurar la conexión**
   - Editar `Modelo/conexion.php` si es necesario
   - Ajustar credenciales de la base de datos

4. **Acceder al proyecto**
   - Abrir navegador
   - Ir a `http://localhost/crud-productos/`

## 📁 Estructura del Proyecto
```
crud-productos/
├── Modelo/
│   ├── conexion.php      # Clase de conexión a la BD
│   └── Productos.php      # Clase del modelo Producto
├── index.html             # Interfaz principal
├── registrar.php          # Controlador principal (switch)
├── script.js              # Lógica del frontend
├── .gitignore            # Archivos ignorados por Git
└── README.md             # Documentación
```

## 👨‍💻 Autor
- **Nombre:** [Tu Nombre]
- **Curso:** Ingeniería Web - ISF131/ISF132
- **Profesor:** Ing. Irina Fong
- **Fecha:** Noviembre 2025

## 📄 Licencia
Este proyecto es de uso educativo para la Universidad Tecnológica.
```