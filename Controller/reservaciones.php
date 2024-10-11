<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();

// Incluir el archivo de conexión
require_once '../Model/conexion.php';
require_once('../Controller/metodos.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos enviados desde el formulario
    $usuarioId = $_POST['idusuario'];
    $idHabitacion = $_POST['idhabitacion'];
    $fechaEntrada = $_POST['fecha_entrada'];
    $fechaSalida = $_POST['fecha_salida'];

    // Validar que la fecha de entrada sea menor a la fecha de salida
    if ($fechaEntrada <= $fechaSalida) {
        $codigoReserva = 'ReservaCode' . uniqid();  // Código de reserva único
        $estadoReserva = 'confirmada';
        
        // Verificar si la habitación está disponible
        $sql = "SELECT precio_por_noche, estado FROM habitaciones WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $idHabitacion);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $precio_por_noche = $row['precio_por_noche'];
            $estadoHabitacion = $row['estado']; // Obtener el estado de la habitación

            // Validar si la habitación está disponible
            if ($estadoHabitacion == 'disponible') {
                // Convertir las fechas a objetos DateTime
                $fecha_entrada_obj = new DateTime($fechaEntrada);
                $fecha_salida_obj = new DateTime($fechaSalida);

                // Calcular la diferencia en días
                $diferencia = $fecha_entrada_obj->diff($fecha_salida_obj);
                $noches = $diferencia->days;

                // Calcular el precio total
                $precioTotal = $precio_por_noche * $noches;

                // Guardar la reservación
                $metodos = new Reservaciones();
                $resultado = $metodos->agregarReservacion($usuarioId, $idHabitacion, $fechaEntrada, $fechaSalida, $codigoReserva, $precioTotal, $estadoReserva);

                if ($resultado) {
                    echo "Éxito al agregar la reservación.";
                } else {
                    echo "Hubo un error al agregar la reservación.";
                }
            } else {
                // Alerta si la habitación no está disponible
                echo "<script>alert('La habitación seleccionada no está disponible.'); window.history.back();</script>";
                exit();
            }
        } else {
            echo "Error: No se encontró la habitación especificada.";
        }
    } else {
        echo "<script>alert('La fecha de entrada debe ser anterior a la fecha de salida.'); window.history.back();</script>";
        exit();
    }
}
?>
