<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/categoria.php";

    $id = $_POST['id'];

    $dalCategoria = new \DAL\Categoria();
    $dalCategoria->Delete($id);

    header("location: lstCategoria.php");
?>