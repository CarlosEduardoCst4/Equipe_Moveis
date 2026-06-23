<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/categoria.php";

    $descricao = trim($_POST['descricao']);

    $categoria = new \MODEL\Categoria();
    $categoria->setDescricao($descricao);

    $dalCategoria = new \DAL\Categoria();
    $dalCategoria->Insert($categoria);

    header("location: lstCategoria.php");
?>