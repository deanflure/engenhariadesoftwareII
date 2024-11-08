<?php

namespace DAO;

$separador = DIRECTORY_SEPARATOR;
$root = $_SERVER['DOCUMENT_ROOT'].$separador;
require_once('../models/Prospect.php');

use MODELS\Prospect;

/**
 * Esta classe é reponsável por fazer a comunicação com o banco de dados,
 * provendo as funções CRUD para os Prospects
 *
 * @author Paulo Roberto Córdova
 * @package DAO
 */
class DAOProspect{
   /**
    * Inclui um novo prospect no banco de dados
    * @param string $nome Nome do novo prospect
    * @param string $email Email do novo prospect
    * @param string $celular Celular do novo prospect
    * @param string $facebook Endereço do facebook do novo prospect
    * @param string $whatsapp Número do whatsapp do novo prospect
    * @return TRUE|Exception
    */
   public function incluirProspect($nome, $email, $celular, $facebook, $whatsapp){
      try {
         $conexaoDB = $this->conectarBanco();
      } catch (\Exception $e) {
         die($e->getMessage());
      }

      $sqlInsert = $conexaoDB->prepare("insert into prospect
                                        (nome, email, celular, facebook, whatsapp)
                                       values
                                       (?,?,?,?,?)");
      $sqlInsert->bind_param("sssss", $nome, $email,$celular,$facebook,$whatsapp);
      $sqlInsert->execute();

      if(!$sqlInsert->error){
         $retorno = TRUE;
      }else{
         throw new \Exception("Não foi possível incluir novo prospect!");
         die;
      }
      $conexaoDB->close();
      $sqlInsert->close();
      return $retorno;
   }
   /**
    * Atualiza os dados de um prospect já cadastrado no banco de dados
    * @param string $nome Novo nome para o Prospect
    * @param string $email Novo email para o Prospect
    * @param string $celular Novo celular para o prospect
    * @param string $facebook Novo endereço de facebook para o Prospect
    * @param string $whatsapp Novo número de whatsapp para o Prospect
    * @param string $codProspect Código do Prospect que deve ser alterado
    * @return TRUE|Exception
    */
   public function atualizarProspect($nome, $email, $celular, $facebook, $whatsapp, $codProspect){
      try {
         $conexaoDB = $this->conectarBanco();
      } catch (\Exception $e) {
         die($e->getMessage());
      }

      $sqlUpdate = $conexaoDB->prepare("update prospect set
                                        nome = ?,
                                        email = ?,
                                        celular = ?,
                                        facebook = ?,
                                        whatsapp = ?
                                        where
                                        cod_prospect = ?");
      $sqlUpdate->bind_param("sssssi", $nome, $email,$celular,$facebook,$whatsapp, $codProspect);
      $sqlUpdate->execute();

      if(!$sqlUpdate->error){
         $retorno = TRUE;
      }else{
         throw new \Exception("Não foi possível alterar o prospect!");
         die;
      }
      $conexaoDB->close();
      $sqlUpdate->close();
      return $retorno;
   }
   /**
    * Exclui um prospect previamente cadastrado do banco de dados
    * @param string $codProspect Código do Prospect que deve ser excluído
    * @return TRUE|Exception
    */
   public function excluirProspect($codProspect){
      try {
         $conexaoDB = $this->conectarBanco();
      } catch (\Exception $e) {
         die($e->getMessage());
      }

      $sqlDelete = $conexaoDB->prepare("delete from prospect
                                        where
                                        cod_prospect = ?");
      $sqlDelete->bind_param("i", $codProspect);
      $sqlDelete->execute();

      if(!$sqlDelete->error){
         $retorno = TRUE;
      }else{
         throw new \Exception("Não foi possível excluir o prospect!");
         die;
      }
      $conexaoDB->close();
      $sqlDelete->close();
      return $retorno;
   }
   /**
    * Busca prospects do banco de dados
    * @param string $email Email do Prospect que deve ser retornado. Este parâmetro é opcional
    * @return Array[Prospect] Se informado email, retorna somente o prospect relacionado.
    * Senão, retornará todos os prospects do banco de dados
    */
   public function buscarProspects($email=null){
      try {
         $conexaoDB = $this->conectarBanco();
      } catch (\Exception $e) {
         die($e->getMessage());
      }
      /*Array que será retornado com um ou mais prospects*/
      $prospects = array();

      if($email === null){
         $sqlBusca = $conexaoDB->prepare("select cod_prospect, nome, email, celular,
                                          facebook, whatsapp
                                          from prospect");
         $sqlBusca->execute();
      }else{
         $sqlBusca = $conexaoDB->prepare("select cod_prospect, nome, email, celular,
                                          facebook, whatsapp
                                          from prospect
                                          where
                                          email = ?");
         $sqlBusca->bind_param("s", $email);
         $sqlBusca->execute();
      }

      $resultado = $sqlBusca->get_result();
      if($resultado->num_rows !== 0){
         while($linha = $resultado->fetch_assoc()){
            $prospect = new Prospect();
            $prospect->addProspect($linha['cod_prospect'], $linha['nome'], $linha['email'], $linha['celular'],
                                   $linha['facebook'], $linha['whatsapp']);
            $prospects[] = $prospect;
         }
      }
      return $prospects;
      $conexaoDB->close();
      $sqlBusca->close();

   }
   private function conectarBanco(){
      if (!defined('DS')) {
         define( 'DS', DIRECTORY_SEPARATOR );
      }
      if (!defined('BASE_DIR')) {
         define( 'BASE_DIR', dirname( __FILE__ ) . DS );
      }
      //require(BASE_DIR . 'configdb.php');
      require('configdb.php');

      try {
         $conn = new \MySQLi($dbhost, $user, $password, $banco);
         return $conn;
      }catch (mysqli_sql_exception $e) {
         throw new \Exception($e);
         die;
      }
   }
}

?>