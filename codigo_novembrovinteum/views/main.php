<?php
session_start();
require_once('../models/Usuario.php');
use MODELS\Usuario;
if(isset($_SESSION['usuario'])){
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bem Vindo ao Sistema</title>
        <link rel="stylesheet" type="text/css" href="../libs/bootstrap/css/bootstrap.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="collapse navbar-collapse" id="textoNavbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-link active">
                           <a class="nav-link" href="#">Home<span class="sr-only">(Página atual)</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="">Cadastrar Prospect</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        Bem Vindo: <?php $usuario = unserialize($_SESSION['usuario']);
                        echo $usuario->nome;
                        ?>
                    </span>
                </div>
            </nav>
        </header>
    </body>
</html>
<?php
}else{
    $_SESSION['erroLogin'] = "Você precisa fazer login para acessar o sistema";
    header("Location: ../index.php");
}
?>