<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/categoria.php";

    $id       = $_POST['id'];
    $descricao     = trim($_POST['descricao']);

    $categoria = new \MODEL\Categoria();
    $categoria->setId($id);
    $categoria->setDescricao($descricao);

    $dalCategoria = new \DAL\Categoria();
    $dalCategoria->Update($categoria);

    header("location: lstCategoria.php");
?>