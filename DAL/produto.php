<?php
    namespace DAL;

    class Produto {

        private $db;

        public function __construct() {
            $this->db = \DAL\Conexao::conectar();
        }

        // Retorna todos os produtos ativos com nome do fornecedor e categoria
        // O JOIN traz os nomes em vez dos IDs para exibir na listagem
        public function SelectAll() {
            $sql = $this->db->prepare(
                "SELECT p.*, f.nome AS nome_fornecedor, c.descricao AS nome_categoria
                 FROM produto p
                 INNER JOIN fornecedor f ON f.id = p.id_fornecedor
                 INNER JOIN categoria c  ON c.id = p.id_categoria
                 WHERE p.ativo = 1
                 ORDER BY p.descricao"
            );
            $sql->execute();
            return $sql->fetchAll(\PDO::FETCH_OBJ);
        }

        // Retorna um produto pelo ID — usado no formulário de edição
        public function SelectById(int $id) {
            $sql = $this->db->prepare(
                "SELECT * FROM produto WHERE id = :id"
            );
            $sql->bindValue(":id", $id);
            $sql->execute();
            $sql->setFetchMode(\PDO::FETCH_CLASS, '\MODEL\Produto');
            return $sql->fetch();
        }

        // Insere um novo produto
        public function Insert(\MODEL\Produto $produto) {
            $sql = $this->db->prepare(
                "INSERT INTO produto
                    (descricao, id_fornecedor, id_categoria, preco_custo, preco_venda, estoque_atual, estoque_minimo, ativo)
                 VALUES
                    (:descricao, :id_fornecedor, :id_categoria, :preco_custo, :preco_venda, :estoque_atual, :estoque_minimo, 1)"
            );
            $sql->bindValue(":descricao",      $produto->getDescricao());
            $sql->bindValue(":id_fornecedor",  $produto->getIdFornecedor());
            $sql->bindValue(":id_categoria",   $produto->getIdCategoria());
            $sql->bindValue(":preco_custo",    $produto->getPrecoCusto());
            $sql->bindValue(":preco_venda",    $produto->getPrecoVenda());
            $sql->bindValue(":estoque_atual",  $produto->getEstoqueAtual());
            $sql->bindValue(":estoque_minimo", $produto->getEstoqueMinimo());
            $sql->execute();
        }

        // Atualiza os dados do produto
        public function Update(\MODEL\Produto $produto) {
            $sql = $this->db->prepare(
                "UPDATE produto SET
                    descricao      = :descricao,
                    id_fornecedor  = :id_fornecedor,
                    id_categoria   = :id_categoria,
                    preco_custo    = :preco_custo,
                    preco_venda    = :preco_venda,
                    estoque_atual  = :estoque_atual,
                    estoque_minimo = :estoque_minimo
                 WHERE id = :id"
            );
            $sql->bindValue(":id",             $produto->getId());
            $sql->bindValue(":descricao",      $produto->getDescricao());
            $sql->bindValue(":id_fornecedor",  $produto->getIdFornecedor());
            $sql->bindValue(":id_categoria",   $produto->getIdCategoria());
            $sql->bindValue(":preco_custo",    $produto->getPrecoCusto());
            $sql->bindValue(":preco_venda",    $produto->getPrecoVenda());
            $sql->bindValue(":estoque_atual",  $produto->getEstoqueAtual());
            $sql->bindValue(":estoque_minimo", $produto->getEstoqueMinimo());
            $sql->execute();
        }

        // Exclusão lógica — marca como inativo em vez de deletar
        // Isso preserva o histórico do produto em notas fiscais antigas
        public function Delete(int $id) {
            $sql = $this->db->prepare(
                "UPDATE produto SET ativo = 0 WHERE id = :id"
            );
            $sql->bindValue(":id", $id);
            $sql->execute();
        }

        // Desconta quantidade do estoque — usado ao cadastrar móvel
        public function BaixaEstoque(int $id, int $quantidade) {
            $sql = $this->db->prepare(
                "UPDATE produto SET
                    estoque_atual = estoque_atual - :quantidade
                 WHERE id = :id"
            );
            $sql->bindValue(":id",         $id);
            $sql->bindValue(":quantidade", $quantidade);
            $sql->execute();
        }
    }
?>