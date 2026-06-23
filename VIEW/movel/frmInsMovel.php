<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/produto.php";

    $categorias = (new \DAL\Categoria())->SelectAll();
    $produtos   = (new \DAL\Produto())->SelectAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Novo Móvel — Equipe Móveis</title>
    <link rel="icon" href="/equipe-moveis/images/logo.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>
<body>
    <?php include_once "../menu.php"; ?>

    <div class="container" style="margin-top: 30px;">
        <h5>Novo Móvel</h5>

        <form action="opInsMovel.php" method="POST">
            <div class="row">
                <div class="input-field col s12 m8">
                    <i class="material-icons prefix">chair</i>
                    <input id="descricao" type="text" name="descricao" required maxlength="60">
                    <label for="descricao">Descrição *</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m4">
                    <i class="material-icons prefix">category</i>
                    <select name="id_categoria" required>
                        <option value="" disabled selected>Selecione</option>
                        <?php foreach ($categorias as $c) { ?>
                            <option value="<?php echo $c->getId(); ?>">
                                <?php echo $c->getDescricao(); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <label>Categoria *</label>
                </div>
                <div class="input-field col s12 m4">
                    <i class="material-icons prefix">sell</i>
                    <input id="preco_venda" type="number" step="0.01" min="0"
                           name="preco_venda" required>
                    <label for="preco_venda">Preço de Venda *</label>
                </div>
                <div class="input-field col s12 m4">
                    <i class="material-icons prefix">calendar_today</i>
                    <input id="data_cadastro" type="date" name="data_cadastro" required
                           value="<?php echo date('Y-m-d'); ?>">
                    <label for="data_cadastro" class="active">Data *</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">notes</i>
                    <input id="observacao" type="text" name="observacao" maxlength="255">
                    <label for="observacao">Observação</label>
                </div>
            </div>

            <!-- Seção de itens da composição do móvel -->
            <h6 style="margin-top: 20px; color: #85B7EB;">
                <i class="material-icons tiny">build</i> Composição do Móvel
            </h6>
            <p style="font-size: 12px; color: #85B7EB;">
                Adicione os materiais usados — o estoque será descontado automaticamente.
            </p>

            <div id="itens-container">
                <!-- Linha de item — será duplicada pelo JS ao clicar em + -->
                <div class="row item-linha">
                    <div class="input-field col s12 m8">
                        <select name="id_produto[]" required>
                            <option value="" disabled selected>Selecione o produto</option>
                            <?php foreach ($produtos as $p) { ?>
                                <option value="<?php echo $p->id; ?>">
                                    <?php echo $p->descricao; ?>
                                    (estoque: <?php echo $p->estoque_atual; ?>)
                                </option>
                            <?php } ?>
                        </select>
                        <label>Produto *</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input type="number" name="quantidade[]" min="1" required placeholder="Qtd">
                        <label class="active">Quantidade *</label>
                    </div>
                    <div class="col s12 m1 valign-wrapper" style="margin-top: 20px;">
                        <!-- Botão remover linha — só aparece se tiver mais de uma linha -->
                        <button type="button" class="btn-small red btn-remover-item">
                            <i class="material-icons">remove</i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Botão para adicionar mais produtos à composição -->
            <button type="button" id="btn-add-item" class="btn waves-effect waves-light grey darken-1">
                <i class="material-icons left">add</i>Adicionar Produto
            </button>

            <div class="row" style="margin-top: 20px;">
                <div class="col s12">
                    <button class="btn waves-effect waves-light" type="submit">
                        <i class="material-icons left">save</i>Salvar Móvel
                    </button>
                    <a href="lstMovel.php" class="btn waves-effect waves-light grey darken-1" style="margin-left: 8px;">
                        <i class="material-icons left">cancel</i>Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="/equipe-moveis/VIEW/js/init.js"></script>
    <script>
        // Guarda o HTML da primeira linha de item para duplicar
        var linhaBase = document.querySelector('.item-linha').outerHTML;

        // Ao clicar em + Adicionar Produto, duplica a linha
        document.getElementById('btn-add-item').addEventListener('click', function() {
            var container = document.getElementById('itens-container');
            var div = document.createElement('div');
            div.innerHTML = linhaBase;
            container.appendChild(div.firstChild);
            // Reinicializa os selects do Materialize na nova linha
            var selects = container.querySelectorAll('select');
            M.FormSelect.init(selects);
        });

        // Ao clicar no botão remover, remove a linha — mantém pelo menos 1
        document.getElementById('itens-container').addEventListener('click', function(e) {
            if (e.target.closest('.btn-remover-item')) {
                var linhas = document.querySelectorAll('.item-linha');
                if (linhas.length > 1) {
                    e.target.closest('.item-linha').remove();
                }
            }
        });
    </script>
</body>
</html>