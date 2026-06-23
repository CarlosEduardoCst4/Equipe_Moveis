<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/movel.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/movel.php";

    $movel = new \MODEL\Movel();
    $movel->setId((int)$_POST['id']);
    $movel->setDescricao(trim($_POST['descricao']));
    $movel->setIdCategoria((int)$_POST['id_categoria']);
    $movel->setPrecoVenda((float)$_POST['preco_venda']);
    $movel->setDataCadastro($_POST['data_cadastro']);
    $movel->setObservacao(trim($_POST['observacao'] ?? ''));

    // Monta array só com itens que foram preenchidos
    // Ignora linhas onde o produto ficou como "Nenhum"
    $itensNovos = [];
    foreach ($_POST['id_produto'] as $i => $id_produto) {
        if (!empty($id_produto) && !empty($_POST['quantidade'][$i]) && $_POST['quantidade'][$i] > 0) {
            $itensNovos[] = [
                'id_produto' => (int)$id_produto,
                'quantidade' => (int)$_POST['quantidade'][$i]
            ];
        }
    }

    $dalMovel = new \DAL\Movel();
    $dalMovel->Update($movel);

    // Se tiver novos itens, adiciona sem apagar os antigos
    if (!empty($itensNovos)) {
        $dalMovel->AdicionarItens((int)$_POST['id'], $itensNovos);
    }

    header("location: lstMovel.php");
?>