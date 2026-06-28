<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/usuario.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/usuario.php";

    $nome  = trim($_POST['nome']);
    $login = trim($_POST['login']);
    $senha = md5($_POST['senha']);

    $usuario = new \MODEL\Usuario();
    $usuario->setNome($nome);
    $usuario->setLogin($login);
    $usuario->setSenha($senha);

    $dalUsuario = new \DAL\Usuario();
    $dalUsuario->Insert($usuario);

    header("location: lstUsuario.php");
?>