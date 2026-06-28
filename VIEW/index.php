<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/equipe-moveis/images/Whats_logo.jpeg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Login — Equipe Móveis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>

<body>

    <div class="container">
        <div class="row" style="margin-top: 80px;">
            <div class="col s12 m6 offset-m3">

                <div class="card">
                    <div class="card-content center-align">

                        <img src="/equipe-moveis/images/Whats_logo.jpeg" alt="Logo" style="max-width: 155px;">
                        <br>

                        <form action="login.php" method="POST">

                            <div class="input-field">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="login" type="text" name="login" class="validate" required>
                                <label for="login">Login</label>
                            </div>
                            <div class="input-field">
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