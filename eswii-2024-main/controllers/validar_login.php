<?php
session_start();
require_once('Usuario/ControllerUsuario.php');
use controllers\ControllerUsuario;
if(isset($_POST['login'])&& isset(($_POST['senha']))){
    $login = $_POST['login'];
    $senha = $_POST ['senha'];
    $ctrlUsuario = new ControllerUsuario();
    $usuario = $ctrlUsuario->fazerLogin($login, $senha);
        if($Usuario->logado){
            $_SESSION['usuario'] = $usuario;
            header("Location: ../views/main.php");
        }else{
            $_SESSION['errologin'] = "Login ou senha invalidos, tente novamente";
            header("Location: ../views/index.php");
        }
}else{
        $_SESSION['errologin'] = "Você precisa fazer login para acessar";
        header("Location: .../index.php");
}
?>