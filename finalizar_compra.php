<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['cliente_id'])) {
    header("Location: login.php");
    exit;
}
if (empty($_SESSION['carrito'])) {
    header("Location: index.php");
    exit;
}

$cliente_id = $_SESSION['cliente_id'];
$total = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total += $item['precio'] * $item['cantidad'];
}
$numero_pedido = 'PED-' . date('Ymd') . rand(100,999);
$fecha = date('Y-m-d H:i:s');

$sql = "INSERT INTO pedidos (numero_pedido, cliente_id, fecha, total, estado) VALUES (?, ?, ?, ?, 'pendiente')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("siss", $numero_pedido, $cliente_id, $fecha, $total);
$stmt->execute();
$pedido_id = $stmt->insert_id;

foreach ($_SESSION['carrito'] as $id => $item) {
    $sql_det = "INSERT INTO detalles_pedido (pedido_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
    $stmt_det = $conn->prepare($sql_det);
    $stmt_det->bind_param("iiid", $pedido_id, $id, $item['cantidad'], $item['precio']);
    $stmt_det->execute();
}

// Vaciar carrito
$_SESSION['carrito'] = [];

// Simular cobro y mail (por ahora solo mostramos mensaje)
echo "<h2>¡Compra finalizada!</h2>";
echo "<p>Pedido número: $numero_pedido. Total: $$total.</p>";
echo "<p>Se ha enviado un email de confirmación a tu correo y al sector de la empresa.</p>";
echo '<a href="index.php">Volver a la tienda</a>';
?>