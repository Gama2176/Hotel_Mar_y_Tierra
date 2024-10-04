<?php
// si toca el boton se activa lo siguiente 
if(!empty($_POST["btnlogin"])){
    if (empty($_POST["correo"]) and empty($_POST["contraseña"])) { //para que no acepte campos vacios
        echo 'Los campos estan vacios';// mensaje de error
    } else {
        $correo=$_POST["correo"];
        $contraseña=$_POST["contraseña"];
        $sql=$conexion->query("SELECT * from usuarios where correo='$correo' and contraseña='$contraseña' ");//consulta
        if ($datos=$sql->fetch_object()){ //si esto se cumple me lleva al menu
            header("location:prueba.php");
        } else { //si me niega el acceso 
            echo 'Aceeso denegado';//aparece el siguiente mensaje 
        }   
    }   
}
?>
