<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_vista_reserva.css">
    <title>su reserva</title>
    <script>
        function validar() {
            let id_cliente = document.getElementById('id_cliente').value;
            if (id_cliente === '') {
                alert('Por favor ingrese todos los campos');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Registros de reserva</h1>
        <form class="formulario" action="vista_reserva.php" method="post" onsubmit="return validar()">
            <label for="id_cliente">Nombre cliente:</label>
            <input type="text" id="id_cliente" name="id_cliente" required>
            <button type="submit">Buscar por usuario</button>
        </form>
        <div id="resultados">
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

                    echo "<h2>Reservas del Cliente: $id_cliente</h2>";
                    
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table>
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
                        echo "<p>No se encontraron reservas para el cliente: $id_cliente</p>";
                    }
                    
                    $stmt->close();
                } else {
                    echo "<p>Error en la preparación de la declaración: " . mysqli_error($connecion) . "</p>";
                }

                $connecion->close();
            }
            ?>
        </div>
    </div>
</body>
</html>

