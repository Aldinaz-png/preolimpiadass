<?php
include 'conexion.php';
if ($_POST) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nombre = $_POST['nombre'];
    $sql = "INSERT INTO clientes (email, password, nombre) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $password, $nombre);
    if ($stmt->execute()) {
        echo "Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "Error: el email ya existe.";
    }
} else {
?>
<form method="POST">
    Email: <input type="email" name="email" required><br>
    Contraseña: <input type="password" name="password" required><br>
    Nombre: <input type="text" name="nombre"><br>
    <input type="submit" value="Registrarse">
</form>
<?php } ?>