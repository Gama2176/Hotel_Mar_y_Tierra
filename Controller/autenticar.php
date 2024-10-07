<?php
session_start();
include '../Model/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Consulta SQL para buscar al usuario por correo
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    
    // Preparar la consulta
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }
    
    // Vincular parámetros y ejecutar la consulta
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    
    // Obtener el resultado de la consulta
    $resultado = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($contrasena, $usuario['contrasena'])) {
            // Almacenar datos en sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            
            // Redirigir a otra página
            header("Location: ../bienvenido.php");
            exit();
        } else {
            // Mostrar alerta y redirigir al login
            echo "<script>
                    alert('Contraseña incorrecta, Verifica tus datos');
                    window.location.href = '../index.php';
                  </script>";
        }
    } else {
        // Mostrar alerta y redirigir al login
        echo "<script>
                alert('No se encontró el usuario. ¿Ya tienes una cuenta?');
                window.location.href = '../View/Pages/login.php';
              </script>";
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión al final
$conexion->close();
?>
