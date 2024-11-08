<?php
namespace models  ;

/**
 * Classe Model de Prospects
 *
 * @author Paulo Roberto Córdova
 */
class Prospect{
   /**
    * Código do Prospect
    * @var int
    */
   public $codigo;
   /**
    * Nome do Prospect
    * @var string
    */
   public $nome;
   /**
    * Emsil do Prospect
    * @var string
    */
   public $email;
   /**
    * Celular do Prospect
    * @var string
    */
   public $celular;
   /**
    * Endereço de facebook do Prospect
    * @var string
    */
   public $facebook;
   /**
    * Número do whatsapp do Prospect
    * @var string
    */
   public $whatsapp;

    /**
    * Carrega os atributos da classe
    * @param string $codigo Código do Prospect
    * @param string $nome Nome do Prospect
    * @param string $email Email do Prospect
    * @param string $celular Celular do Prospect
    * @param string $facebook Endereço do facebook do Prospect
    * @param string $whatsapp Número do whatsapp do Prospect
    * @return Void
    */
   public function addProspect($codigo, $nome, $email, $celular, $facebook, $whatsapp){
      $this->codigo = $codigo;
      $this->nome = $nome;
      $this->email = $email;
      $this->celular = $celular;
      $this->facebook = $facebook;
      $this->whatsapp = $whatsapp;
   }
}

?>