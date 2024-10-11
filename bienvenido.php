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
        include './Controller/metodos.php';
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



    
</body>

</html>
