<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cadastro de Usuario</title>
        <link rel="stylesheet" type="text/css" href="../../libs/bootstrap/css/bootstrap.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <div class="container">
            <form class="form-singin" action="../../controllers/Usuario/c_incluir_usuario.php" method="POST">
            <div>
                <h5 class="form-signin-heading">Cadastro de Usuário</h5>
            </div>
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input name="nome" id="nome" type="text" placeholder="Digite seu nome" autofocus class="form-control" required/>
                <label for="email">E-mail:</label>
                <input name="email" id="email" type="text" placeholder="Digite seu email" class="form-control" required/>
                <label for="celular">Celular:</label>
                <input name="celular" id="celular" type="text" placeholder="Digite seu celular" class="form-control" required/>
                <label for="login">Login:</label>
                <input name="login" id="login" type="text" placeholder="Digite seu login" class="form-control" required/>
                <label for="senha">Senha:</label>
                <input name="senha" id="senha" type="password" placeholder="Digite seu senha" class="form-control" required/>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
            <a href="../../index.php" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
        <p class="text-center text-danger">
            <?php
                if(isset($_SESSION['erroNovoUsuario'])){
                    echo $_SESSION['erroNovoUsuario'];
                    unset($_SESSION['erroNovoUsuario']);
                }
            ?>
        </p>
    </body>
</html>