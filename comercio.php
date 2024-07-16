<?php
//renovacion abre seccion y la renueva cada 10 minutos 
include 'renovacion.php';
// Lista predefinida de paquetes turísticos
$paquetes = [
    ['nombre' => "Cancún", 'dias' => "3 días", 'precio' => 1000000],
    ['nombre' => "París", 'dias' => "5 días", 'precio' => 1900000],
    ['nombre' => "Tokio", 'dias' => "4 días", 'precio' => 1750000],
    ['nombre' => "Nueva York", 'dias' => "3 días", 'precio' => 1000000],
    ['nombre' => "Londres", 'dias' => "7 días", 'precio' => 2000000]
];

// Lista de opciones adicionales
$opciones_adicionales = [
    ['nombre' => "Almuerzo incluido", 'costo' => 250000],
    ['nombre' => "Movilización", 'costo' => 500000],
    ['nombre' => "Visitas guiadas", 'costo' => 400000]
];

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Agregar al carrito
    if (isset($_POST['item'])) {
        $item = $_POST['item'];
        $opciones_seleccionadas = $_POST['opciones'] ?? [];

        if (isset($paquetes[$item])) {
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }
            $paquete_seleccionado = $paquetes[$item];
            $paquete_completo = $paquete_seleccionado['nombre'] . " (" . $paquete_seleccionado['dias'] . ") - $" . $paquete_seleccionado['precio'];

            $opciones_completas = [];
            foreach ($opciones_seleccionadas as $opcion_index) {
                if (isset($opciones_adicionales[$opcion_index])) {
                    $opciones_completas[] = $opciones_adicionales[$opcion_index]['nombre'] . " - $" . $opciones_adicionales[$opcion_index]['costo'];
                }
            }

            $_SESSION['carrito'][] = $paquete_completo . " con " . implode(", ", $opciones_completas);
        }
    }

    // Eliminar del carrito
    if (isset($_POST['eliminar'])) {
        $indice = $_POST['eliminar'];
        if (isset($_SESSION['carrito'][$indice])) {
            unset($_SESSION['carrito'][$indice]);
            $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar el array
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comercio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Bienvenido</h1>
    <div class="close">
        <form action="cierre.php" method="post">
            <button type="submit">Cerrar Sesión</button>
        </form>
    </div>
    <div>
        <h2>Carrito de Compra</h2>
        <div class="carrito">
            <?php if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])): ?>
                <ul>
                    <?php foreach ($_SESSION['carrito'] as $indice => $item): ?>
                        <li>
                            <?php echo htmlspecialchars($item); ?>
                            <form action="comercio.php" method="post" style="display:inline;">
                                <input type="hidden" name="eliminar" value="<?php echo $indice; ?>">
                                <button type="submit">Eliminar</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>El carrito está vacío.</p>
            <?php endif; ?>
        </div>
        <form action="comercio.php" method="post">
            <label for="item">Agregar paquete turístico:</label>
            <select id="item" name="item">
                <?php foreach ($paquetes as $index => $paquete): ?>
                    <option value="<?php echo $index; ?>"><?php echo htmlspecialchars($paquete['nombre'] . " - " . $paquete['dias'] . " - $" . $paquete['precio']); ?></option>
                <?php endforeach; ?>
            </select>
            <fieldset>
                <legend>Opciones adicionales:</legend>
                <?php foreach ($opciones_adicionales as $index => $opcion): ?>
                    <label>
                        <input type="checkbox" name="opciones[]" value="<?php echo $index; ?>">
                        <?php echo htmlspecialchars($opcion['nombre'] . " - $" . $opcion['costo']); ?>
                    </label><br>
                <?php endforeach; ?>
            </fieldset>
            <button type="submit">Agregar al carrito</button>
        </form>
    </div>  
</body>
</html>