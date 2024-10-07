<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../Model/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Encripta contraseña

    // Verificar si el correo o el teléfono ya están registrados
    $sql_verificacion = "SELECT correo, telefono FROM usuarios WHERE correo = ? OR telefono = ?";
    $stmt_verificacion = $conexion->prepare($sql_verificacion);
    $stmt_verificacion->bind_param("ss", $correo, $telefono);
    $stmt_verificacion->execute();
    $resultado_verificacion = $stmt_verificacion->get_result();

    if ($resultado_verificacion->num_rows > 0) {
        // Si el correo o el teléfono ya existen, mostrar un mensaje adecuado
        $usuario_existente = $resultado_verificacion->fetch_assoc();
        
        if ($usuario_existente['correo'] === $correo) {
            echo "<script>alert('El correo ya está registrado.'); window.location.href = '../View/Pages/login.php';</script>";
        } elseif ($usuario_existente['telefono'] === $telefono) {
            echo "<script>alert('El teléfono ya está registrado.'); window.location.href = '../View/Pages/login.php'</script>";
        }
    } else {
        // Si no hay duplicados, insertar los datos del nuevo usuario
        $sql = "INSERT INTO usuarios (nombre, apellido, correo, telefono, contrasena) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $apellido, $correo, $telefono, $contrasena);

        if ($stmt->execute()) {
            // Almacenar datos del usuario en la sesión
            $_SESSION['usuario_id'] = $conexion->insert_id; // Guardar el ID del nuevo usuario
            $_SESSION['usuario_nombre'] = $nombre; // Guardar el nombre del nuevo usuario

            // Mostrar alerta de registro exitoso y redirigir al login
            echo "<script>
                    alert('Registro exitoso. Puedes iniciar sesión ahora.');
                    window.location.href = '../index.php';
                  </script>";
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $stmt_verificacion->close();
}

$conexion->close();
?>
