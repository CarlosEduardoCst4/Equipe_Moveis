<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/usuario.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/usuario.php";

    $dalUsuario = new \DAL\Usuario();
    $usuarios   = $dalUsuario->SelectAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários — Equipe Móveis</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>
<body>
    <?php include_once "../menu.php"; ?>

    <div class="container" style="margin-top: 30px;">
        <div class="row valign-wrapper">
            <div class="col s6">
                <h5>Usuários</h5>
            </div>
            <div class="col s6 right-align">
                <a href="frmInsUsuario.php" class="btn waves-effect waves-light">
                    <i class="material-icons left">add</i>Novo Usuário
                </a>
            </div>
        </div>

        <table class="striped responsive-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Login</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?php echo $u->getNome(); ?></td>
                    <td><?php echo $u->getLogin(); ?></td>
                    <td>
                        <!-- Detalhes -->
                        <form action="detUsuario.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $u->getId(); ?>">
                            <button type="submit" class="btn-small waves-effect waves-light blue darken-2">
                                <i class="material-icons">visibility</i>
                            </button>
                        </form>
                        <!-- Editar -->
                        <form action="frmEdtUsuario.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $u->getId(); ?>">
                            <button type="submit" class="btn-small waves-effect waves-light">
                                <i class="material-icons">edit</i>
                            </button>
                        </form>
                        <!-- Excluir -->
                        <form action="opRemUsuario.php" method="POST" style="display:inline;"
                              onsubmit="return confirm('Deseja excluir este usuário?')">
                            <input type="hidden" name="id" value="<?php echo $u->getId(); ?>">
                            <button type="submit" class="btn-small red waves-effect waves-light">
                                <i class="material-icons">delete</i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="/equipe-moveis/VIEW/js/init.js"></script>
</body>
</html>