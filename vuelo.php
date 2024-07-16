<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Vista</title>
    <script>
        fun
    </script>
</head>
<body>
    <h1>ViajesDespegar</h1>
    <p>ingreso de vuelos</p>
    <form action="vuelo.php" method="post">
        <label for="id_vuelo">Numero vuelo:</label>
        <label for="origen">Origen:</label>
        <input type="text" id="origen" name="origen" required><br>
        <label for="destino">Destino:</label>
        <input type="text" id="destino" name="destino" required><br>
        <label for="fecha">Fecha(DD/MM/YYYY):</label>
        <input type="date" id="fecha" name="fecha" required><br>
        <label for="plazas_disponibles">Plazas Disponibles:</label>
        <input type="number" id="plazas_disponibles" name="plazas_disponibles" required><br>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" required><br>
        <button type="submit">Agregar Vuelo</button>
    </form>
</body>
</html>