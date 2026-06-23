<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/movel.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/movel.php";

    $id = $_GET['id'];
    $dalMovel = new \DAL\Movel();
    $dalMovel->Delete($id);

    header("location: lstMovel.php");
?>