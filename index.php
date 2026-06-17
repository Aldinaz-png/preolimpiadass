<?php 
session_start();
include 'conexion.php'; 
// Obtener TODOS los productos
$sql = "SELECT * FROM productos ORDER BY codigo";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Together - Todos los paquetes</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <nav id="header">
            <div id="headerizquierda">
                <a href="index.php"><img src="imgs/logo.png" id="logo" alt="Logo"></a>
                <h1 id="tituloLogo">Travel together</h1>
            </div>
            <div id="headerderecha">
                <ul>
                    <li><a href="login.php"><img class="headerimg" src="imgs/usuario.png" alt="Usuario"></a></li>
                    <li><a href="carrito.php"><img class="headerimg" src="imgs/carrito.png" alt="Carrito"></a></li>
                   
                </ul>
            </div>
        </nav>
    </header>
   
    <div id="centrodiv">
        <div id="textocentro"><h2>Viajes Asegurados hola</h2></div>
        <input type="text" placeholder="¿A donde quieres?" id="buscador">
    </div>

    <div id="abajodiv">
        <div id="line"></div>
        <h2 id="seccion1">Todos nuestros<br>paquetes</h2>
        <div id="line"></div>
    </div>

    <div id="paquetes">
        <?php if ($resultado->num_rows > 0): ?>
            <?php while($row = $resultado->fetch_assoc()): 
                // Asignar imagen según la descripción (igual que en las páginas de región)
                $imagen = '';
                switch($row['descripcion']) {
                    // América
                    case 'Estados Unidos': $imagen = 'oip.webp'; break;
                    case 'Brasil': $imagen = 'brazil.png'; break;
                    case 'Perú': $imagen = 'peru.png'; break;
                    case 'Chile': $imagen = 'chile.png'; break;
                    case 'México': $imagen = 'mexico.png'; break;
                    case 'República Dominicana': $imagen = 'rd.png'; break;
                    // Asia
                    case 'China': $imagen = 'china.png'; break;
                    case 'Vietnam': $imagen = 'vietnam.png'; break;
                    case 'Corea del Sur': $imagen = 'korea.png'; break;
                    case 'Mongolia': $imagen = 'mongolia.png'; break;
                    case 'Japón': $imagen = 'japon.png'; break;
                    case 'Tailandia': $imagen = 'tailandia.png'; break;
                    // Europa
                    case 'Italia': $imagen = 'roma.webp'; break;
                    case 'España': $imagen = 'españa.png'; break;
                    case 'Inglaterra': $imagen = 'inlaterra.png'; break;
                    case 'Francia': $imagen = 'francia.png'; break;
                    case 'Portugal': $imagen = 'portugal.png'; break;
                    case 'Alemania': $imagen = 'alemania.png'; break;
                    default: $imagen = 'default.png';
                }
            ?>
            <div class="paquete">
                <img src="imgs/<?php echo $imagen; ?>" class="packImg" alt="<?php echo $row['descripcion']; ?>">
                <h3><?php echo $row['descripcion']; ?></h3>
                <p>Precio: $<?php echo number_format($row['precio'], 2); ?></p>
                <form method="POST" action="agregar_al_carrito.php">
                    <input type="hidden" name="producto_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="codigo" value="<?php echo $row['codigo']; ?>">
                    <input type="hidden" name="descripcion" value="<?php echo $row['descripcion']; ?>">
                    <input type="hidden" name="precio" value="<?php echo $row['precio']; ?>">
                    <input type="hidden" name="imagen" value="<?php echo $imagen; ?>">
                    <label>Cantidad: <input type="number" name="cantidad" value="1" min="1" style="width:60px;"></label>
                    <button type="submit" class="btn-paquete">Agregar al carrito</button>
                </form>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay paquetes disponibles en este momento.</p>
        <?php endif; ?>
    </div>

    <footer>Travel Together - Tu agencia de viajes</footer>
</body>
</html>