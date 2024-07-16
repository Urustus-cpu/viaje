<?php
include 'conexion.php';

$reservas = [
    ['id_cliente' => 'Claudio', 'fecha_reserva' => '2024-07-11', 'id_vuelo' => 1, 'id_hotel' => 32],
    ['id_cliente' => 'Claudio', 'fecha_reserva' => '2024-07-12', 'id_vuelo' => 2, 'id_hotel' => 55],
    ['id_cliente' => 'Claudio', 'fecha_reserva' => '2024-07-13', 'id_vuelo' => 25, 'id_hotel' => 88],
    ['id_cliente' => 'patron', 'fecha_reserva' => '2024-07-14', 'id_vuelo' => 1, 'id_hotel' => 32],
    ['id_cliente' => 'patron', 'fecha_reserva' => '2024-07-15', 'id_vuelo' => 2, 'id_hotel' => 88],
    ['id_cliente' => 'patron', 'fecha_reserva' => '2024-07-16', 'id_vuelo' => 58, 'id_hotel' => 55],
    ['id_cliente' => 'patron', 'fecha_reserva' => '2024-07-17', 'id_vuelo' => 1, 'id_hotel' => 32],
    ['id_cliente' => 'Hernan', 'fecha_reserva' => '2024-07-18', 'id_vuelo' => 123, 'id_hotel' => 32],
    ['id_cliente' => 'Hernan', 'fecha_reserva' => '2024-07-19', 'id_vuelo' => 123, 'id_hotel' => 55],
    ['id_cliente' => 'patron', 'fecha_reserva' => '2024-07-20', 'id_vuelo' => 1, 'id_hotel' => 88]
];

foreach ($reservas as $reserva) {
    $sql = "INSERT INTO reserva (id_cliente, fecha_reserva, id_vuelo, id_hotel) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connecion, $sql);
    if ($stmt) {
        $stmt->bind_param("ssii", $reserva['id_cliente'], $reserva['fecha_reserva'], $reserva['id_vuelo'], $reserva['id_hotel']);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Error en la preparación de la declaración: " . mysqli_error($connecion);
    }
}

$connecion->close();
?>