<?php
session_start();
require ('./api/db.php');
$conexion = Conectarse();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuarioForm = $_POST['usuario'];
    $contrasenaForm = $_POST['contrasena'];

    $usuarioEsperado = "admin";
    $contrasenaEsperada = "12345";

    if ($usuarioForm === $usuarioEsperado && $contrasenaForm === $contrasenaEsperada) {
        header("Location: insertar.html");
        exit();
    } else {
        $datosIncorrectos = "El usuario o la contraseña son incorrectos.";
    }

    
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuarioReg = $_POST ['usuario'];
    $contrasenaReg = $_POST ['contrasena'];

    $validar_login = mysqli_query($conexion, "SELECT * FROM clientes WHERE usuario = '$usuarioReg' AND contrasena = '$contrasenaReg'");

    if (mysqli_num_rows($validar_login) > 0){
        header ("Location: mascotas.html");
        exit();

    } else {
        echo '
            <script>
                alert("Usuario no existe, por favor verifique los datos introducidos");
                window.location = "login.php";
            </script>
        ';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class='flex flex-col text-black mt-2'>
        <center><p><b>Inicio de sesión</b></p></center>
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required>
        </div>

        <div class='flex flex-col text-black mt-2'>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>
        </div>
        <button class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"  > Enviar </button>
        <?php if (!empty($datosIncorrectos)) : ?>
            <div style="color: red;"><?php echo $datosIncorrectos; ?></div>
        <?php endif; ?>
    </form>
</body>
</html>