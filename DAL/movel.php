<?php
    namespace DAL;

    require_once __DIR__ . '/Produto.php';

    class Movel {

        private $db;

        public function __construct() {
            $this->db = \DAL\Conexao::conectar();
        }

        public function SelectAll() {
            $sql = $this->db->prepare(
                "SELECT m.*, c.descricao AS nome_categoria
                 FROM movel m
                 INNER JOIN categoria c ON c.id = m.id_categoria
                 ORDER BY m.descricao"
            );
            $sql->execute();
            return $sql->fetchAll(\PDO::FETCH_OBJ);
        }

        public function SelectById(int $id) {
            $sql = $this->db->prepare(
                "SELECT * FROM movel WHERE id = :id"
            );
            $sql->bindValue(":id", $id);
            $sql->execute();
            $sql->setFetchMode(\PDO::FETCH_CLASS, '\MODEL\Movel');
            return $sql->fetch();
        }

        public function SelectItens(int $id_movel) {
            $sql = $this->db->prepare(
                "SELECT mi.*, p.descricao AS nome_produto
                 FROM movel_item mi
                 INNER JOIN produto p ON p.id = mi.id_produto
                 WHERE mi.id_movel = :id_movel"
            );
            $sql->bindValue(":id_movel", $id_movel);
            $sql->execute();
            return $sql->fetchAll(\PDO::FETCH_OBJ);
        }

        public function Insert(\MODEL\Movel $movel, array $itens) {

    // Bloqueia se não tiver nenhum item
    if (empty($itens)) {
        return 'sem_itens';
    }

    $sql = $this->db->prepare(
        "INSERT INTO movel (descricao, id_categoria, preco_venda, data_cadastro, observacao)
         VALUES (:descricao, :id_categoria, :preco_venda, :data_cadastro, :observacao)"
    );
    $sql->bindValue(":descricao",     $movel->getDescricao());
    $sql->bindValue(":id_categoria",  $movel->getIdCategoria());
    $sql->bindValue(":preco_venda",   $movel->getPrecoVenda());
    $sql->bindValue(":data_cadastro", $movel->getDataCadastro());
    $sql->bindValue(":observacao",    $movel->getObservacao());
    $sql->execute();

    $id_movel = $this->db->lastInsertId();
    $dalProduto = new \DAL\Produto();

    foreach ($itens as $item) {
        if (!$dalProduto->BaixaEstoque($item['id_produto'], $item['quantidade'])) {
            return 'estoque_insuficiente';
        }

        $sqlItem = $this->db->prepare(
            "INSERT INTO movel_item (id_movel, id_produto, quantidade)
             VALUES (:id_movel, :id_produto, :quantidade)"
        );
        $sqlItem->bindValue(":id_movel",  $id_movel);
        $sqlItem->bindValue(":id_produto", $item['id_produto']);
        $sqlItem->bindValue(":quantidade", $item['quantidade']);
        $sqlItem->execute();
    }

    return 'ok';
}

        public function Update(\MODEL\Movel $movel) {
            $sql = $this->db->prepare(
                "UPDATE movel SET
                    descricao     = :descricao,
                    id_categoria  = :id_categoria,
                    preco_venda   = :preco_venda,
                    data_cadastro = :data_cadastro,
                    observacao    = :observacao
                WHERE id = :id"
            );
            $sql->bindValue(":id",            $movel->getId());
            $sql->bindValue(":descricao",     $movel->getDescricao());
            $sql->bindValue(":id_categoria",  $movel->getIdCategoria());
            $sql->bindValue(":preco_venda",   $movel->getPrecoVenda());
            $sql->bindValue(":data_cadastro", $movel->getDataCadastro());
            $sql->bindValue(":observacao",    $movel->getObservacao());
            $sql->execute();
        }

        public function Delete(int $id) {
            $sql = $this->db->prepare(
                "DELETE FROM movel_item WHERE id_movel = :id"
            );
            $sql->bindValue(":id", $id);
            $sql->execute();

            $sql = $this->db->prepare(
                "DELETE FROM movel WHERE id = :id"
            );
            $sql->bindValue(":id", $id);
            $sql->execute();
        }

        public function AdicionarItens(int $id_movel, array $itens) {

    if (empty($itens)) {
        return 'sem_itens';
    }

    $dalProduto = new \DAL\Produto();

    foreach ($itens as $item) {
        if (!$dalProduto->BaixaEstoque($item['id_produto'], $item['quantidade'])) {
            return 'estoque_insuficiente';
        }

        $sql = $this->db->prepare(
            "INSERT INTO movel_item (id_movel, id_produto, quantidade)
             VALUES (:id_movel, :id_produto, :quantidade)"
        );
        $sql->bindValue(":id_movel",  $id_movel);
        $sql->bindValue(":id_produto", $item['id_produto']);
        $sql->bindValue(":quantidade", $item['quantidade']);
        $sql->execute();
    }

    return 'ok';
}
    }
?>