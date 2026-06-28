<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/usuario.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/usuario.php";

$login = $_POST['login'];
$pwd   = $_POST['pwd'];

$md5 = md5($pwd);

if ($login == "" || $pwd == "")
    header("location: index.php");

$dalUsuario = new \DAL\Usuario();
$usuario    = $dalUsuario->SelectByLogin($login);

if ($md5 == $usuario->getSenha()) {
    session_start();
    $_SESSION['login'] = $login;
    header("location: dashboard.php");
} else {
    header("location: index.php");
}
?>