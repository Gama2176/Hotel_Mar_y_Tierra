<?php

session_start();
require_once('../Controller/metodos.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $estado = $_POST["estado"];
    $capacidad = $_POST["capacidad"];
    $tipo = $_POST["tipo"];

    // Verificamos si se subió una imagen
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        // Validación básica (puedes expandirla según tus necesidades)
        $allowed = ["jpg" => "image/jpeg", "png" => "image/png", "gif" => "image/gif"];
        $filename = $_FILES["imagen"]["name"];
        $filetype = $_FILES["imagen"]["type"];
        $filesize = $_FILES["imagen"]["size"];

        // Verificar la extensión del archivo
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) {
            die("Error: Formato de imagen no válido.");
        }

        // Verificar el tipo MIME
        if (in_array($filetype, $allowed)) {
            // Verificar el tamaño del archivo (por ejemplo, máximo 5MB)
            if ($filesize > 5 * 1024 * 1024) {
                die("Error: El tamaño del archivo es demasiado grande.");
            }

            // Generar un nombre único para evitar sobrescribir archivos existentes
            $nombreImagen = uniqid() . "." . $ext;
            $rutaDestino = "../View/Images/" . $nombreImagen;

            if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaDestino)) {
                die("Error: No se pudo mover la imagen subida.");
            }
        } else {
            die("Error: Hay un problema con el tipo de archivo.");
        }
    } else {
        // Si no se subió una imagen, mantenemos el nombre de la imagen existente
        // Supongo que debes obtener el nombre de la imagen actual desde la base de datos
        // Por simplicidad, usaré una cadena vacía, pero deberías ajustarlo según tu lógica
        $nombreImagen = "";
    }

    $metodos = new Productos();
    $resultado = $metodos->editarProducto($id, $nombre, $descripcion, $precio, $estado, $nombreImagen, $capacidad, $tipo);

    if ($resultado) {
        echo "Éxito";
    } else {
        echo "Hubo un error al editar el producto.";
    }
}
?>
