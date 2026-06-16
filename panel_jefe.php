<?php
session_start();
// Por simplicidad, asumimos que el jefe de ventas tiene email "jefe@turismo.com" y contraseña que registró previamente.
// Pero para pruebas, creá un usuario con ese email en la tabla clientes.
include 'conexion.php';
if (!isset($_SESSION['cliente_email']) || $_SESSION['cliente_email'] != 'jefe@turismo.com') {
    die("Acceso denegado. Solo el jefe de ventas puede acceder.");
}
// Aquí podrías agregar funcionalidades: cargar productos, ver pedidos, marcar entregados, etc.
?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel del Jefe de Ventas</title>
</head>
<body>
    <h1>Panel de Jefe de Ventas</h1>
    <h2>Cargar nuevo producto</h2>
    <form method="POST" action="cargar_producto.php">
        Código: <input name="codigo"><br>
        Descripción: <textarea name="descripcion"></textarea><br>
        Precio: <input type="number" step="0.01" name="precio"><br>
        <button type="submit">Guardar</button>
    </form>
    <h2>Pedidos pendientes</h2>
    <?php
    $result = $conn->query("SELECT * FROM pedidos WHERE estado='pendiente'");
    while($pedido = $result->fetch_assoc()):
    ?>
        <div>
            Pedido: <?php echo $pedido['numero_pedido']; ?> - Cliente ID: <?php echo $pedido['cliente_id']; ?> - Total: $<?php echo $pedido['total']; ?>
            <a href="entregar_pedido.php?id=<?php echo $pedido['id']; ?>">Marcar como entregado</a>
            <a href="anular_pedido.php?id=<?php echo $pedido['id']; ?>">Anular</a>
        </div>
    <?php endwhile; ?>
</body>
</html>