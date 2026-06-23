<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/fornecedor.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/fornecedor.php";

    // Captura o ID enviado via GET pela listagem (ex: ?id=3)
    $id = $_GET['id'];

    // Busca os dados atuais do fornecedor pelo ID para pré-preencher o formulário
    $dalFornecedor = new \DAL\Fornecedor();
    $fornecedor    = $dalFornecedor->SelectById($id);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Fornecedor — Equipe Móveis</title>
    <link rel="icon" href="/equipe-moveis/images/fundo-login.jpg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>
<body>

    <?php include_once "../menu.php"; ?>

    <div class="container" style="margin-top: 30px;">
        <h5>Editar Fornecedor</h5>

        <form action="opEdtFornecedor.php" method="POST">

            <!-- Campo oculto — passa o ID para o opEdtFornecedor saber qual registro alterar -->
            <!-- O usuário não vê esse campo mas ele é enviado junto com o formulário -->
            <input type="hidden" name="id" value="<?php echo $fornecedor->getId(); ?>">

            <div class="row">
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">business</i>
                    <!-- value pré-preenche o campo com o dado atual do banco -->
                    <input id="nome" type="text" name="nome" required maxlength="35"
                           value="<?php echo $fornecedor->getNome(); ?>">
                    <label for="nome" class="active">Nome *</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">badge</i>
                    <input id="cnpj" type="text" name="cnpj" required maxlength="18"
                           value="<?php echo $fornecedor->getCnpj(); ?>">
                    <label for="cnpj" class="active">CNPJ *</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">phone</i>
                    <input id="telefone" type="text" name="telefone" required maxlength="15"
                           value="<?php echo $fornecedor->getTelefone(); ?>">
                    <label for="telefone" class="active">Telefone *</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">email</i>
                    <input id="email" type="email" name="email" required maxlength="50"
                           value="<?php echo $fornecedor->getEmail(); ?>">
                    <label for="email" class="active">E-mail *</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m8">
                    <i class="material-icons prefix">location_city</i>
                    <input id="cidade" type="text" name="cidade" required maxlength="35"
                           value="<?php echo $fornecedor->getCidade(); ?>">
                    <label for="cidade" class="active">Cidade *</label>
                </div>
                <div class="input-field col s12 m4">
                    <i class="material-icons prefix">map</i>
                    <select name="uf" id="uf" required>
                        <option value="" disabled>Selecione</option>
                        <?php
                            // Array com todos os estados
                            $estados = ['AC','AL','AM','BA','CE','DF','ES','GO','MA',
                                        'MG','MS','MT','PA','PB','PE','PI','PR','RJ',
                                        'RN','RO','RR','RS','SC','SE','SP','TO'];
                            foreach ($estados as $estado) {
                                // selected marca o estado atual do fornecedor no select
                                $sel = ($estado == $fornecedor->getUf()) ? 'selected' : '';
                                echo "<option value='$estado' $sel>$estado</option>";
                            }
                        ?>
                    </select>
                    <label for="uf" class="active">Estado *</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button class="btn waves-effect waves-light" type="submit">
                        <i class="material-icons left">save</i>Salvar
                    </button>
                    <a href="lstFornecedor.php" class="btn waves-effect waves-light grey darken-1" style="margin-left: 8px;">
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