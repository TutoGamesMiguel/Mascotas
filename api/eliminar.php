<?php
    $data = file_get_contents("php://input");
    require "db.php";
    $conexion = Conectarse();
    $data = json_decode($data);
    $id = $data->id;
    $query = "DELETE FROM mascotas WHERE idMascota = $id";
    if ($conexion->query($query) === TRUE) {
        echo "Mascota eliminada";
    } else {
        echo "Error: " . $query . "<br>" . $conexion->error;
    }
?>