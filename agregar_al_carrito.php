<?php
session_start();
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
$id = $_POST['producto_id'];
$cantidad = $_POST['cantidad'];
if (isset($_SESSION['carrito'][$id])) {
    $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
} else {
    $_SESSION['carrito'][$id] = [
        'codigo' => $_POST['codigo'],
        'descripcion' => $_POST['descripcion'],
        'precio' => $_POST['precio'],
        'cantidad' => $cantidad
    ];
}
header("Location: index.php");
?>