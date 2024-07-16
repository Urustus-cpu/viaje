<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="masDedos.css">
    <title>Reservas de Hoteles</title>
</head>
<body>
    <div class="container">
        <h1>Hoteles con más de dos reservas</h1>
        <div id="resultados">
        <?php
include 'conexion.php';

$sql = "SELECT h.ID_HOTEL, h.NOMBRE, COUNT(r.ID_RESERVA) AS NUMERO_RESERVAS
        FROM HOTEL h
        JOIN RESERVA r ON h.ID_HOTEL = r.ID_HOTEL
        GROUP BY h.ID_HOTEL
        HAVING COUNT(r.ID_RESERVA) > 2";

$result = mysqli_query($connecion, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID Hotel</th>
                    <th>Nombre Hotel</th>
                    <th>Número de Reservas</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['ID_HOTEL'] . "</td>
                    <td>" . $row['NOMBRE'] . "</td>
                    <td>" . $row['NUMERO_RESERVAS'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No hay hoteles con más de dos reservas.";
    }
} else {
    echo "Error en la consulta: " . mysqli_error($connecion);
}

mysqli_close($connecion);
?>

        </div>
    </div>
</body>
</html>