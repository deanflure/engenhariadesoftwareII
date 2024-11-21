<?php
session_start();

require_once('ControllerUsuario.php');
use controllers\ControllerUsuario;

$nome = $_POST['nome'];
$email = $_POST['email'];
$login = $_POST['login'];
$senha = $_POST['senha'];

$ctrlUsuario = new ControllerUsuario();

try{
    $ctrlUsuario->salvarUsuario($nome, $email, $login, $senha);
    unset($ctrlUsuario);
    $_SESSION['erroLogin'] = "Faça o Login para entrar no sistema";
    header("Location: ../../index.php");
}catch(Exception $e){
    $_SESSION['erroUsuarioNovo'] = $e->getMessage();
    unset($ctrlUsuario);
    header("Location: ../../views/Usuario/v_incluir_usuario.php");
}
?>