<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/fornecedor.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/fornecedor.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/categoria.php";

    $fornecedores = (new \DAL\Fornecedor())->SelectAll();
    $categorias   = (new \DAL\Categoria())->SelectAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Novo Produto — Equipe Móveis</title>
    <link rel="icon" href="/equipe-moveis/images/logo.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>
<body>
    <?php include_once "../menu.php"; ?>

    <div class="container" style="margin-top: 30px;">
        <h5>Novo Produto</h5>
        <?php if (!empty($_SESSION['erro'])): ?>
    <div class="card-panel red lighten-4" style="border-left: 4px solid #c62828; color: #c62828;">
        <i class="material-icons tiny">error</i>
        <?= $_SESSION['erro'] ?>
    </div>
    <?php unset($_SESSION['erro']); ?>
<?php endif; ?>

        <form action="opInsProduto.php" method="POST">
            <div class="row">
                <div class="input-field col s12 m8">
                    <i class="material-icons prefix">inventory_2</i>
                    <input id="descricao" type="text" name="descricao" required maxlength="60">
                    <label for="descricao">Descrição *</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">category</i>
                    <select name="id_categoria" required>
                        <option value="" disabled selected>Selecione a categoria</option>
                        <?php foreach ($categorias as $c) { ?>
                            <option value="<?php echo $c->getId(); ?>">
                                <?php echo $c->getDescricao(); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <label>Categoria *</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">local_shipping</i>
                    <select name="id_fornecedor" required>
                        <option value="" disabled selected>Selecione o fornecedor</option>
                        <?php foreach ($fornecedores as $f) { ?>
                            <option value="<?php echo $f->getId(); ?>">
                                <?php echo $f->getNome(); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <label>Fornecedor *</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m3">
                    <i class="material-icons prefix">attach_money</i>
                    <input id="preco_custo" type="number" step="0.01" min="0"
                           name="preco_custo" required>
                    <label for="preco_custo">Preço de Custo *</label>
                </div>
                <div class="input-field col s12 m3">
                    <i class="material-icons prefix">sell</i>
                    <input id="preco_venda" type="number" step="0.01" min="0"
                           name="preco_venda" required>
                    <label for="preco_venda">Preço de Venda *</label>
                </div>
                <div class="input-field col s12 m3">
                    <i class="material-icons prefix">warehouse</i>
                    <input id="estoque_atual" type="number" min="0"
                           name="estoque_atual" required>
                    <label for="estoque_atual">Estoque Atual *</label>
                </div>
                <div class="input-field col s12 m3">
                    <i class="material-icons prefix">warning</i>
                    <input id="estoque_minimo" type="number" min="0"
                           name="estoque_minimo" required>
                    <label for="estoque_minimo">Estoque Mínimo *</label>
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