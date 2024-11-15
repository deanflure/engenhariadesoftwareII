<?php
namespace test;
require_once('../vendor/autoload.php');
require_once('../models/Prospect.php');
require_once('../DAO/DAOProspect.php');

use PHPUnit\Framework\TestCase;
use MODELS\Prospect;
use DAO\DAOProspect;

class ProspectTest extends TestCase{

   /** @test */
   public function incluirProspect(){
      $daoProspect = new DAOProspect();
      $this->assertEquals(
         TRUE,
         $daoProspect->incluirProspect('Paulo Roberto Cordova', 'paulo@eu.com.br', '(49)96633-9988', 'facepaulo', '(49)8899-6699')
      );

      unset($daoProspect);
   }
   /** @test */
   public function atualizarProspect(){
      $daoProspect = new DAOProspect();
      $this->assertEquals(
         TRUE,
         $daoProspect->atualizarProspect('Paulo Roberto Cordova', 'paulo@gmail.com.br', '(49)96633-9988',  'facepaulo', '(49)8899-6699', 3)
      );
      unset($daoProspect);
   }
   /** @test */
   public function excluirProspect(){
      $daoProspect = new DAOProspect();
      $this->assertEquals(
         TRUE,
         $daoProspect->excluirProspect(2)
      );
      unset($daoProspect);
   }
   /** @test */
   public function buscarTodosProspectTest(){
      $daoProspect = new DAOProspect();

      $arrayComparar = array();

      $conn = new \mysqli('localhost', 'root', '', 'bd_prospects');
      $sqlBusca = $conn->prepare("select cod_prospect, nome, email, celular,
                                          facebook, whatsapp
                                          from prospect");
      $sqlBusca->execute();
      $result = $sqlBusca->get_result();
      if($result->num_rows !== 0){
         while($linha = $result->fetch_assoc()) {
            $linhaComparar = new Prospect();
            $linhaComparar->addProspect($linha['cod_prospect'], $linha['nome'], $linha['email'], $linha['celular'],
                                   $linha['facebook'], $linha['whatsapp']);
            $arrayComparar[] = $linhaComparar;
         }
      }

      $this->assertEquals(
         $arrayComparar,
         $daoProspect->buscarProspects()
      );
      unset($daoProspect);
      unset($linhaComparar);
      $sqlBusca->close();
      $conn->close();
   }
   /** @test */
   public function buscarProspectPorEmailTest(){
      $daoProspect = new DAOProspect();
      $arrayComparar = array();
      $emailProspect = 'gernunes@hotmail.com';

      $conn = new \mysqli('localhost', 'root', '', 'bd_prospects');
      $sqlBusca = $conn->prepare("select cod_prospect, nome, email, celular,
                                          facebook, whatsapp
                                          from prospect
                                          where
                                          email = '$emailProspect'");
      $sqlBusca->execute();
      $result = $sqlBusca->get_result();
      if($result->num_rows !== 0){
        while($linha = $result->fetch_assoc()) {
            $linhaComparar = new Prospect();
            $linhaComparar->addProspect($linha['cod_prospect'], $linha['nome'], $linha['email'], $linha['celular'],
                                   $linha['facebook'], $linha['whatsapp']);
            $arrayComparar[] = $linhaComparar;
         }
      }

      $this->assertEquals(
         $arrayComparar,
         $daoProspect->buscarProspects($emailProspect)
      );
      unset($daoProspect);
      unset($linhaComparar);
      $sqlBusca->close();
      $conn->close();
   }
}
?>