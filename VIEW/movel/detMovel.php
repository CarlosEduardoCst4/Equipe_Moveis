<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/movel.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/movel.php";

    $id = $_POST['id'];
    $dalMovel = new \DAL\Movel();
    $movel    = $dalMovel->SelectById($id);
    // Busca os itens da composição do móvel
    $itens    = $dalMovel->SelectItens($id);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalhes do Móvel — Equipe Móveis</title>
    <link rel="icon" href="/equipe-moveis/images/logo.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>
<body>
    <?php include_once "../menu.php"; ?>

    <div class="container" style="margin-top: 30px;">
        <h5>Detalhes do Móvel</h5>

        <div class="card">
            <div class="card-content">
                <p><strong>Descrição:</strong> <?php echo $movel->getDescricao(); ?></p>
                <p><strong>Preço de Venda:</strong> R$ <?php echo number_format($movel->getPrecoVenda(), 2, ',', '.'); ?></p>
                <p><strong>Data de Cadastro:</strong> <?php echo date('d/m/Y', strtotime($movel->getDataCadastro())); ?></p>
                <p><strong>Observação:</strong> <?php echo $movel->getObservacao(); ?></p>
            </div>
        </div>

        <h6 style="color: #85B7EB; margin-top: 20px;">Composição</h6>
        <table class="striped responsive-table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade utilizada</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($itens as $item) { ?>
                <tr>
                    <td><?php echo $item->nome_produto; ?></td>
                    <td><?php echo $item->quantidade; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="lstMovel.php" class="btn waves-effect waves-light grey darken-1" style="margin-top: 20px;">
            <i class="material-icons left">arrow_back</i>Voltar
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="/equipe-moveis/VIEW/js/init.js"></script>
</body>
</html>