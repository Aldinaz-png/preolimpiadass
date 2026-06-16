<?php
session_start();
include 'conexion.php';
if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT id, email, password FROM clientes WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['cliente_id'] = $user['id'];
            $_SESSION['cliente_email'] = $user['email'];
            header("Location: index.php");
        } else echo "Contraseña incorrecta";
    } else echo "Usuario no existe";
} else {
?>
<form method="POST">
    Email: <input type="email" name="email"><br>
    Contraseña: <input type="password" name="password"><br>
    <input type="submit" value="Ingresar">
</form>
<?php } ?>