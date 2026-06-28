<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/MODEL/movel.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/movel.php";

    $movel = new \MODEL\Movel();
    $movel->setDescricao(trim($_POST['descricao']));
    $movel->setIdCategoria((int)$_POST['id_categoria']);
    $movel->setPrecoVenda((float)$_POST['preco_venda']);
    $movel->setDataCadastro($_POST['data_cadastro']);
    $movel->setObservacao(trim($_POST['observacao'] ?? ''));

    $itens = [];
    foreach ($_POST['id_produto'] as $i => $id_produto) {
        if (!empty($id_produto) && !empty($_POST['quantidade'][$i])) {
            $itens[] = [
                'id_produto' => (int)$id_produto,
                'quantidade' => (int)$_POST['quantidade'][$i]
            ];
        }
    }

    $dalMovel = new \DAL\Movel();
    $resultado = $dalMovel->Insert($movel, $itens);

    if ($resultado === 'ok') {
        header("location: lstMovel.php");
        exit;
    } elseif ($resultado === 'sem_itens') {
        $_SESSION['erro'] = "Adicione pelo menos um material ao móvel.";
    } elseif ($resultado === 'estoque_insuficiente') {
        $_SESSION['erro'] = "Quantidade solicitada acima do estoque disponível.";
    }

    header("location: " . $_SERVER['HTTP_REFERER']);
    exit;
?>