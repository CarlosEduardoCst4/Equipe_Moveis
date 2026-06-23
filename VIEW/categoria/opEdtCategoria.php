<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/categoria.php";

    // Captura todos os dados do formulário via POST
    // O ID veio do campo hidden do frmEdtFornecedor.php
    $id       = $_POST['id'];
    $descricao     = trim($_POST['descricao']);

    // Cria o objeto e preenche com os dados novos
    $categoria = new \MODEL\Categoria();
    $categoria->setId($id);
    $categoria->setDescricao($descricao);

    // Atualiza no banco
    $dalCategoria = new \DAL\Categoria();
    $dalCategoria->Update($categoria);

    // Redireciona para a listagem
    header("location: lstCategoria.php");
?>