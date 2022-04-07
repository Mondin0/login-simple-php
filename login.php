<?php 
session_start();

if(isset($_SESSION['user_id'])){
    header('Location: /xampp/login/');
};

require 'db.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn ->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $msg = '';

    if (count($results)>0 && password_verify($_POST['password'], $results['password'] ) ) {
        $_SESSION['user_id'] = $results['id'];
        header('Location: /xampp/login/');
    }else {
        $msg = 'Credenciales no coinciden';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php require 'componentes/header.php' ?>

    <?php if(!empty($msg)): ?>
        <p><?php echo $msg; ?></p>
    <?php endif; ?>
    <h1>Ingresar</h1>
    <form action="login.php" method="post">
        <input type="email" name="email" id="email" required pattern="[A-Za-z0-9_-#]{1,15}" placeholder="Ingresa tu email">
        <input type="text" name="password" pattern="[A-Za-z0-9_-#]{1,15}" required id="password" placeholder="Ingresa la contraseña">
        <input type="submit" value="Ingresar">
    </form>
    <a href="index.php">Volver al inicio</a>
</body>
</html>