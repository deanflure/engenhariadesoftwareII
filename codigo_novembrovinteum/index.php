<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cadastro de Prospects</title>
        <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.css">
        <style type="text/css">
            .login-form {
                width: 600px;
                margin: 50px auto;
            }
            .login-form form {
                box-shadow: 0px 2px 2px rgba(0,0,0,0.3);
                padding:30px;
            }
        </style>
    </head>
    <body>
        <div class="login-form">
            <form class="form-signin" action="controllers/validar_login.php" method="POST">
                <div class="row">
                    <img src="assets/customer.jpg" width="80">
                </div>
                <h2 class="text-center">Log in</h2>
                <div class="form-group">
                    <input class="form-control" name="login" type="text" placeholder="Login" required="required">
                </div>
                <div class="form-group">
                    <input class="form-control" name="senha" type="password" placeholder="Senha" required="required">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Entrar</button>
                </div>
            </form>
            <p class="text-center"><a href="views/Usuario/v_incluir_usuario.php">Cadastre-se</a></p>
            <p class="text-center text-danger">
                <?php
                    if(isset($_SESSION['erroLogin'])){
                        echo $_SESSION['erroLogin'];
                        unset($_SESSION['erroLogin']);
                    }
                ?>
        </div>
    </body>
</html>