<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/fornecedor.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/fornecedor.php";

    // Captura todos os dados do formulário via POST
    // O ID veio do campo hidden do frmEdtFornecedor.php
    $id       = $_POST['id'];
    $nome     = trim($_POST['nome']);
    $cnpj     = trim($_POST['cnpj']);
    $telefone = trim($_POST['telefone']);
    $email    = trim($_POST['email']);
    $cidade   = trim($_POST['cidade']);
    $uf       = trim($_POST['uf']);

    // Cria o objeto e preenche com os dados novos
    $fornecedor = new \MODEL\Fornecedor();
    $fornecedor->setId($id);
    $fornecedor->setNome($nome);
    $fornecedor->setCnpj($cnpj);
    $fornecedor->setTelefone($telefone);
    $fornecedor->setEmail($email);
    $fornecedor->setCidade($cidade);
    $fornecedor->setUf($uf);

    // Atualiza no banco
    $dalFornecedor = new \DAL\Fornecedor();
    $dalFornecedor->Update($fornecedor);

    // Redireciona para a listagem
    header("location: lstFornecedor.php");
?>