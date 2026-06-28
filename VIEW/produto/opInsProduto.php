<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/produto.php";

    $estoqueAtual  = (int)$_POST['estoque_atual'];
    $estoqueMinimo = (int)$_POST['estoque_minimo'];

    if ($estoqueAtual < 0) {
        $_SESSION['erro'] = "O estoque atual não pode ser menor que zero.";
        header("location: frmInsProduto.php");
        exit;
    }

    if ($estoqueMinimo < 0) {
        $_SESSION['erro'] = "O estoque mínimo não pode ser menor que zero.";
        header("location: frmInsProduto.php");
        exit;
    }

    $produto = new \MODEL\Produto();
    $produto->setDescricao(trim($_POST['descricao']));
    $produto->setIdFornecedor((int)$_POST['id_fornecedor']);
    $produto->setIdCategoria((int)$_POST['id_categoria']);
    $produto->setPrecoCusto((float)$_POST['preco_custo']);
    $produto->setPrecoVenda((float)$_POST['preco_venda']);
    $produto->setEstoqueAtual($estoqueAtual);
    $produto->setEstoqueMinimo($estoqueMinimo);

    $dalProduto = new \DAL\Produto();
    $dalProduto->Insert($produto);

    header("location: lstProduto.php");
    exit;
?>