<?php
ob_start(); // Inicia el almacenamiento en búfer de salida
include("Model/conexion.php"); // Conectar con la base de datos

// Si se ha enviado el formulario para registrar un nuevo usuario
if (!empty($_POST["btnnuevousuario"])) {
    // Verificar si los campos están vacíos
    if (empty($_POST["nombre"]) || empty($_POST["apellidos"]) || empty($_POST["correo"]) || empty($_POST["contrasena"])) {
        echo '<script>alert("Todos los campos son obligatorios");</script>'; // Mensaje de error si los campos están vacíos
    } else {
        // Capturar los datos del formulario
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $correo = $_POST["correo"];
        $contrasena = $_POST["contrasena"];

        // Preparar consulta segura para verificar si el correo ya existe
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo); // Pasar el parámetro de forma segura
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // Si el correo ya existe
            echo '<script>alert("Este correo ya está registrado. Intenta iniciar sesión.");</script>'; // Mensaje de correo existente
        } else {
            // Si el correo no existe, proceder a registrar al nuevo usuario
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, correo, contrasena) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nombre, $apellidos, $correo, $contrasena); // Pasar los parámetros de forma segura

            if ($stmt->execute()) {
                // Si la inserción fue exitosa
                echo '<script>alert("Usuario registrado exitosamente");</script>'; // Mensaje de registro exitoso
                $_SESSION['usuario'] = $correo; // Guardar el correo del usuario en sesión
                $_SESSION['nombre'] = $nombre; // Guardar el nombre del usuario en sesión
                $_SESSION['apellidos'] = $apellidos; // Guardar los apellidos del usuario en sesión
                header("Location: prueba.php"); // Redirigir a otra página
                exit; // Asegura que no se ejecute más código después de la redirección
            } else {
                // En caso contrario muestra un mensaje de error
                echo '<script>alert("Error al registrar: ' . $conexion->error . '");</script>';
            }
        }
        
        $stmt->close(); // Cerrar la consulta preparada
    }
}

ob_end_flush(); // Envía el contenido del búfer de salida y apaga el búfer
?>

