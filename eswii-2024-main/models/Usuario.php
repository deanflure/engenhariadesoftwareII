<?php
namespace models;
/**
 * Classe Model de Usuários
 * @author Paulo Roberto Córdova
 * 
 */
class Usuario{
  /**
   * Login do usuário
   * @var string */
  public $login;
  /**
   * Nome do usuário
   * @var string
    */
    public $nome;
    /**
     * E-mail do usuário
     * @var string
      */  
      public $email;
      /**
       * Celular do usuário
       * @var string
       */
      public $celular;
      /**
       * Status do usuário no sistema
       * @var boolean
       */
      public $logado;
    /**
     * Essa função carrega os atributos da classe Usuario
     * @param string $login Login do usuário.
     * @param string $nome Nome do usuario.
     * @param string $email E-mail do usuário.
     * @param string $celular Celular do usuário.
     * @param boolean $logado Se o usuário logar com sucesso, recebe TRUE, senão recebe FALSE
     * @return Void
     */
      public function addUsuario($login, $nome, $email, $celular, $logado){
            $this->login    = $login;
            $this->nome     = $nome;
            $this->email    = $email;
            $this->celular  = $celular;
            $this->logado   = $logado;
      }

}

?>