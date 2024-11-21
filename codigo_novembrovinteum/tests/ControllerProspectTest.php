<?php


require_once('../uteis/vendor/autoload.php');
require_once('../models/Prospect.php');
require_once('../controllers/Prospect/ControllerProspect.php');
use PHPUnit\Framework\TestCase;
use models\Prospect;
use CONTROLLERS\ControllerProspect;

class UsuarioTest extends TestCase{

   /** @test */
   public function incluirProspect(){
      $ctrlProspect = new ControllerProspect();
      $prospect = new Prospect();

      $prospect->addProspect(null, 'Ivanor Thibes', 'thi@iva.com.br', '9999999', '', '8888888');
      try{
         $this->assertEquals(
            TRUE,
            $ctrlProspect->salvarProspect($prospect)
         );
      }catch(\Exception $e){
         $this->fail($e->getMessage());
      }
   }
   /** @test */
   public function alterarProspect(){
      $ctrlProspect = new ControllerProspect();
      $prospect = new Prospect();

      $prospect->addProspect(19, 'Ivanor Thibes', 'thi@iva.com.br', '9999999', '', '777777');
      try{
         $this->assertEquals(
            TRUE,
            $ctrlProspect->salvarProspect($prospect)
         );
      }catch(\Exception $e){
         $this->fail($e->getMessage());

      }
   }
   /** @test */
   public function excluirProspect(){
      $ctrlProspect = new ControllerProspect();
      $prospect = new Prospect();

      $prospect->addProspect(19, 'Ivanor Thibes', 'thi@iva.com.br', '9999999', '', '777777');
      try{
         $this->assertEquals(
            TRUE,
            $ctrlProspect->excluirProspect($prospect)
         );
      }catch(\Exception $e){
         $this->fail($e->getMessage());

      }
   }
   /** @test */
   public function buscarProspectPorEmail(){
      $ctrlProspect = new ControllerProspect();
      $prospect = new Prospect();
      $email = 'paulo@eu.com.br';
      $arrayComparar = array();

      $conn = new \mysqli('localhost', 'root', '', 'bd_prospects');
      $sqlBusca = $conn->prepare("select cod_prospect, nome, email, celular,
                                          facebook, whatsapp
                                          from prospect
                                          where
                                          email = '$email'");
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
          $ctrlProspect->buscarProspects($email)
      );
   }
   /** @test */
   public function buscarTodosProspects(){
      $ctrlProspect = new ControllerProspect();
         $prospect = new Prospect();

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
         $ctrlProspect->buscarProspects()
      );
   }
}
?>