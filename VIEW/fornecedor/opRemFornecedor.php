<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/fornecedor.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/fornecedor.php";

    // Captura o ID enviado via GET pelo botão de excluir da listagem
    $id = $_GET['id'];

    // Deleta o fornecedor do banco pelo ID
    $dalFornecedor = new \DAL\Fornecedor();
    $dalFornecedor->Delete($id);

    // Redireciona para a listagem
    header("location: lstFornecedor.php");
?>