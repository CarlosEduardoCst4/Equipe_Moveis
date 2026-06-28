<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/fornecedor.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/fornecedor.php";


    $nome     = trim($_POST['nome']);
    $cnpj     = trim($_POST['cnpj']);
    $telefone = trim($_POST['telefone']);
    $email    = trim($_POST['email']);
    $cidade   = trim($_POST['cidade']);
    $uf       = trim($_POST['uf']);

    $fornecedor = new \MODEL\Fornecedor();
    $fornecedor->setNome($nome);
    $fornecedor->setCnpj($cnpj);
    $fornecedor->setTelefone($telefone);
    $fornecedor->setEmail($email);
    $fornecedor->setCidade($cidade);
    $fornecedor->setUf($uf);

    $dalFornecedor = new \DAL\Fornecedor();
    $dalFornecedor->Insert($fornecedor);

    header("location: lstFornecedor.php");
?>