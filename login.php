<?php include("config/init.php"); ?>
<?php include("config/config.php");?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo DIRPAGE.'smille/lib/css/login.css';?>">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>Smille | Login</title>
</head>
<body>
    <div class="container">
        <h2>Bem vindo!</h2>

        <?php
            if (isset($_SESSION['erro'])) {
                echo $_SESSION['erro'];
                unset($_SESSION['erro']);
            }
        ?>

        <form action="<?php echo DIRPAGE.'smille/controllers/ControllerLogin.php'?>" method="post">
            <input type="text" placeholder="Email" name="email" >
            <br><br>
            <input type="password" placeholder="Senha" name="senha" >
            <br><br><br>
            <input type="submit" value="Entrar">
        </form>

        </div>
    </div>
    
</body>
</html>