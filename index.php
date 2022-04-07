<?php 
    session_start();

    require 'db.php';


    if (isset($_SESSION['user_id'])) {
        $records = $conn -> prepare('SELECT id, email, password FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        
        $user = null;

        if (count($results) > 0 ) {
            $user = $results;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate o ingresa</title>
</head>
<body>
    <?php require 'componentes/header.php' ?>

    <?php if(!empty($user)): ?>
    <br> Welcome. <?php echo $user['email']; ?>
    <br> Te loggeaste bien
    <a href="logout.php">Salir</a>
    <?php else : ?>
        <h1>Registrate o ingresa</h1>
        <a href="login.php">Login</a> o
        <a href="signup.php">Registrate</a>
    <?php endif ?>
</body>
</html>