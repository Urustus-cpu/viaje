<?php
include 'conexion.php';
session_set_cookie_params([
    'lifetime' => 1800,
    'path' => '/',
    'domain' => 'localhost', 
    'secure' => true, // solo enviar la cookie a través de HTTPS
    'httponly' => true, // 
    'samesite' => 'Strict' // prevenir ataques CSRF
]);
session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $nombre = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $pass = isset($_POST['contra']) ? $_POST['contra'] : '';

    if (trim($nombre) != "" && trim($pass) != "") {
        // Asegurarse de que las entradas del usuario estén limpias para prevenir SQL Injection
        $nombre = mysqli_real_escape_string($connecion, $nombre);
        $pass = mysqli_real_escape_string($connecion, $pass);

        // Verificar las credenciales del usuario
        $query = "SELECT * FROM cliente WHERE nombre = '$nombre' AND pass = '$pass'";
        $result = mysqli_query($connecion, $query);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['usuario'] = $nombre;
            header("Location: comercio.php"); 
            exit;
        } else {
            $error_message = "Usuario o contraseña incorrectos.";
        }
    }
    $connecion->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>viaje</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="cabeza">
        <h1>ViajesDespegar</h1>
        <div class="login">
            <form action="index.php" method="post">
                <label>Usuario: <input type="text" name="usuario"></label>
                <label>Contraseña: <input type="password" name="contra"></label>
                <button type="submit">Iniciar sesión</button>
                <?php if (isset($error_message)): ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>
            </form>
        </div>
    </header>
    <main class="container">


    </main>
    
</body>
</html>