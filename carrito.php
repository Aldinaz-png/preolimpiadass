<?php
session_start();
include 'conexion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mi Carrito</title>
    <link rel="stylesheet" href="css/estilos1.css">
</head>
<body>
    <h1>Carrito de Compras</h1>
    <?php if(empty($_SESSION['carrito'])): ?>
        <p>El carrito está vacío. <a href="index.php">Seguir comprando</a></p>
    <?php else: ?>
        <table border="1">
            <tr><th>Código</th><th>Descripción</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th>Acciones</th></tr>
            <?php 
            $total = 0;
            foreach($_SESSION['carrito'] as $id => $item):
                $subtotal = $item['precio'] * $item['cantidad'];
                $total += $subtotal;
            ?>
            <tr>
                <td><?php echo $item['codigo']; ?></td>
                <td><?php echo $item['descripcion']; ?></td>
                <td>$<?php echo number_format($item['precio'],2); ?></td>
                <td>
                    <form method="POST" action="actualizar_carrito.php">
                        <input type="hidden" name="producto_id" value="<?php echo $id; ?>">
                        <input type="number" name="cantidad" value="<?php echo $item['cantidad']; ?>" min="0">
                        <button type="submit">Actualizar</button>
                    </form>
                </td>
                <td>$<?php echo number_format($subtotal,2); ?></td>
                <td><a href="eliminar_del_carrito.php?id=<?php echo $id; ?>">Eliminar</a></td>
            </tr>
            <?php endforeach; ?>
            <tr><td colspan="4" align="right"><strong>Total:</strong></td><td colspan="2">$<?php echo number_format($total,2); ?></td></tr>
        </table>
        <a href="finalizar_compra.php">Finalizar Compra</a>
    <?php endif; ?>
</body>
</html>