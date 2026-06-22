<?php
    // Inicia a sessão para verificar se o usuário está logado
    session_start();

    // Se não tiver sessão ativa, redireciona para o login
    // Essa verificação deve estar no topo de TODAS as páginas protegidas
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — Equipe Móveis</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>
<body>

    <?php include_once "menu.php"; ?>

    <div class="container" style="margin-top: 30px;">
        <h5>Bem-vindo, <?php echo $_SESSION['login']; ?>!</h5>
        <p>Dashboard em construção...</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="/equipe-moveis/VIEW/js/init.js"></script>
</body>
</html>