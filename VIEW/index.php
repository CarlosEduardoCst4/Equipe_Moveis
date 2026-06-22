<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Ícone que aparece na aba do navegador -->
    <link rel="icon" href="/equipe-moveis/images/logo.png">

    <!-- Material Icons — biblioteca de ícones do Google usada pelo Materialize -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Login — Equipe Móveis</title>

    <!-- Materialize CSS — framework de interface que vamos usar no projeto -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- CSS personalizado do projeto — onde colocaremos o visual dark azul -->
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>

<body>

    <!-- Container principal da tela de login -->
    <div class="container">
        <div class="row" style="margin-top: 80px;">
            <div class="col s12 m6 offset-m3">

                <!-- Card centralizado com o formulário -->
                <div class="card">
                    <div class="card-content center-align">

                        <!-- Título do sistema -->
                        <h5>Equipe Móveis</h5>
                        <p class="grey-text">Controle de Estoque</p>
                        <br>

                        <!-- Formulário de login
                             action="login.php" — envia os dados para o login.php processar
                             method="POST" — os dados vão no corpo da requisição (não aparecem na URL) -->
                        <form action="login.php" method="POST">

                            <!-- login -->
                            <div class="input-field">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="login" type="text" name="login" class="validate" required>
                                <label for="login">Login</label>
                            </div>

                            <!--senha-->
                            <div class="input-field">
                                <!-- esconde os caracteres digitados -->
                                <i class="material-icons prefix">lock</i>
                                <input id="pwd" type="password" name="pwd" class="validate" required>
                                <label for="pwd">Senha</label>
                            </div>

                            <br>

                            <button class="btn waves-effect waves-light" type="submit">
                                Entrar
                                <i class="material-icons right">login</i>
                            </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script src="/equipe-moveis/VIEW/js/init.js"></script>

</body>

</html>