<?php
// Inclui primeiro a conexão, depois o model, depois a DAL
include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/usuario.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/usuario.php";

// Captura os dados enviados pelo formulário via POST
$login = $_POST['login'];
$pwd   = $_POST['pwd'];

// Converte a senha para MD5
$md5 = md5($pwd);

// Se login ou senha estiverem vazios, volta para a tela de login
if ($login == "" || $pwd == "")
    header("location: index.php");

// Busca o usuário no banco pelo login digitado
$dalUsuario = new \DAL\Usuario();
$usuario    = $dalUsuario->SelectByLogin($login);

// Compara o MD5 da senha digitada com o MD5 salvo no banco
if ($md5 == $usuario->getSenha()) {
    // Senha correta — inicia a sessão e salva o login
    session_start();
    $_SESSION['login'] = $login;
    // Redireciona para o dashboard
    header("location: dashboard.php");
} else {
    // volta para a tela de login
    header("location: index.php");
}
?>