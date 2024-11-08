<?php
namespace test;
require_once('../libs/vendor/autoload.php');
require_once('../models/Usuario.php');
require_once('../DAO/DAOUsuario.php');
use PHPUnit\Framework\TestCase;
use models\Usuario;
use dao\DAOUsuario;

class UsuarioTest extends TestCase{

   /** @test */
   public function testLogar(){
      $daoUsuario = new DAOUsuario();
      $usuario = new Usuario();

      $usuario->addUsuario("paulo", "Paulo Roberto Córdova", "paulo@eu.com", "(99)9999-9999", TRUE);
      $this->assertEquals(
         $usuario,
         $daoUsuario->logar('paulo', '123')
      );


      unset($usuario);
      unset($daoUsuario);
   }
    /** @test */
   public function testIncluirUsuario(){
      $daoUsuario = new DAOUsuario();
      $this->assertEquals(
         TRUE,
         $daoUsuario->incluirUsuario("raul", "raul@gmail.com", "raul", "raul")
      );
      unset($usuario);
   }
}
?>