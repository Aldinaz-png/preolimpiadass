<?php
session_start();
$id = $_POST['producto_id'];
$cantidad = $_POST['cantidad'];
if ($cantidad <= 0) {
    unset($_SESSION['carrito'][$id]);
} else {
    $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
}
header("Location: carrito.php");
?>