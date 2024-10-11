<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
/**
 * Agrega un producto a la base de datos.
 *
 * @param string $nombre Nombre del producto.
 * @param string $descripcion Descripción del producto.
 * @param int $precio Precio del producto.
 * @param string $image Ruta de la imagen del producto.
 * @param string $stock Cantidad de stock del producto.
 * @param int $activo (opcional) Indica si el producto está activo o no. Por defecto es 1 (activo).
 * @return bool Devuelve true si la inserción fue exitosa, false en caso contrario.
 *
 * @return bool Retorna true si el producto se agregó correctamente, de lo contrario retorna false.
 */
session_start();
require_once('../Controller/metodos.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_habitacion = $_POST['nombre_habitacion'];
    $descripcion = $_POST['descripcion'];
    $precio_por_noche = floatval($_POST['precio_por_noche']);
    $estado = $_POST['estado'];
    $capacidad = $_POST['capacidad'];
    $tipo_habitacion = $_POST['tipo_habitacion'];


    // Manejo de la carga de la imagen
    $nombreImagen = $_FILES['imagen']['name'];
    $rutaTemporal = $_FILES['imagen']['tmp_name'];
    $rutaDestino = "../View/images/habitaciones/" . $nombreImagen;
    if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
        $metodos = new Productos();
        $resultado = $metodos->agregarProducto($nombre_habitacion, $descripcion, $precio_por_noche, $nombreImagen, $estado, $capacidad, $tipo_habitacion);
    } else {

        echo "Hubo un error al cargar la imagen.";
    }

    if ($resultado) {
        echo "Exito.";
    } else {
        echo "Hubo un error al agregar el producto.";
    }
}

?>