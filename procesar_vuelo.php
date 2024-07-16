<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_vuelo = $_POST['id_vuelo'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $fecha = $_POST['fecha'];
    $plazas_disponibles = $_POST['plazas_disponibles'];
    $precio = $_POST['precio'];

    $sql = "INSERT INTO VUELO (id_vuelo, origen, destino, fecha, plaza_disponible, precio) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connecion, $sql);
    
    if ($stmt) {
        $stmt->bind_param("isssii", $id_vuelo, $origen, $destino, $fecha, $plazas_disponibles, $precio);
        if ($stmt->execute()) {
            echo "<script>
                    alert('Vuelo agregado con éxito');
                    window.location.href = 'vuelo.html';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Error: " . $stmt->error . "');
                    window.location.href = 'vuelo.html';
                  </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($conexion) . "');
                window.location.href = 'vuelo.html';
              </script>";
    }
    $connecion->close();
}
?>