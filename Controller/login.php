<?php
session_start(); // Iniciar sesión para manejar datos de usuario si es necesario

// Si se ha enviado el formulario
if (!empty($_POST["btnlogin"])) {
    // Verificar si los campos están vacíos
    if (empty($_POST["correo"]) || empty($_POST["contrasena"])) {
        echo ''; // mensaje de error si los campos están vacíos
    } else {
        // Capturar los datos del formulario
        $correo = $_POST["correo"];
        $contrasena = $_POST["contrasena"];
        
        // Preparar consulta segura para evitar inyecciones SQL
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ? AND contrasena = ?");
        $stmt->bind_param("ss", $correo, $contrasena); // Pasar los parámetros de forma segura
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // Si las credenciales son correctas
            $_SESSION['usuario'] = $correo; // O almacenar la información que necesites
            header("location: prueba.php"); // Redirigir a otra página
        } else {
            // Si las credenciales no son correctas
            echo '<script>alert("Acceso denegado");</script>'; // Mostrar un mensaje de acceso denegado
        }
        
        $stmt->close(); // Cerrar la consulta preparada
    }
}
?>
