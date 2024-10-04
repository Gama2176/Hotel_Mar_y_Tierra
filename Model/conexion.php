<?php

$server = "localhost";
$user = "root";
$pass = "";
$bd = "ejemplo";

$conexion = new mysqli($server, $user, $pass, $bd);

if ($conexion->connect_errno){
    die ("Conexion Fallida" . $conexion->connect_errno);
}else{
    echo "conectado";
}

?>