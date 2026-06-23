<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/fornecedor.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/fornecedor.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/categoria.php";

    $id = $_POST['id'];
    $produto    = (new \DAL\Produto())->SelectById($id);
    $fornecedores = (new \DAL\Fornecedor())->SelectAll();
    $categorias   = (new \DAL\Categoria())->SelectAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Produto — Equipe Móveis</title>
    <link rel="icon" href="/equipe-moveis/images/logo.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>
<body>
    <?php include_once "../menu.php"; ?>

    <div class="container" style="margin-top: 30px;">
        <h5>Editar Produto</h5>

        <form action="opEdtProduto.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $produto->getId(); ?>">

            <div class="row">
                <div class="input-field col s12 m8">
                    <i class="material-icons prefix">inventory_2</i>
                    <input id="descricao" type="text" name="descricao" required maxlength="60"
                           value="<?php echo $produto->getDescricao(); ?>">
                    <label for="descricao" class="active">Descrição *</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">category</i>
                    <select name="id_categoria" required>
                        <option value="" disabled>Selecione a categoria</option>
                        <?php foreach ($categorias as $c) {
                            $sel = ($c->getId() == $produto->getIdCategoria()) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $c->getId(); ?>" <?php echo $sel; ?>>
                                <?php echo $c->getDescricao(); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <label class="active">Categoria *</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">local_shipping</i>
                    <select name="id_fornecedor" required>
                        <option value="" disabled>Selecione o fornecedor</option>
                        <?php foreach ($fornecedores as $f) {
                            $sel = ($f->getId() == $produto->getIdFornecedor()) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $f->getId(); ?>" <?php echo $sel; ?>>
                                <?php echo $f->getNome(); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <label class="active">Fornecedor *</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m3">
                    <i class="material-icons prefix">attach_money</i>
                    <input id="preco_custo" type="number" step="0.01" min="0"
                           name="preco_custo" required
                           value="<?php echo $produto->getPrecoCusto(); ?>">
                    <label for="preco_custo" class="active">Preço de Custo *</label>
                </div>
                <div class="input-field col s12 m3">
                    <i class="material-icons prefix">sell</i>
                    <input id="preco_venda" type="number" step="0.01" min="0"
                           name="preco_venda" required
                           value="<?php echo $produto->getPrecoVenda(); ?>">
                    <label for="preco_venda" class="active">Preço de Venda *</label>
                </div>
                <div class="input-field col s12 m3">
                    <i class="material-icons prefix">warehouse</i>
                    <input id="estoque_atual" type="number" min="0"
                           name="estoque_atual" required
                           value="<?php echo $produto->getEstoqueAtual(); ?>">
                    <label for="estoque_atual" class="active">Estoque Atual *</label>
                </div>
                <div class="input-field col s12 m3">
                    <i class="material-icons prefix">warning</i>
                    <input id="estoque_minimo" type="number" min="0"
                           name="estoque_minimo" required
                           value="<?php echo $produto->getEstoqueMinimo(); ?>">
                    <label for="estoque_minimo" class="active">Estoque Mínimo *</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button class="btn waves-effect waves-light" type="submit">
                        <i class="material-icons left">save</i>Salvar
                    </button>
                    <a href="lstProduto.php" class="btn waves-effect waves-light grey darken-1" style="margin-left: 8px;">
                        <i class="material-icons left">cancel</i>Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="/equipe-moveis/VIEW/js/init.js"></script>
</body>
</html>