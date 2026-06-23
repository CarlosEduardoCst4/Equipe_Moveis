<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/categoria.php";

    $dalCategoria = new \DAL\Categoria();
    $categorias   = $dalCategoria->SelectAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Categorias — Equipe Móveis</title>
    <link rel="icon" href="/equipe-moveis/images/logo.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>
<body>
    <?php include_once "../menu.php"; ?>

    <div class="container" style="margin-top: 30px;">
        <div class="row valign-wrapper">
            <div class="col s6">
                <h5>Categorias</h5>
            </div>
            <div class="col s6 right-align">
                <a href="frmInsCategoria.php" class="btn waves-effect waves-light">
                    <i class="material-icons left">add</i>Nova Categoria
                </a>
            </div>
        </div>

        <table class="striped responsive-table">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $c) { ?>
                <tr>
                    <td><?php echo $c->getDescricao(); ?></td>
                    <td>
                        <a href="frmEdtCategoria.php?id=<?php echo $c->getId(); ?>" class="btn-small waves-effect waves-light">
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="opRemCategoria.php?id=<?php echo $c->getId(); ?>"
                           class="btn-small red waves-effect waves-light"
                           onclick="return confirm('Deseja excluir esta categoria?')">
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