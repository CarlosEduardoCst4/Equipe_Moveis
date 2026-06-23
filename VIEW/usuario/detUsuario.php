<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/usuario.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/usuario.php";

    $id         = $_GET['id'];
    $dalUsuario = new \DAL\Usuario();
    $usuario    = $dalUsuario->SelectById($id);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalhes do Usuário — Equipe Móveis</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>
<body>
    <?php include_once "../menu.php"; ?>

    <div class="container" style="margin-top: 30px;">
        <h5>Detalhes do Usuário</h5>

        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 m4">
                        <p style="color:#378ADD;font-size:11px;text-transform:uppercase;letter-spacing:.5px;">Nome</p>
                        <p style="font-size:16px;"><?php echo $usuario->getNome(); ?></p>
                    </div>
                    <div class="col s12 m4">
                        <p style="color:#378ADD;font-size:11px;text-transform:uppercase;letter-spacing:.5px;">Login</p>
                        <p style="font-size:16px;"><?php echo $usuario->getLogin(); ?></p>
                    </div>
                    <div class="col s12 m4">
                        <p style="color:#378ADD;font-size:11px;text-transform:uppercase;letter-spacing:.5px;">Senha</p>
                        <!-- Exibe *** por padrão, ao clicar revela o hash MD5 -->
                        <p style="font-size:16px;">
                            <span id="senha-display">••••••••</span>
                            <button type="button" id="btn-mostrar-senha"
                                onclick="toggleSenha()"
                                style="background:none;border:none;cursor:pointer;margin-left:8px;">
                                <i class="material-icons" id="icone-senha"
                                   style="font-size:18px;color:#378ADD;vertical-align:middle;">
                                   visibility
                                </i>
                            </button>
                        </p>
                        <!-- Senha hash MD5 — oculta no HTML por padrão -->
                        <span id="senha-real" style="display:none;">
                            <?php echo $usuario->getSenha(); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 10px;">
            <a href="frmEdtUsuario.php?id=<?php echo $usuario->getId(); ?>"
               class="btn waves-effect waves-light">
                <i class="material-icons left">edit</i>Editar
            </a>
            <a href="lstUsuario.php"
               class="btn waves-effect waves-light grey darken-1" style="margin-left: 8px;">
                <i class="material-icons left">arrow_back</i>Voltar
            </a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="/equipe-moveis/VIEW/js/init.js"></script>
    <script>
        // Alterna entre mostrar e ocultar a senha
        function toggleSenha() {
            var display = document.getElementById('senha-display');
            var real    = document.getElementById('senha-real').textContent.trim();
            var icone   = document.getElementById('icone-senha');

            if (display.textContent === '••••••••') {
                // Revela o hash MD5
                display.textContent = real;
                icone.textContent   = 'visibility_off';
            } else {
                // Oculta novamente
                display.textContent = '••••••••';
                icone.textContent   = 'visibility';
            }
        }
    </script>
</body>
</html>