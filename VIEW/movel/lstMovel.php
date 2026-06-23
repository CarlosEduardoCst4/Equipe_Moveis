<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/movel.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/movel.php";

    $dalMovel = new \DAL\Movel();
    $moveis   = $dalMovel->SelectAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Móveis — Equipe Móveis</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>
<body>
    <?php include_once "../menu.php"; ?>

    <div class="container" style="margin-top: 30px;">
        <div class="row valign-wrapper">
            <div class="col s6">
                <h5>Móveis</h5>
            </div>
            <div class="col s6 right-align">
                <a href="frmInsMovel.php" class="btn waves-effect waves-light">
                    <i class="material-icons left">add</i>Novo Móvel
                </a>
            </div>
        </div>

        <table class="striped responsive-table">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Preço Venda</th>
                    <th>Data Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($moveis as $m): ?>
                <tr>
                    <td><?php echo $m->descricao; ?></td>
                    <td><?php echo $m->nome_categoria; ?></td>
                    <td>R$ <?php echo number_format($m->preco_venda, 2, ',', '.'); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($m->data_cadastro)); ?></td>
                    <td>
                        <!-- Ver detalhes -->
                        <form action="detMovel.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $m->id; ?>">
                            <button type="submit" class="btn-small waves-effect waves-light blue darken-2">
                                <i class="material-icons">visibility</i>
                            </button>
                        </form>
                        <!-- Editar -->
                        <form action="frmEdtMovel.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $m->id; ?>">
                            <button type="submit" class="btn-small waves-effect waves-light">
                                <i class="material-icons">edit</i>
                            </button>
                        </form>
                        <!-- Excluir -->
                        <form action="opRemMovel.php" method="POST" style="display:inline;"
                              onsubmit="return confirm('Deseja excluir este móvel?')">
                            <input type="hidden" name="id" value="<?php echo $m->id; ?>">
                            <button type="submit" class="btn-small red waves-effect waves-light">
                                <i class="material-icons">delete</i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="/equipe-moveis/VIEW/js/init.js"></script>
</body>
</html>