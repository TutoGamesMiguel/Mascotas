<?php
require_once('db.php');
$conexion = Conectarse();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre'];
    $raza = $_POST['raza'];
    $imagen = $_FILES['imagen'];

    if(empty($nombre) || empty($raza) || empty($imagen)){
        echo "Faltan datos";
        return;
    }


    $target_dir = "c:/xampp/htdocs/mascotasweb/imagenes/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
        echo "Carpeta creada: $target_dir<br>";
    }


    $target_file = $target_dir . time() . '_' . basename($imagen["name"]);
    if (!move_uploaded_file($imagen["tmp_name"], $target_file)) {
        echo "Error al subir la imagen";
        return;
    }


    $relative_path = 'imagenes/' . time() . '_' . basename($imagen["name"]);
    $query = "INSERT INTO mascotas (nomMascota, razaMascota, imagenMascota) VALUES ('$nombre', '$raza', '$relative_path')";

    if ($conexion->query($query) === TRUE) {
        echo "Mascota registrada";
    } else {
        echo "Error en la consulta SQL: " . $query . "<br>" . $conexion->error;
    }
} else {
    echo "Método no permitido";
}
?>