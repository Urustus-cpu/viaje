<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_hotel = $_POST['id_hotel'];
    $nombre = $_POST['nombre'];
    $ubicacion = $_POST['ubicacion'];
    $habitacion_disponibles = $_POST['habitacion_disponibles'];
    $tarifa_noche = $_POST['tarifa_noche'];

    $sql = "INSERT INTO HOTEL (id_hotel, nombre, ubicacion, habitacion_disponibles,tarifa_noche) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connecion, $sql);
    
    if ($stmt) {
        $stmt->bind_param("issii", $id_hotel, $nombre, $ubicacion, $habitacion_disponibles, $tarifa_noche);
        if ($stmt->execute()) {
            echo "<script>
                    alert('Hotel ingresado con exito');
                    window.location.href = 'hotel.html';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Error: " . $stmt->error . "');
                    window.location.href = 'hotel.html';
                  </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($conexion) . "');
                window.location.href = 'hotel.html';
              </script>";
    }
    $connecion->close();
}
?>