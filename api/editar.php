<?php
    require( 'db.php');
    $conexion = Conectarse();
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $query = "SELECT * FROM productos WHERE IdProd = :id";
        $result = $conexion->query($query);
        $productos = array();
        while ($row = $result->fetch_array()) {
            $producto = array(
                'id' => $row['IdProd'],
                'nombre' => $row['NomProd'],
                'precio' => $row['CostoProd'],
                'cantidad' => $row['CantProd']
            );
            array_push($productos, $producto);
        }
        echo json_encode($productos);
    }
?>

<?php
    require_once('db.php');
    $conexion = Conectarse();
    header('Content-Type: application/json');
    $input = json_decode(file_get_contents('php://input'), true);

    if(isset($input['id'], $input['nombre'], $input['precio'], $input['cantidad'])) {
        $query = $conexion->prepare("UPDATE productos SET NomProd = :nombre, CostoProd = :precio, CantProd = :cantidad WHERE id = :id");
        $result = $query->execute([
            'nombre' => $input['nombre'],
            'precio' => $input['precio'],
            'cantidad' => $input['cantidad'],
            'id' => $input['id']
        ]);

        echo json_encode(['success' => $result]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    }
?>