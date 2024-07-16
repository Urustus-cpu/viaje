<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cliente = $_POST['id_cliente'];
    
    $sql = "SELECT * FROM reserva WHERE id_cliente = ?";
    $stmt = mysqli_prepare($connecion, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $id_cliente);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        echo "<h1>Reservas del Cliente: $id_cliente</h1>";
        
        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>ID Reserva</th>
                        <th>Fecha de Reserva</th>
                        <th>ID Vuelo</th>
                        <th>ID Hotel</th>
                    </tr>";
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . $row['ID_RESERVA'] . "</td>
                        <td>" . $row['FECHA_RESERVA'] . "</td>
                        <td>" . $row['ID_VUELO'] . "</td>
                        <td>" . $row['ID_HOTEL'] . "</td>
                      </tr>";
            }
            
            echo "</table>";
        } else {
            echo "No se encontraron reservas para el cliente: $id_cliente";
        }
        
        $stmt->close();
    } else {
        echo "Error en la preparación de la declaración: " . mysqli_error($connecion);
    }

    $connecion->close();
}
?>