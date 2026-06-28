<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/usuario.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/usuario.php";

    $id    = $_POST['id'];
    $nome  = trim($_POST['nome']);
    $login = trim($_POST['login']);
    $senha = $_POST['senha'];

    if ($senha != '') {
        $senha = md5($senha);
    } else {
        $dalUsuario  = new \DAL\Usuario();
        $usuarioAtual = $dalUsuario->SelectById($id);
        $senha        = $usuarioAtual->getSenha();
    }

    $usuario = new \MODEL\Usuario();
    $usuario->setId($id);
    $usuario->setNome($nome);
    $usuario->setLogin($login);
    $usuario->setSenha($senha);

    $dalUsuario = new \DAL\Usuario();
    $dalUsuario->Update($usuario);

    header("location: lstUsuario.php");
?>