<?php
    namespace DAL;

    class Dashboard {

        private $db;

        public function __construct() {
            $this->db = \DAL\Conexao::conectar();
        }

        // Total de produtos ativos cadastrados
        public function TotalProdutos() {
            $sql = $this->db->prepare(
                "SELECT COUNT(*) AS total FROM produto WHERE ativo = 1"
            );
            $sql->execute();
            return $sql->fetch(\PDO::FETCH_OBJ)->total;
        }

        // Produtos com estoque abaixo ou igual ao mínimo
        public function ProdutosEstoqueBaixo() {
            $sql = $this->db->prepare(
                "SELECT COUNT(*) AS total FROM produto
                 WHERE ativo = 1 AND estoque_atual <= estoque_minimo"
            );
            $sql->execute();
            return $sql->fetch(\PDO::FETCH_OBJ)->total;
        }

        // Produtos com estoque zerado
        public function ProdutosZerados() {
            $sql = $this->db->prepare(
                "SELECT COUNT(*) AS total FROM produto
                 WHERE ativo = 1 AND estoque_atual = 0"
            );
            $sql->execute();
            return $sql->fetch(\PDO::FETCH_OBJ)->total;
        }

        // Total de móveis cadastrados
        public function TotalMoveis() {
            $sql = $this->db->prepare(
                "SELECT COUNT(*) AS total FROM movel"
            );
            $sql->execute();
            return $sql->fetch(\PDO::FETCH_OBJ)->total;
        }

        // Total de fornecedores cadastrados
        public function TotalFornecedores() {
            $sql = $this->db->prepare(
                "SELECT COUNT(*) AS total FROM fornecedor"
            );
            $sql->execute();
            return $sql->fetch(\PDO::FETCH_OBJ)->total;
        }

        // Lista os 5 produtos com estoque mais crítico
        public function ProdutosCriticos() {
            $sql = $this->db->prepare(
                "SELECT p.descricao, p.estoque_atual, p.estoque_minimo,
                        c.descricao AS categoria
                 FROM produto p
                 INNER JOIN categoria c ON c.id = p.id_categoria
                 WHERE p.ativo = 1 AND p.estoque_atual <= p.estoque_minimo
                 ORDER BY p.estoque_atual ASC
                 LIMIT 5"
            );
            $sql->execute();
            return $sql->fetchAll(\PDO::FETCH_OBJ);
        }

        // Lista os 5 últimos móveis cadastrados
        public function UltimosMoveis() {
            $sql = $this->db->prepare(
                "SELECT m.descricao, m.data_cadastro, m.preco_venda,
                        c.descricao AS categoria
                 FROM movel m
                 INNER JOIN categoria c ON c.id = m.id_categoria
                 ORDER BY m.data_cadastro DESC, m.id DESC
                 LIMIT 5"
            );
            $sql->execute();
            return $sql->fetchAll(\PDO::FETCH_OBJ);
        }
    }
?>