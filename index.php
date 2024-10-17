
<!DOCTYPE html>
<!-- Lenguaje de la Página -->
<html lang="es-MX">

<head>
  <!-- Etiquetas meta primordiales -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Disfruta de una experiencia inigualable en Hotel Mar y Tierra, el refugio ideal para tu estadía en la ciudad. Servicios de lujo y comodidad junto al mar.">
  <meta name="robots" content="index, follow">
  <meta name="keywords" content="Hotel Mar y Tierra, hotel de lujo, alojamiento, servicios hoteleros, mar, ciudad">
  <meta name="author" content="gamtz_">

  <!-- Redes sociales y Open Graph (para compartir en redes sociales) -->
  <meta property="og:title" content="Descanso y Aventura en Armonía">
  <meta property="og:description"
    content="El lugar perfecto para disfrutar de una experiencia única con vistas al mar y servicios de primer nivel.">
  <meta property="og:image" content="https://pagina.com/imagenes/hotel.jpg">
  <meta property="og:url" content="https://pagina.com">
  <meta property="og:type" content="website">

  <!-- SEO Técnico -->
  <meta name="theme-color" content="#EB8242">
  <meta name="robots" content="index, follow">

  <!-- Título de la página -->
  <title>Hotel Mar y Tierra</title>

  <!-- Icono de la página -->
  <link rel="icon" href="View/Icons/bed.png" type="image/png">

  <!--Estilos Css -->
  <link rel="stylesheet" href="View/Css/index.css">

  <!-- Estilos Css de Bootstrap -->
  <link rel="stylesheet" href="View/Bootstrap/css/bootstrap.min.css">

  <!-- Scripts (JS) de Bootstrap -->
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
  <!-- Imagen de Fondo -->
   <div class="img-fondo">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-secondary">
      <div class="container-fluid">
        <!-- Logo a la izquierda -->
        <a class="navbar-brand" href="#"><img src="./View/Images/Logo.png" width="120px" height="45px" alt="Logo"></a>

        <!-- Botón para el menú en dispositivos móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido del Navbar -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
          <!-- Secciones en el centro -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Detalles</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">¿Quiénes Somos?</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Habitaciones</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contacto</a>
            </li>
          </ul>
        </div>

        <!-- Botón de Iniciar Sesión a la derecha -->
        <div class="d-flex">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
            Iniciar Sesión
          </button>
        </div>
      </div>
    </nav>

    <!-- Modal para iniciar sesión -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Formulario de Iniciar Sesión -->
            <h1>Iniciar Sesión</h1>
            <form action="./Controller/autenticar.php" method="POST">
              <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" class="form-control" name="correo" required>
              </div>

              <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="contrasena" required>
              </div>

              <div class="d-grid gap-2">
                <input type="submit" class="btn btn-primary" value="Iniciar Sesión">
              </div>

              <div class="mt-3">
                <a href="View/Pages/login.php">¿No tienes una cuenta? Regístrate</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

    
</body>

</html>