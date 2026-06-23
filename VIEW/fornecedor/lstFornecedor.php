<?php
    // Verifica se o usuário está logado
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    // Inclui a conexão e os arquivos necessários para buscar os fornecedores
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/fornecedor.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/fornecedor.php";

    // Cria o objeto DAL e busca todos os fornecedores do banco
    $dalFornecedor = new \DAL\Fornecedor();
    $fornecedores  = $dalFornecedor->SelectAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fornecedores — Equipe Móveis</title>
    <link rel="icon" href="/equipe-moveis/images/fundo-login.jpg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>
<body>

    <?php include_once "../menu.php"; ?>

    <div class="container" style="margin-top: 30px;">

        <div class="row valign-wrapper">
            <div class="col s6">
                <h5>Fornecedores</h5>
            </div>
            <div class="col s6 right-align">
                <!-- Botão para ir ao formulário de cadastro -->
                <a href="frmInsFornecedor.php" class="btn waves-effect waves-light">
                    <i class="material-icons left">add</i>Novo Fornecedor
                </a>
            </div>
        </div>

        <table class="striped responsive-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Telefone</th>
                    <th>Cidade</th>
                    <th>UF</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Percorre o array de fornecedores e exibe cada um na tabela
                    foreach ($fornecedores as $f) {
                ?>
                <tr>
                    <td><?php echo $f->getNome(); ?></td>
                    <td><?php echo $f->getCnpj(); ?></td>
                    <td><?php echo $f->getTelefone(); ?></td>
                    <td><?php echo $f->getCidade(); ?></td>
                    <td><?php echo $f->getUf(); ?></td>
                    <td>
                        <!-- Passa o ID via GET para o formulário de edição -->
                        <a href="frmEdtFornecedor.php?id=<?php echo $f->getId(); ?>" class="btn-small waves-effect waves-light">
                            <i class="material-icons">edit</i>
                        </a>
                        <!-- Passa o ID via GET para a operação de exclusão -->
                        <a href="opRemFornecedor.php?id=<?php echo $f->getId(); ?>"
                           class="btn-small red waves-effect waves-light"
                           onclick="return confirm('Deseja excluir este fornecedor?')">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="/equipe-moveis/VIEW/js/init.js"></script>
</body>
</html>