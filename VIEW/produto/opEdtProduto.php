<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/produto.php";

    $produto = new \MODEL\Produto();
    $produto->setId((int)$_POST['id']);
    $produto->setDescricao(trim($_POST['descricao']));
    $produto->setIdFornecedor((int)$_POST['id_fornecedor']);
    $produto->setIdCategoria((int)$_POST['id_categoria']);
    $produto->setPrecoCusto((float)$_POST['preco_custo']);
    $produto->setPrecoVenda((float)$_POST['preco_venda']);
    $produto->setEstoqueAtual((int)$_POST['estoque_atual']);
    $produto->setEstoqueMinimo((int)$_POST['estoque_minimo']);

    $dalProduto = new \DAL\Produto();
    $dalProduto->Update($produto);

    header("location: lstProduto.php");
?>