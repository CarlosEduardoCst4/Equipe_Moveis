<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/categoria.php";

    $dalProduto = new \DAL\Produto();
    $produtos   = $dalProduto->SelectAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produtos — Equipe Móveis</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>
<body>
    <?php include_once "../menu.php"; ?>

    <div class="container" style="margin-top: 30px;">
        <div class="row valign-wrapper">
            <div class="col s6">
                <h5>Produtos</h5>
            </div>
            <div class="col s6 right-align">
                <a href="frmInsProduto.php" class="btn waves-effect waves-light">
                    <i class="material-icons left">add</i>Novo Produto
                </a>
                <a href="/equipe-moveis/VIEW/CATEGORIA/lstCategoria.php" class="btn waves-effect waves-light">
                <i class="material-icons left">local_offer</i>Categorias
                </a>
            </div>
        </div>

        <table class="striped responsive-table">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Fornecedor</th>
                    <th>Preço Custo</th>
                    <th>Preço Venda</th>
                    <th>Estoque</th>
                    <th>Mín.</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $p) { ?>
                <tr>
                    <td><?php echo $p->descricao; ?></td>
                    <td><?php echo $p->nome_categoria; ?></td>
                    <td><?php echo $p->nome_fornecedor; ?></td>
                    <td>R$ <?php echo number_format($p->preco_custo, 2, ',', '.'); ?></td>
                    <td>R$ <?php echo number_format($p->preco_venda, 2, ',', '.'); ?></td>
                    <td>
                        <?php
                            // Alerta visual se estoque estiver abaixo do mínimo
                            if ($p->estoque_atual <= $p->estoque_minimo) {
                                echo '<span style="color:#F09595">' . $p->estoque_atual . ' ⚠</span>';
                            } else {
                                echo $p->estoque_atual;
                            }
                        ?>
                    </td>
                    <td><?php echo $p->estoque_minimo; ?></td>
                    <td>
                        <a href="frmEdtProduto.php?id=<?php echo $p->id; ?>"
                           class="btn-small waves-effect waves-light">
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="opRemProduto.php?id=<?php echo $p->id; ?>"
                           class="btn-small red waves-effect waves-light"
                           onclick="return confirm('Deseja desativar este produto?')">
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