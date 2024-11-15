<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Cadastro de Usuario </title>
        <link rel="stylesheet" type="text/css" href="../../libs/bootsrap/css/bootstrap.php";
        <meta charset="UTF-8">
    </head>
    <body>
        <div class="container">
            <form class="form-signin" action="../../controllers/Usuario/c_incluir_usuario.php" method=POST>
        </div>
        <div>
            <h5 class="form-signin-heading"> Cadastro de Usuario </h5>
        </div>
        <div class="form-group">
            <label for="nome"> Nome: </label>
            <input name="nome" id="nome" type="text" placehost="Digite seu nome" autofocus class="form-control" required>
            <label for="email"> E-mail; </label>
            <input name="email" id="email" type="email" placehost="Digite seu celular" class="form-control" required>
            <label for="celular"> celular; </label>
            <input name="celular" id="celular" type="celular" placehost="Digite seu celular" class="form-control" required>
            <label for="senha"> senha; </label>
            <input name="senha" id="senha" type="senha" placehost="Digite seu login" class="form-control" required>
            <label for="login"> Login; </label>
            <input name="login" id="login" type="login" placehost="Digite seu login" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-sucess"> Cadastrar </button>
        <a href="../../index.php" class="btn btn-danger"> Cancelar</a>
            <div>
                <p class="text-center text-danger"> 
                    <?php 
                    if(isset($_SESSION['erroNovoUsuario'])){
                        echo $_SESSION['erroNovoUsuario'];
                    } ?> 
            </div>
    </body>
</html>