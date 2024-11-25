<?php
namespace DAO;

mysqli_report(MYSQLI_REPORT_STRICT);

$separador = DIRECTORY_SEPARATOR;
$root = $_SERVER['DOCUMENT_ROOT'] . $separador;

require($root . 'codigo_novembrovinteum/models/Usuario.php');

use models\Usuario;

class DAOUsuario {
    /**
     * Faz o login no sistema validando os dados fornecidos pelo usuário
     * @param string $login Login do usuário
     * @param string $senha Senha do usuário
     * @return Usuario
     */
    public function logar($login, $senha) {
        try {
            $conexaoDB = $this->conectarBanco();
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        $usuario = new Usuario();

        $sql = $conexaoDB->prepare("SELECT login, nome, email, celular FROM usuario WHERE login = ? AND senha = ?");
        $sql->bind_param("ss", $login, $senha);
        $sql->execute();

        $resultado = $sql->get_result();
        if ($resultado->num_rows === 0) {
            $usuario->addUsuario(null, null, null, null, FALSE);
        } else {
            while ($linha = $resultado->fetch_assoc()) {
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
     * @param string $senha Senha do usuário
     * @return TRUE|Exception TRUE para inclusão bem-sucedida ou Exception para falha
     */
    public function incluirUsuario($nome, $email, $login, $senha) {
        try {
            $conexaoDB = $this->conectarBanco();
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        $sqlInsert = $conexaoDB->prepare("INSERT INTO usuario (nome, email, login, senha) VALUES (?, ?, ?, ?)");
        $sqlInsert->bind_param("ssss", $nome, $email, $login, $senha);
        $sqlInsert->execute();

        if (!$sqlInsert->error) {
            $retorno = TRUE;
        } else {
            throw new \Exception("Não foi possível incluir novo usuário!");
        }

        $sqlInsert->close();
        $conexaoDB->close();
        return $retorno;
    }

    /**
     * Lista todos os usuários do banco de dados
     * @return array Lista de usuários
     */
    public function listarUsuarios() {
        try {
            $conexaoDB = $this->conectarBanco();
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        $sql = "SELECT id, nome, email, login FROM usuario";
        $resultado = $conexaoDB->query($sql);

        $usuarios = [];
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {
                $usuarios[] = $linha;
            }
        }

        $conexaoDB->close();
        return $usuarios;
    }

    /**
     * Exclui um usuário pelo ID
     * @param int $id ID do usuário a ser excluído
     * @return bool TRUE em caso de sucesso, ou Exception em caso de falha
     */
    public function excluirUsuario($id) {
        try {
            $conexaoDB = $this->conectarBanco();
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        $sqlDelete = $conexaoDB->prepare("DELETE FROM usuario WHERE id = ?");
        $sqlDelete->bind_param("i", $id);
        $sqlDelete->execute();

        if ($sqlDelete->affected_rows > 0) {
            $retorno = TRUE;
        } else {
            throw new \Exception("Erro ao excluir usuário. ID não encontrado.");
        }

        $sqlDelete->close();
        $conexaoDB->close();
        return $retorno;
    }

    /**
     * Atualiza os dados de um usuário
     * @param int $id ID do usuário
     * @param string $nome Nome do usuário
     * @param string $email Email do usuário
     * @return bool TRUE em caso de sucesso, ou Exception em caso de falha
     */
    public function atualizarUsuario($id, $nome, $email) {
        try {
            $conexaoDB = $this->conectarBanco();
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        $sqlUpdate = $conexaoDB->prepare("UPDATE usuario SET nome = ?, email = ? WHERE id = ?");
        $sqlUpdate->bind_param("ssi", $nome, $email, $id);
        $sqlUpdate->execute();

        if ($sqlUpdate->affected_rows > 0) {
            $retorno = TRUE;
        } else {
            throw new \Exception("Erro ao atualizar usuário. Verifique os dados informados.");
        }

        $sqlUpdate->close();
        $conexaoDB->close();
        return $retorno;
    }

    /**
     * Método para conectar ao banco de dados
     * @return \mysqli Conexão com o banco de dados
     */
    private function conectarBanco() {
        $separador = DIRECTORY_SEPARATOR;
        $root = $_SERVER['DOCUMENT_ROOT'] . $separador;

        require($root . 'prospectcolector/DAO/configdb.php');

        try {
            $conn = new \mysqli($dbhost, $user, $password, $banco);
            if ($conn->connect_error) {
                throw new \Exception("Erro de conexão: " . $conn->connect_error);
            }
            return $conn;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }
}
?>

