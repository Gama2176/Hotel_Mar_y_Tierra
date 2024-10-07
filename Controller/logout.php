<?php
// Inicia la sesión y destruye la sesión actual.
session_start();
session_destroy();

// Redirige al usuario a la página de login u otra página deseada
header("Location: ../index.php");
exit();
?>
