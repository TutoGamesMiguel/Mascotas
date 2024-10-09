<?php
session_start();
require('./api/db.php');

$conexion = Conectarse();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $usuarioReg = $_POST['usuario'];
    $contrasenaReg = $_POST['contrasena'];


    $query = "INSERT INTO  clientes(usuario, contrasena)
            VALUES ('$usuarioReg', '$contrasenaReg')";

    $ejecutar = mysqli_query ($conexion, $query);

    
    if ($ejecutar){
        echo '
            <script>
                alert("Usuario almacenado exitosamente");
                window.location = "index.html";
                exit();
            </script>    
        ';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            margin: 0; 
            background-color: #A0DEFF;
        }
</style>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class='flex flex-col text-black mt-2'>
        <center><p><b>Registrarse</b></p></center>
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required>
        </div>

        <div class='flex flex-col text-black mt-2'>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>
        </div>
        <button class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"  > Registrar </button>
        <?php if (!empty($datosIncorrectos)) : ?>
            <div style="color: red;"><?php echo $datosIncorrectos; ?></div>
        <?php endif; ?>
    </form>
</body>
</html>
