<?php
namespace MODELS;
/**
 * Classe Model de Usuários
 *
 * @author Paulo Roberto Córdova
 *
 */
class Usuario{
  /**
    * Login do Usuários
    * @var string
    */
   public $login;
   /**
    * Nome do Usuários
    * @var string
    */
   public $nome;
   /**
    * Email do Usuários
    * @var string
    */
   public $email;
   /**
    * Celular do Usuários
    * @var string
    */
   public $celular;
   /**
    * Status do Usuário no sistema
    * @var string
    */
   public $logado;
    /**
    * Carrega os atributos da classe
    * @param string $login Login do usuário
    * @param string $senha Senha do usuário
    * @param string $email Email do usuário
    * @param string $celular Celular do usuário
    * @param string $logado Se for logado com sucesso recebe TRUE, senão recebe FALSE
    * @return Void
    */
   public function addUsuario($login, $nome, $email, $celular, $logado){ //Erro: Falta o celular...
     $this->login = $login;
     $this->nome = $nome;
     $this->email = $email;
     $this->celular = $celular;
     $this->logado = $logado;
   }
}
?>