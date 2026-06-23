<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/produto.php";

    // Exclusão lógica — marca ativo = 0 em vez de deletar
    $id = $_POST['id'];
    $dalProduto = new \DAL\Produto();
    $dalProduto->Delete($id);

    header("location: lstProduto.php");
?>