<?php
function Conectarse(){
    $servidor = 'localhost';
    $usuario = 'root';
    $password = '';
    $database = 'mascotasweb';

    $conexion = new mysqli($servidor, $usuario, $password, $database);
    if($conexion->connect_errno){
        echo "Error en la conexión: (" .$conexion->connect_errno. ")" .$conexion->connect_error;
    }
    return $conexion;
}
?>