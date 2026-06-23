<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/fornecedor.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/fornecedor.php";

    // Captura os dados enviados pelo formulário via POST
    // trim() remove espaços em branco do início e fim
    $nome     = trim($_POST['nome']);
    $cnpj     = trim($_POST['cnpj']);
    $telefone = trim($_POST['telefone']);
    $email    = trim($_POST['email']);
    $cidade   = trim($_POST['cidade']);
    $uf       = trim($_POST['uf']);

    // Cria o objeto MODEL e preenche com os dados do formulário
    $fornecedor = new \MODEL\Fornecedor();
    $fornecedor->setNome($nome);
    $fornecedor->setCnpj($cnpj);
    $fornecedor->setTelefone($telefone);
    $fornecedor->setEmail($email);
    $fornecedor->setCidade($cidade);
    $fornecedor->setUf($uf);

    // Passa o objeto preenchido para a DAL inserir no banco
    $dalFornecedor = new \DAL\Fornecedor();
    $dalFornecedor->Insert($fornecedor);

    // Após inserir, redireciona para a listagem
    header("location: lstFornecedor.php");
?>