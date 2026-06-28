<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/movel.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/movel.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/produto.php";

    $id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);

    if ($id === 0) {
        header("location: lstMovel.php");
        exit;
    }
    $dalMovel   = new \DAL\Movel();
    $movel      = $dalMovel->SelectById($id);
    $categorias = (new \DAL\Categoria())->SelectAll();
    $produtos   = (new \DAL\Produto())->SelectAll();
    $itens      = $dalMovel->SelectItens($id);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Móvel — Equipe Móveis</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>
<body>
    <?php include_once "../menu.php"; ?>

    <div class="container" style="margin-top: 30px;">
        <h5>Editar Móvel</h5>

        <?php if (!empty($_SESSION['erro'])): ?>
            <div class="card-panel red lighten-4" style="border-left: 4px solid #c62828; color: #c62828;">
            <i class="material-icons tiny">error</i>
        <?= $_SESSION['erro'] ?>
    </div>
        <?php unset($_SESSION['erro']); ?>
        <?php endif; ?>

        <form action="opEdtMovel.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $movel->getId(); ?>">

            <div class="row">
                <div class="input-field col s12 m8">
                    <i class="material-icons prefix">chair</i>
                    <input id="descricao" type="text" name="descricao" required maxlength="60"
                           value="<?php echo $movel->getDescricao(); ?>">
                    <label for="descricao" class="active">Descrição *</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m4">
                    <i class="material-icons prefix">category</i>
                    <select name="id_categoria" required>
                        <option value="" disabled>Selecione</option>
                        <?php foreach ($categorias as $c):
                            $sel = ($c->getId() == $movel->getIdCategoria()) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $c->getId(); ?>" <?php echo $sel; ?>>
                                <?php echo $c->getDescricao(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label class="active">Categoria *</label>
                </div>
                <div class="input-field col s12 m4">
                    <i class="material-icons prefix">sell</i>
                    <input id="preco_venda" type="number" step="0.01" min="0"
                           name="preco_venda" required
                           value="<?php echo $movel->getPrecoVenda(); ?>">
                    <label for="preco_venda" class="active">Preço de Venda *</label>
                </div>
                <div class="input-field col s12 m4">
                    <i class="material-icons prefix">calendar_today</i>
                    <input id="data_cadastro" type="date" name="data_cadastro" required
                           value="<?php echo $movel->getDataCadastro(); ?>">
                    <label for="data_cadastro" class="active">Data *</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">notes</i>
                    <input id="observacao" type="text" name="observacao" maxlength="255"
                           value="<?php echo $movel->getObservacao(); ?>">
                    <label for="observacao" class="active">Observação</label>
                </div>
            </div>
            <h6 style="color:#85B7EB; margin-top:10px;">
                <i class="material-icons tiny">build</i> Composição atual
            </h6>
            <?php if (count($itens) > 0): ?>
            <table class="striped responsive-table" style="margin-bottom: 16px;">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade utilizada</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($itens as $item): ?>
                    <tr>
                        <td><?php echo $item->nome_produto; ?></td>
                        <td><?php echo $item->quantidade; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p style="color:#85B7EB;font-size:12px;margin-bottom:16px;">Nenhum item na composição.</p>
            <?php endif; ?>

            <h6 style="color:#85B7EB; margin-top:10px;">
                <i class="material-icons tiny">add_circle</i> Adicionar novos materiais
            </h6>
            <p style="font-size:12px; color:#85B7EB; margin-bottom: 10px;">
                Os novos materiais serão adicionados à composição e o estoque será descontado.
            </p>

            <div id="itens-container">
                <div class="row item-linha">
                    <div class="input-field col s12 m8">
                        <select name="id_produto[]">
                            <option value="" selected>Nenhum (não adicionar)</option>
                            <?php foreach ($produtos as $p): ?>
                                <option value="<?php echo $p->id; ?>">
                                    <?php echo $p->descricao; ?>
                                    (estoque: <?php echo $p->estoque_atual; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label>Produto</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input type="number" name="quantidade[]" min="1" placeholder="Qtd" value="0">
                        <label class="active">Quantidade</label>
                    </div>
                    <div class="col s12 m1 valign-wrapper" style="margin-top: 20px;">
                        <button type="button" class="btn-small red btn-remover-item">
                            <i class="material-icons">remove</i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="button" id="btn-add-item" class="btn waves-effect waves-light grey darken-1">
                <i class="material-icons left">add</i>Adicionar Produto
            </button>

            <div class="row" style="margin-top: 20px;">
                <div class="col s12">
                    <button class="btn waves-effect waves-light" type="submit">
                        <i class="material-icons left">save</i>Salvar
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
        var linhaBase = document.querySelector('.item-linha').outerHTML;

        document.getElementById('btn-add-item').addEventListener('click', function() {
            var container = document.getElementById('itens-container');
            var div = document.createElement('div');
            div.innerHTML = linhaBase;
            container.appendChild(div.firstChild);
            var selects = container.querySelectorAll('select');
            M.FormSelect.init(selects);
        });

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