<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/movel.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/movel.php";

    // Monta o objeto Movel com os dados do formulário
    $movel = new \MODEL\Movel();
    $movel->setDescricao(trim($_POST['descricao']));
    $movel->setIdCategoria((int)$_POST['id_categoria']);
    $movel->setPrecoVenda((float)$_POST['preco_venda']);
    $movel->setDataCadastro($_POST['data_cadastro']);
    $movel->setObservacao(trim($_POST['observacao'] ?? ''));

    // Monta o array de itens a partir dos arrays id_produto[] e quantidade[]
    // O PHP recebe arrays quando o name do input termina com []
    $itens = [];
    foreach ($_POST['id_produto'] as $i => $id_produto) {
        if (!empty($id_produto) && !empty($_POST['quantidade'][$i])) {
            $itens[] = [
                'id_produto' => (int)$id_produto,
                'quantidade' => (int)$_POST['quantidade'][$i]
            ];
        }
    }

    // Insere o móvel e desconta o estoque
    $dalMovel = new \DAL\Movel();
    $dalMovel->Insert($movel, $itens);

    header("location: lstMovel.php");
?>