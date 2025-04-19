<?php
session_start();

// Inventario inicial
if (!isset($_SESSION['refresco'])) {
    $_SESSION['refresco'] = 10;
    $_SESSION['leche'] = 5;
}

$error = "";

if (isset($_POST['work_name'])) {
    $_SESSION['work_name'] = $_POST['work_name'];
}

if (!empty($_POST)) {
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $accion = $_POST['accion'];

    if ($cantidad > 0) {
        if ($accion === 'añadir') {
            $_SESSION[$producto] += $cantidad;
        } elseif ($accion === 'quitar') {
            if ($_SESSION[$producto] >= $cantidad) {
                $_SESSION[$producto] -= $cantidad;
            } else {
                $error = "No hay suficientes unidades.";
            }
        }
    } else {
        $error = "Cantidad inválida.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor Simple de Inventario</title>
</head>
<body>
    <h1>Inventario del Supermercado</h1>

    <form method="POST">
    <label>Work Name:</label>
    <input type="text" name="work_name" value="<?php echo $_SESSION ['work_name']??'';?>"><br><br>
    <label>Producto:</label>
        <select name="producto">
            <option value="refresco">Refresco</option><br>
            <option value="leche">Leche</option>
        </select>
        <br>

        <label>Cantidad:</label>
        <input type="number" name="cantidad" min="1" required>
        <br>

        <button type="submit" name="accion" value="añadir">Añadir</button>
        <button type="submit" name="accion" value="quitar">Quitar</button>
    </form>

    <h2>Inventario Actual</h2>
    <p>Trabajador: <?php echo $_SESSION['work_name']?></p>
    <p>Refrescos: <?php echo $_SESSION['refresco']; ?> unidades</p>
    <p>Leche: <?php echo $_SESSION['leche']; ?> unidades</p>
</body>
</html>