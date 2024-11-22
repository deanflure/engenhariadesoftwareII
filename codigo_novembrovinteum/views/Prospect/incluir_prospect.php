<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Prospect</title>
    <!-- Inclua Bootstrap para agilizar -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Cabeçalho -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Home</a>
            <button class="btn btn-primary" id="btnCadastrarProspect">Cadastrar Prospect</button>
        </div>
    </nav>

    <!-- Div para exibir a tabela (oculta inicialmente) -->
    <div class="container mt-4" id="tabelaUsuarios" style="display: none;">
        <h4 class="mb-4">Lista de Usuários</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Celular</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Simulando dados vindos do banco de dados
                $usuarios = [
                    ['id' => 1, 'nome' => 'João Silva', 'email' => 'joao@email.com', 'celular' => '(11) 91234-5678'],
                    ['id' => 2, 'nome' => 'Maria Oliveira', 'email' => 'maria@email.com', 'celular' => '(21) 92345-6789'],
                    ['id' => 3, 'nome' => 'Carlos Santos', 'email' => 'carlos@email.com', 'celular' => '(31) 93456-7890'],
                ];

                foreach ($usuarios as $usuario) {
                    echo "<tr>
                            <td>{$usuario['id']}</td>
                            <td>{$usuario['nome']}</td>
                            <td>{$usuario['email']}</td>
                            <td>{$usuario['celular']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript para exibir a tabela -->
    <script>
        document.getElementById('btnCadastrarProspect').addEventListener('click', function () {
            const tabela = document.getElementById('tabelaUsuarios');
            tabela.style.display = tabela.style.display === 'none' ? 'block' : 'none';
        });
    </script>
</body>
</html>
