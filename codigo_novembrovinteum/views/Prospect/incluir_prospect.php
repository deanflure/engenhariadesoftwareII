<?php
session_start();
require_once '../../DAO/DAOUsuario.php';
// Inicializa o DAOUsuario e lista os usuários cadastrados
$daoUsuario = new \DAO\DAOUsuario();
$usuarios = $daoUsuario->listarUsuarios();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Prospect</title>
    <link rel="stylesheet" href="../../libs/bootstrap/css/bootstrap.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: black;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
        }
        .header a:hover {
            text-decoration: underline;
        }
        .container {
            margin: 20px auto;
            max-width: 1000px;
        }
    </style>
</head>
<body>
    <!-- Cabeçalho -->
    <div class="header">
        <div>
            <h2>Cadastro de Prospect</h2>
        </div>
        <div>
            <a href="../../index.php">Home</a>
            <a href="incluir_prospect.php">Cadastrar Prospect</a>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="container">
        <h3 class="mb-4">Lista de Usuários Cadastrados</h3>
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Login</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['id']) ?></td>
                            <td><?= htmlspecialchars($usuario['nome']) ?></td>
                            <td><?= htmlspecialchars($usuario['email']) ?></td>
                            <td><?= htmlspecialchars($usuario['login']) ?></td>
                            <td>
                                <a href="editar_usuario.php?id=<?= $usuario['id'] ?>" class="btn btn-sm btn-warning">Alterar</a>
                                <a href="../../controllers/excluir_usuario.php?id=<?= $usuario['id'] ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhum usuário encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
