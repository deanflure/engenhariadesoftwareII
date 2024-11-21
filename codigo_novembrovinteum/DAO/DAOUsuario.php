<?php
namespace DAO;

mysqli_report(MYSQLI_REPORT_STRICT);

$separador = DIRECTORY_SEPARATOR;
$root = $_SERVER['DOCUMENT_ROOT'].$separador;

require($root . 'prospectcolector/models/Usuario.php');

use models\Usuario;

/**
 * Esta classe é reponsável por fazer a comunicação com o banco de dados,
 * provendo as funções de logar e incluir um novo usuário
 *
 * @author Paulo Roberto Córdova
 *
 */
class DAOUsuario{
   /**
    * Faz o login no sisema validando os dados fornecidos pelo usuário
    * @param string $login Login do usuário
    * @param string $senha Senha do usuário
    * @return Usuario
    */
   public function logar($login, $senha){
       try {
         $conexaoDB = $this->conectarBanco();
      } catch (\Exception $e) {
         die($e->getMessage());
      }

      $usuario = new Usuario();

      $sql = $conexaoDB->prepare("select login, nome, email, celular from usuario
                                  where
                                  login = ?
                                  and
                                  senha = ?");
      $sql->bind_param("ss", $login, $senha);
      $sql->execute();

      $resultado = $sql->get_result();
      if($resultado->num_rows === 0){
         $usuario->addUsuario(null, null, null, null, FALSE);
      }else{
         While($linha = $resultado->fetch_assoc()){
            $usuario->addUsuario($linha['login'], $linha['nome'], $linha['email'], $linha['celular'], TRUE);
         }
      }
      $sql->close();
      $conexaoDB->close();
      return $usuario;
   }
   /**
    * Inclui um novo usuário no banco de dados
    * @param string $nome Nome do usuário
    * @param string $email Email do usuário
    * @param string $login Login do usuário
    * @param string $senha senha do usuário
    * @return TRUE|Exception TRUE para inclusão bem sucedida ou Exception para inclusão mal sucedida
    */
   public function incluirUsuario($nome, $email, $login, $senha){
       try {
         $conexaoDB = $this->conectarBanco();
      } catch (\Exception $e) {
         die($e->getMessage());
      }

      $sqlInsert = $conexaoDB->prepare("insert into usuario
                                       (nome, email, login, senha)
                                       values
                                       (?, ?, ?, ?)");
      $sqlInsert->bind_param("ssss", $nome, $email, $login, $senha);
      $sqlInsert->execute();

      if(!$sqlInsert->error){
         $retorno =  TRUE;
      }else{
         throw new \Exception("Não foi possível incluir novo usuário!");
         die;
      }
      $conexaoDB->close();
      $sqlInsert->close();
      return $retorno;
   }

   private function conectarBanco(){
     $separador = DIRECTORY_SEPARATOR;
     $root = $_SERVER['DOCUMENT_ROOT'].$separador;

      require($root . 'prospectcolector/DAO/configdb.php');

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