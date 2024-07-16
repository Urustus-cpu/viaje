<?php
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
    // La sesión ha estado inactiva por más de 10 minutos
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}
$_SESSION['LAST_ACTIVITY'] = time(); // Actualizar la última actividad
?>