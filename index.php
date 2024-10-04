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


<?php
  include("Model/conexion.php");
  include("Controller/login.php");
?>

<!-- lectura de los datos a ingresar -->
<form action="" method="post">
<label class="login-datos" for="correo">Correo:</label>
<div class="input-icon">
  <input type="text" id="usuario" name="correo" required>
  <i class="fa-solid fa-envelope"></i>
</div><br><br>

<label class="login-datos" for="contrasena">Contraseña:</label>
<div class="input-icon1">
  <input type="password" id="contrasena" name="contrasena" required><br><br>
  <i class="fa-solid fa-lock"></i>
</div>

<div class="boton">
  <input class="input-login" name="btnlogin" type="submit" value="Iniciar sesión">
</div>
</form>

<!-- opcion para que se registre -->
<p class="redirigir">¿Eres nuevo? <a href="registro.php">Regístrate</a><i class="fa-solid fa-arrow-right"></i></p>
  


<?php
  include("Model/conexion.php");
  include("Controller/nuevo_usuario.php");
?>

<!-- lectura de los datos a ingresar -->
<form action="" method="post">
  <!-- Campo para el nombre -->
  <label class="login-datos" for="nombre">Nombre:</label>
  <div class="input-icon">
    <input type="text" id="nombre" name="nombre" required>
    <i class="fa-solid fa-user"></i>
  </div><br><br>

  <!-- Campo para los apellidos -->
  <label class="login-datos" for="apellidos">Apellidos:</label>
  <div class="input-icon">
    <input type="text" id="apellidos" name="apellidos" required>
    <i class="fa-solid fa-user"></i>
  </div><br><br>

  <!-- Campo para el correo -->
  <label class="login-datos" for="correo">Correo:</label>
  <div class="input-icon">
    <input type="email" id="correo" name="correo" required>
    <i class="fa-solid fa-envelope"></i>
  </div><br><br>

  <!-- Campo para la contraseña -->
  <label class="login-datos" for="contrasena">Contraseña:</label>
  <div class="input-icon1">
    <input type="password" id="contrasena" name="contrasena" required><br><br>
    <i class="fa-solid fa-lock"></i>
  </div>

  <!-- Botón para enviar el formulario -->
  <div class="boton">
    <input class="input-login" name="btnnuevousuario" type="submit" value="Iniciar sesión">
  </div>
</form>

<!-- Opción para que se registre -->
<p class="redirigir">¿Ya tienes una cuenta? <a href="registro.php">Iniciar Sesion</a><i class="fa-solid fa-arrow-right"></i></p>

</head>

<body>

</body>

</html>