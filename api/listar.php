<?php
    require('db.php');
    $conexion = Conectarse();
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $query = "SELECT * FROM mascotas";
        $result = $conexion->query($query);
        $mascotas = array(); 
        while ($row = $result->fetch_array()) {
            $mascota = array( 
                'id' => $row['idMascota'],
                'nombre' => $row['nomMascota'],
                'raza' => $row['razaMascota'],
                'imagen' => $row['imagenMascota']
            );
            array_push($mascotas, $mascota); 
        }
        echo json_encode($mascotas);
    }
?>