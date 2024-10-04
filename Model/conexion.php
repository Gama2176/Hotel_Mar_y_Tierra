<?php

$server = "localhost";
$user = "root";
$pass = "";
$bd = "hotel_mar_y_tierra";

$conexion = new mysqli($server, $user, $pass, $bd);

if ($conexion->connect_errno){
    die ("Conexion Fallida" . $conexion->connect_errno);
}else{
    echo "";
}

?>