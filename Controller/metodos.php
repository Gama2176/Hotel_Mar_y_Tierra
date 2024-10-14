<?php
require_once __DIR__ . '/../Model/bdApi.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

/**
 * Clase Usuarios - Contiene métodos para registrar, autenticar, actualizar y eliminar usuarios en la base de datos.
 * Clse Productos - Contiene metodos para obtener, buscar, agregar, editar y eliminar productos en la base de datos.
 * Clase Carrito - Contiene métodos p
 * ara agregar y actualizar productos en el carrito de compras.
 * Clase Compras - Contiene métodos para insertar compras y detalles de compra en la base de datos.
 *

 */


//CLASE PRODUCTOS
class Productos{
    private $db;

    public function __construct()
    {
        $this->db= new DB();
    }


    /**
     * Agrega un producto a la base de datos.
     *
     * @param string $nombre Nombre del producto.
     * @param string $descripcion Descripción del producto.
     * @param int $precio Precio del producto.
     * @param string $image Ruta de la imagen del producto.
     * @param string $stock Cantidad de stock del producto.
     * @param int $activo (opcional) Indica si el producto está activo o no. Por defecto es 1 (activo).
     * 
     * @return bool Devuelve true si la inserción fue exitosa, false en caso contrario.
     */
    public function agregarProducto($nombre_habitacion, $descripcion, $precio_por_noche, $image, $estado, $capacidad, $tipo_habitacion) {
        try {
            $pdo = $this->db->connect();

            $sql = "INSERT INTO habitaciones (nombre_habitacion, descripcion, precio_por_noche, estado, imagen, capacidad, tipo_habitacion) VALUES (:nombre_habitacion, :descripcion, :precio_por_noche, :estado, :image, :capacidad, :tipo_habitacion)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nombre_habitacion', $nombre_habitacion);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio_por_noche', $precio_por_noche);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':capacidad', $capacidad);
            $stmt->bindParam(':tipo_habitacion', $tipo_habitacion);


            // Ejecutamos la consulta
            $stmt->execute();
            // Cerramos la conexión
            $pdo = null;
            // Devolvemos true para indicar que la inserción fue exitosa
            return true;
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            // Devolvemos false para indicar que hubo un error
            return false;
        }
    }


    /**
     * Obtiene todos los productos activos de la base de datos.
     *
     * @return array|false Un arreglo de productos si la consulta es exitosa, o false si hay un error.
     */
    public function obtenerProductos() {
        try {
            $pdo = $this->db->connect();

            $sql = "SELECT id, nombre_habitacion, descripcion, imagen, precio_por_noche, estado,capacidad,tipo_habitacion FROM habitaciones";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            // Inicializa un arreglo para almacenar los productos
            $productos = array();

            // Recorre los resultados y agrega cada producto al arreglo
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = array(
                    'id' => $row['id'],
                    'nombre_habitacion' => $row['nombre_habitacion'],
                    'descripcion' => $row['descripcion'],
                    'imagen' => $row['imagen'],
                    'precio_por_noche' => $row['precio_por_noche'],
                    'estado' => $row['estado'],
                    'capacidad' => $row['capacidad'],
                    'tipo_habitacion' => $row['tipo_habitacion'],
                );
            }

            // Cierra la conexión
            $pdo = null;

            return $productos; // Devuelve un arreglo de productos

        } catch (PDOException $e) {
            return false; // Manejo de error en la obtención de productos
        }
    }

    public function editarProducto($id, $nombre, $descripcion, $precio, $estado, $imagen, $capacidad, $tipo) {
        try {
            $pdo = $this->db->connect();
    
            if ($imagen != "") {
                $sql = "UPDATE habitaciones SET 
                            nombre_habitacion = :nombre_habitacion, 
                            descripcion = :descripcion, 
                            precio_por_noche = :precio_por_noche, 
                            estado = :estado, 
                            imagen = :imagen, 
                            capacidad = :capacidad, 
                            tipo_habitacion = :tipo_habitacion 
                        WHERE id = :id";
            } else {
                $sql = "UPDATE habitaciones SET 
                            nombre_habitacion = :nombre_habitacion, 
                            descripcion = :descripcion, 
                            precio_por_noche = :precio_por_noche, 
                            estado = :estado, 
                            capacidad = :capacidad, 
                            tipo_habitacion = :tipo_habitacion 
                        WHERE id = :id";
            }
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre_habitacion', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio_por_noche', $precio); // Asegurado que coincide con la consulta SQL
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':capacidad', $capacidad);
            $stmt->bindParam(':tipo_habitacion', $tipo);
    
            if ($imagen != "") {
                $stmt->bindParam(':imagen', $imagen);
            }
    
            // Ejecutar la consulta
            if ($stmt->execute()) {
                return true;
            } else {
                // Puedes obtener información adicional sobre el error
                $errorInfo = $stmt->errorInfo();
                echo "Error en la ejecución de la consulta: " . $errorInfo[2];
                return false;
            }
    
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            // Devolvemos false para indicar que hubo un error
            return false;
        }
    }
    

    /**
     * Elimina un producto de la base de datos.
     *
     * @param int $idProducto El id del producto a eliminar.
     * @return bool Devuelve true si la eliminación fue exitosa, false si no se eliminó ningún producto o hubo un error.
     */
    public function eliminarProducto($id) {
        try {
            $pdo = $this->db->connect();

            $sql = "DELETE FROM habitaciones WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);

            // Ejecutamos la consulta
            $stmt->execute();

            // Verificamos si se eliminó algún producto
            if ($stmt->rowCount() > 0) {
                // Cerramos la conexión
                $pdo = null;
                // Devolvemos true para indicar que la eliminación fue exitosa
                return true;
            } else {
                // Cerramos la conexión
                $pdo = null;
                // Devolvemos false para indicar que no se eliminó ningún producto
                return false;
            }
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            // Devolvemos false para indicar que hubo un error
            return false;
        }
    }

}

class Reservaciones{
    private $db;

    public function __construct()
    {
        $this->db= new DB();
    }

    /**
     * Agrega un producto a la base de datos.
     *
     * @param string $nombre Nombre del producto.
     * @param string $descripcion Descripción del producto.
     * @param int $precio Precio del producto.
     * @param string $image Ruta de la imagen del producto.
     * @param string $stock Cantidad de stock del producto.
     * @param int $activo (opcional) Indica si el producto está activo o no. Por defecto es 1 (activo).
     * 
     * @return bool Devuelve true si la inserción fue exitosa, false en caso contrario.
     */
    public function agregarReservacion($usuarioId, $idHabitacion, $fechaEntrada, $fechaSalida, $codigoReserva, $precioTotal, $estado) {
        try {
            $pdo = $this->db->connect();

            $sql = "INSERT INTO reservas (codigo_reserva , id_usuario , id_habitacion , fecha_entrada, fecha_salida, precio_total, estado) VALUES (:codigo_reserva , :id_usuario , :id_habitacion , :fecha_entrada, :fecha_salida, :precio_total, :estado)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codigo_reserva', $codigoReserva);
            $stmt->bindParam(':id_usuario', $usuarioId);
            $stmt->bindParam(':id_habitacion', $idHabitacion);
            $stmt->bindParam(':fecha_entrada', $fechaEntrada);
            $stmt->bindParam(':fecha_salida', $fechaSalida);
            $stmt->bindParam(':precio_total', $precioTotal);
            $stmt->bindParam(':estado', $estado);


            // Ejecutamos la consulta
            $stmt->execute();
            // Cerramos la conexión
            $pdo = null;
            // Devolvemos true para indicar que la inserción fue exitosa
            return true;
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            // Devolvemos false para indicar que hubo un error
            return false;
        }
    }



}

?>