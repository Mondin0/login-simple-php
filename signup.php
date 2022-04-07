<?php 
require 'db.php';

$msg = '';

if(!empty($_POST['email']) && !empty($_POST['password'])){
    $sql = "INSERT INTO users (email,password)VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt ->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt ->bindParam(':password', $password);

    if ($stmt -> execute()) {
        $msg = 'creado correctamente';
    } else {
        $msg = 'ocurrio un error';
    };
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REgistrar</title>
</head>
<body>
    <?php require 'componentes/header.php' ?>
    <?php if(!empty($msg)): ?>
        <p><?php echo $msg ; ?></p>
    <?php endif; ?>
    <h1>Registro de usuario</h1>
    <form action="signup.php" method="post">
        <input type="email" name="email" id="email" placeholder="Ingresa tu email">
        <input type="password" name="password" id="password" placeholder="Ingresa la contraseña">
        <input type="submit" value="Ingresar">
    </form>
    <span>o <a href="login.php">Ingresa</a></span>
</body>
</html>