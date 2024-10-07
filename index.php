
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
  
  <h1>Iniciar Sesión</h1>
    <form action="Controller/autenticar.php" method="POST">
        <label for="correo">Correo:</label>
        <input type="email" name="correo" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required><br>

        <input type="submit" value="Iniciar Sesión">
        <a href="View/Pages/login.php">¿No tienes una cuenta?, Regístrate</a>
    </form>
    
</body>

</html>