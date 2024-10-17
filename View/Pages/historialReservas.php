<h1>Historial de reservas</h1>

<?php
    // Habilita la visualización de errores para depuración (puedes desactivarlo en producción)
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Verifica que el formulario haya enviado los datos
    if (isset($_POST['idreserva']) && isset($_POST['idusuario'])) {
        // Recibir las variables del formulario anterior (hacerReserva)
        $idreserva = $_POST['idreserva'];
        $idusuario = $_POST['idusuario'];

        // Validar que $idreserva sea un número entero
        if (!filter_var($idreserva, FILTER_VALIDATE_INT)) {
            echo '<p>El ID de la reserva no es válido.</p>';
            exit;
        }

        // Incluye el archivo metodos.php
        include_once './Controller/metodos.php';

        // Crea una instancia de la clase Reservaciones
        $reservaciones = new Reservaciones();

        // Obtiene la reserva específica por ID
        $reserva = $reservaciones->obtenerReservasPorId($idreserva);

        if ($reserva) {
            // Mostrar los datos de la reserva
            echo '<p class="product-description"><strong>Detalles - Reserva #:</strong> ' . htmlspecialchars($reserva['id']) . '</p>';
            echo '<p class="product-description"><strong>Numero de confirmacion:</strong> ' . htmlspecialchars($reserva['codigo_reserva']) . '</p>';
            echo '<h4 class="product-description"><strong>Informacion General</strong></h4>';
            echo '<p class="product-description"><strong>Nombre Habitación:</strong> ' . htmlspecialchars($reserva['nombre_habitacion']) . '</p>';
            echo '<p class="product-description"><strong>Estado Reserva:</strong> ' . htmlspecialchars($reserva['estado_reserva']) . '</p>';
            echo '<p class="product-description"><strong>Fecha Entrada:</strong> ' . htmlspecialchars($reserva['fecha_entrada']) . '</p>';
            echo '<p class="product-description2"><strong>Fecha Salida:</strong> ' . htmlspecialchars($reserva['fecha_salida']) . '</p>';
            echo '<p class="product-description2"><strong>Capacidad:</strong> ' . htmlspecialchars($reserva['capacidad']) . ' Personas</p>';
            echo '<h4 class="product-description"><strong>Detalles Habitacion</strong></h4>';
            echo '<h4 class="product-description"><strong>Resumen de costos</strong></h4>';
            echo '<p class="product-price"><strong>Precio Total:</strong> $' . htmlspecialchars($reserva['precio_total']) . ' MXN</p>';
            echo '<h4 class="product-description"><strong>Información de Contacto del Hotel</strong></h4>';
            echo '<input type="submit" name="hacerReserva" value="Descargar Factura" class="button">';
            echo '<input type="submit" name="hacerReserva" value="Contactar al Hotel" class="button">';


        } else {
            echo '<p>No se encontró la reserva o ocurrió un error.</p>';
        }
    } else {
        echo '<p>Faltan datos del formulario.</p>';
    }
?>
