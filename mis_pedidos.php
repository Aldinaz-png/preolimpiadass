<?php
session_start();
include 'conexion.php';
if (!isset($_SESSION['cliente_id'])) {
    header("Location: login.php");
    exit;
}
$cliente_id = $_SESSION['cliente_id'];
$sql = "SELECT * FROM pedidos WHERE cliente_id = ? AND estado = 'pendiente' ORDER BY fecha DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cliente_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mis pedidos</title>
</head>
<body>
    <h1>Mis pedidos pendientes</h1>
    <?php if($result->num_rows == 0): ?>
        <p>No tienes pedidos pendientes.</p>
    <?php else: ?>
        <ul>
        <?php while($pedido = $result->fetch_assoc()): ?>
            <li>Pedido <?php echo $pedido['numero_pedido']; ?> - Total $<?php echo $pedido['total']; ?> - 
            <a href="modificar_pedido.php?id=<?php echo $pedido['id']; ?>">Modificar</a> |
            <a href="eliminar_pedido.php?id=<?php echo $pedido['id']; ?>">Eliminar</a>
            </li>
        <?php endwhile; ?>
        </ul>
    <?php endif; ?>
    <a href="index.php">Seguir comprando</a>
</body>
</html>