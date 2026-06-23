<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Novo Fornecedor — Equipe Móveis</title>
    <link rel="icon" href="/equipe-moveis/images/fundo-login.jpg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>
<body>

    <?php include_once "../menu.php"; ?>

    <div class="container" style="margin-top: 30px;">
        <h5>Novo Fornecedor</h5>

        <!-- action aponta para o arquivo que vai processar o formulário -->
        <!-- method POST — dados vão no corpo da requisição -->
        <form action="opInsFornecedor.php" method="POST">
            <div class="row">
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">business</i>
                    <!-- required — validação HTML, campo obrigatório -->
                    <input id="nome" type="text" name="nome" required maxlength="35">
                    <label for="nome">Nome *</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">badge</i>
                    <input id="cnpj" type="text" name="cnpj" required maxlength="18"
                           placeholder="00.000.000/0000-00">
                    <label for="cnpj" class="active">CNPJ *</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">phone</i>
                    <input id="telefone" type="text" name="telefone" required maxlength="15">
                    <label for="telefone">Telefone *</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">email</i>
                    <input id="email" type="email" name="email" required maxlength="50">
                    <label for="email">E-mail *</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m8">
                    <i class="material-icons prefix">location_city</i>
                    <input id="cidade" type="text" name="cidade" required maxlength="35">
                    <label for="cidade">Cidade *</label>
                </div>
                <div class="input-field col s12 m4">
                    <i class="material-icons prefix">map</i>
                    <!-- select do Materialize para escolher o estado -->
                    <select name="uf" id="uf" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="AC">AC</option><option value="AL">AL</option>
                        <option value="AM">AM</option><option value="BA">BA</option>
                        <option value="CE">CE</option><option value="DF">DF</option>
                        <option value="ES">ES</option><option value="GO">GO</option>
                        <option value="MA">MA</option><option value="MG">MG</option>
                        <option value="MS">MS</option><option value="MT">MT</option>
                        <option value="PA">PA</option><option value="PB">PB</option>
                        <option value="PE">PE</option><option value="PI">PI</option>
                        <option value="PR">PR</option><option value="RJ">RJ</option>
                        <option value="RN">RN</option><option value="RO">RO</option>
                        <option value="RR">RR</option><option value="RS">RS</option>
                        <option value="SC">SC</option><option value="SE">SE</option>
                        <option value="SP">SP</option><option value="TO">TO</option>
                    </select>
                    <label for="uf">Estado *</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button class="btn waves-effect waves-light" type="submit">
                        <i class="material-icons left">save</i>Salvar
                    </button>
                    <!-- Botão cancelar volta para a listagem sem salvar -->
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