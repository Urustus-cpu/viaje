<?php
include 'conexion.php';

$sql = "
    SELECT h.ID_HOTEL, h.NOMBRE_HOTEL, COUNT(r.ID_RESERVA) as num_reservas FROM HOTEL h JOIN 
        RESERVA r ON h.ID_HOTEL = r.ID_HOTEL GROUP BY h.ID_HOTEL, h.NOMBRE_HOTEL HAVING COUNT(r.ID_RESERVA) > 2
";

$result = mysqli_query($connecion, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table>
                <tr>
                    <th>ID Hotel</th>
                    <th>Nombre Hotel</th>
                    <th>Número de Reservas</th>
                </tr>";
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['ID_HOTEL'] . "</td>
                    <td>" . $row['NOMBRE_HOTEL'] . "</td>
                    <td>" . $row['num_reservas'] . "</td>
                  </tr>";
        }
        
        echo "</table>";
    } else {
        echo "<p>No hay hoteles con más de dos reservas.</p>";
    }
} else {
    echo "<p>Error en la consulta: " . mysqli_error($connecion) . "</p>";
}

mysqli_close($connecion);
?>
