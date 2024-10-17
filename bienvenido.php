<?php
// Iniciar sesión
session_start();
if (!isset($_SESSION['usuario_id'])) {
    // Redirigir si no está autenticado
    header("Location: ../View/Pages/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es-MX">

<head>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Metadatos SEO y Open Graph -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Disfruta de una experiencia inigualable en Hotel Mar y Tierra, el refugio ideal para tu estadía en la ciudad. Servicios de lujo y comodidad junto al mar.">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="Hotel Mar y Tierra, hotel de lujo, alojamiento, servicios hoteleros, mar, ciudad">
    <meta name="author" content="gamtz_">
    <meta property="og:title" content="Descanso y Aventura en Armonía">
    <meta property="og:description"
        content="El lugar perfecto para disfrutar de una experiencia única con vistas al mar y servicios de primer nivel.">
    <meta property="og:image" content="https://pagina.com/imagenes/hotel.jpg">
    <meta property="og:url" content="https://pagina.com">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#EB8242">
    <meta name="robots" content="index, follow">

    <title>Hotel Mar y Tierra</title>
    <link rel="icon" href="View/Icons/bed.png" type="image/png">
    <link rel="stylesheet" href="View/Css/index.css">
    <link rel="stylesheet" href="View/Bootstrap/css/bootstrap.min.css">
    <script src="View/Bootstrap/js/bootstrap.min.js"></script>
    <script src="View/Bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Datos estructurados en JSON-LD para fragmentos enriquecidos -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Hotel",
        "name": "Hotel Mar y Tierra",
        "description": "El refugio perfecto en la ciudad para quienes buscan lujo y comodidad junto al mar.",
        "image": "https://tupagina.com/imagenes/hotel.jpg",
        "url": "https://tupagina.com",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Av. Principal 123",
            "addressLocality": "Tuxtla Gutierrez",
            "addressRegion": "Chiapas",
            "postalCode": "29000",
            "addressCountry": "MX"
        },
        "sameAs": [
            "https://www.facebook.com/hotelmarytierra",
            "https://www.instagram.com/hotelmarytierra"
        ]
    }
    </script>
</head>

<body>
    <!-- Contenido principal -->
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>!</h1>
    <p>Estamos encantados de tenerte aquí.</p>

    <!-- Enlaces de navegación -->
    <a href="index.php">Volver a la página principal</a>
    <br>
    <a href="Controller/logout.php">Cerrar sesión</a>


    <div class="form-container">
    <div class="forms">
      <form action="./Controller/agregarhbt.php" method="POST" enctype="multipart/form-data" class="form">
        <h3 class="form-title">Agregar Habitacion</h3>
        <label for="nombre" class="form-label">Nombre de la habiatación:</label>
        <input type="text" id="nombre" name="nombre_habitacion" class="form-input" required>

        <label for="descripcion" class="form-label">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" class="form-input" required>

        <label for="precio" class="form-label">Precio por noche:</label>
        <input type="number" id="precio" name="precio_por_noche" class="form-input" required>

        <label for="estado" class="form-label">Estado:</label>
        <select id="estado" name="estado" class="form-input" required>
            <option value="disponible">Disponible</option>
            <option value="ocupado">Ocupado</option>
            <option value="mantenimiento">Mantenimiento</option>
        </select>

        <label for="image" class="form-label">Imagen:</label>
        <input type="file" id="image" name="imagen" class="form-input" required>

        <label for="capacidad" class="form-label">Capacidad:</label>
        <input type="number" id="capacidad" name="capacidad" class="form-input" required>

        <label for="tipo_habitacion" class="form-label">Tipo de habitación:</label>
        <select id="tipo_habitacion" name="tipo_habitacion" class="form-input" required>
            <option value="standard">Standard</option>
            <option value="suite">Suite</option>
            <option value="deluxe">Deluxe</option>
        </select>

        <input type="submit" value="Agregar Habitacion" class="form-submit">
      </form>
    </div>
  </div>







    <div class="lista-productos" id="productos-container">
    <!-- Aquí se mostrarán los productos dinámicamente -->
    <?php
        // Incluye el archivo metodos.php
        include_once './Controller/metodos.php';
        // Crea una instancia de la clase Productos
        $producto = new Productos();
        // Obtiene los productos desde la base de datos
        $productos = $producto->obtenerProductos();
        // Ahora puedes usar $productos en un bucle foreach
        foreach ($productos as $reg) {
            // Verificar si el producto ya está en el carrito
            $productoEnCarrito = false;
            
            echo '<div class="inner-card">';
            echo '<h2 class="product-description">' . $reg['nombre_habitacion'] . '</h2>';
            echo '<img src="../Hotel_Mar_y_Tierra/View/Images/habitaciones/' . $reg['imagen'] . '" alt="Producto Photo" class="product-image">';
            echo '<p class="product-description2">' . $reg['descripcion'] . '</p>';
            echo '<p class="product-price">$' . $reg['precio_por_noche'] . ' MXN</p>';
            echo '<p class="product-personas">' . $reg['capacidad'] . ' Personas</p>';


            // Agregamos un formulario que redirige al formulario de reservaciones
            echo '<form method="post" action="./menuReservas.php">';
            echo '<input type="hidden" name="idhabitacion" value="' . $reg['id'] . '">';
            echo '<input type="hidden" name="idusuario" value="' . $_SESSION['usuario_id'] . '">';
            echo '<input type="submit" name="hacerReserva" value="Reservar" class="button">';
            echo '</form>';

            echo '</div>';

            /*echo '<form method="post" action="../../Controller/agregarAlCarrito.php">';
            echo '<input type="hidden" name="idhabitacion" value="' . $reg['id'] . '">';
            echo '<input type="hidden" name="idusuario" value="' . $_SESSION['usuario_id'] . '">';
            echo '<input type="submit" name="hacerReserva" value="" class="button">';
            echo '</form>';
            echo '<input type="hidden" name="id" value="' . $reg['id'] . '">';
            echo '<input type="submit" name="agregarAlCarrito" value="" class="button">';
            echo '</div>';*/
        }
        ?>
    </div>


    <div id="editarProducto" style="display: none;" enctype="multipart/form-data" class="edit_producto">
        <form id="formEditarProducto" action="../Hotel_Mar_y_Tierra/Controller/editarhbt.php" method="post" class="form">
        <h3 class="form-title">Editar Producto</h3>
        <input type="hidden" id="editarId" name="id">

        <label for="editarNombre" class="form-label">Nombre de la habitación:</label>
        <input type="text" id="editarNombre" name="nombre" class="form-input" required>

        <label for="editarDescripcion" class="form-label">Descripción:</label>
        <input type="text" id="editarDescripcion" name="descripcion" class="form-input" required>

        <label for="editarPrecio" class="form-label">Precio por noche:</label>
        <input type="number" id="editarPrecio" name="precio" class="form-input" required>

        <label for="editarEstado" class="form-label">Estado:</label>
        <select id="editarEstado" name="estado" class="form-input" required>
            <option value="reservada">Reservada</option>
            <option value="disponible">Disponible</option>
            <option value="mantenimiento">Mantenimiento</option>
        </select>

        <label for="editarImage" class="form-label">Imagen:</label>
        <input type="file" id="editarImage" name="imagen" class="form-input">

        <label for="editarStock" class="form-label">Capacidad</label>
        <input type="number" id="editarStock" name="capacidad" class="form-input" required>

        <label for="editarTipo" class="form-label">Tipo de habitación:</label>
        <select id="editarTipo" name="tipo" class="form-input" required>
            <option value="standard">Standard</option>
            <option value="suite">Suite</option>
            <option value="deluxe">Deluxe</option>
        </select>


        <input type="submit" value="Editar Producto" class="form-submit">
    </form>

    </div>
 
    


    <?php
        require_once('../Hotel_Mar_y_Tierra/Controller/metodos.php');
        $metodos = new Productos();
        $productos = $metodos->obtenerProductos();
    ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Imagen</th>
            <th>Capacidad</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?php echo $producto['id']; ?></td>
            <td><?php echo $producto['nombre_habitacion']; ?></td>
            <td><?php echo $producto['descripcion']; ?></td>
            <td><?php echo $producto['precio_por_noche']; ?></td>
            <td><?php echo $producto['estado']; ?></td>
            <td><img width="60" src="../Hotel_Mar_y_Tierra/View/Images/habitaciones/<? echo $producto['imagen']; ?>"
                    alt="<?php echo $producto['imagen']; ?>"></td>
            <td><?php echo $producto['capacidad']; ?></td>
            <td><?php echo $producto['tipo_habitacion']; ?></td>
            <td>
                <a href="#"
                onclick='editarProducto("<?php echo $producto['id']; ?>", "<?php echo addslashes($producto['nombre_habitacion']); ?>",
                "<?php echo addslashes($producto['descripcion']); ?>", "<?php echo $producto['precio_por_noche']; ?>", "<?php echo $producto['estado']; ?>", "<?php echo addslashes($producto['imagen']); ?>", "<?php echo $producto['capacidad']; ?>", "<?php echo $producto['tipo_habitacion']; ?>")'>Editar</a>

                |
                <a href="#" onclick='confirmarEliminar("<?php echo $producto['id']; ?>")'>Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>







    <div class="lista-reservas" id="reservas-container">
    <!-- Aquí se mostrarán las reservas dinámicamente -->
     <h1>Historial de Reservas</h1>
    <?php
        // Incluye el archivo metodos.php
        include_once './Controller/metodos.php';
        // Crea una instancia de la clase Productos
        $reservas = new Reservaciones();
        // Obtiene los productos desde la base de datos
        $reservas = $reservas->obtenerReservas();
        // Ahora puedes usar $productos en un bucle foreach
        foreach ($reservas as $reg) {
            // Verificar si el producto ya está en el carrito
            
            
            //echo '<div class="inner-card">';
            echo '<p class="product-description">' . $reg['nombre_habitacion'] . '</p>';
            echo '<p class="product-description">' . $reg['id'] . '</p>';
            echo '<p class="product-description">' . $reg['estado_reserva'] . '</p>';
            echo '<p class="product-description">' . $reg['fecha_entrada'] . '</p>';
            echo '<p class="product-description2">' . $reg['fecha_salida'] . '</p>';
            echo '<p class="product-description2">' . $reg['capacidad'] . ' Personas</p>';
            echo '<p class="product-price">$' . $reg['precio_total'] . ' MXN</p>';


            //Agregamos un formulario que redirige al formulario de reservaciones
            echo '<form method="post" action="./historialReservas.php">';
            echo '<input type="hidden" name="idreserva" value="' . $reg['id'] . '">';
            echo '<input type="hidden" name="idusuario" value="' . $_SESSION['usuario_id'] . '">';
            echo '<input type="submit" name="hacerReserva" value="Ver detalles" class="button">';
            echo '</form>';

            echo '</div>'; 
        }
        ?>
    </div>


    <script>
        function editarProducto(id, nombre_habitacion, descripcion, precio_por_noche, estado, imagen, capacidad, tipo_habitacion) {
            // Mostrar el formulario
            document.getElementById('editarProducto').style.display = 'block';
            
            // Asignar los valores recibidos a los campos del formulario
            document.getElementById('editarId').value = id;
            document.getElementById('editarNombre').value = nombre_habitacion; // Nombre correcto de la variable
            document.getElementById('editarDescripcion').value = descripcion;
            document.getElementById('editarPrecio').value = precio_por_noche;
            document.getElementById('editarStock').value = capacidad;
            
            // Estado de la habitación
            document.getElementById('editarEstado').value = estado;

            // No es posible asignar el valor del archivo a un campo de tipo file
            // El valor de imagen solo puede ser manipulado al seleccionar un archivo nuevo.
            // Si deseas mostrar la imagen actual, deberías hacerlo con una previsualización, no asignándola al campo de archivo.
            
            // Tipo de habitación
            document.getElementById('editarTipo').value = tipo_habitacion;
        }

    </script>

    <script>
        function confirmarEliminar(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../Hotel_Mar_y_Tierra/Controller/eliminarhbt.php?id=" + id;
                }
            })
        }
    </script>
    
</body>

</html>
