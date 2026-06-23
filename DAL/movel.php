<?php
    namespace DAL;

    class Movel {

        private $db;

        public function __construct() {
            $this->db = \DAL\Conexao::conectar();
        }

        // Retorna todos os móveis com nome da categoria
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

        // Retorna um móvel pelo ID
        public function SelectById(int $id) {
            $sql = $this->db->prepare(
                "SELECT * FROM movel WHERE id = :id"
            );
            $sql->bindValue(":id", $id);
            $sql->execute();
            $sql->setFetchMode(\PDO::FETCH_CLASS, '\MODEL\Movel');
            return $sql->fetch();
        }

        // Retorna os itens de um móvel com dados do produto
        // Usado na tela de detalhes para exibir a composição
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

        // Insere o móvel e seus itens, descontando o estoque de cada produto
        // Recebe o objeto movel e um array de itens [{id_produto, quantidade}]
        public function Insert(\MODEL\Movel $movel, array $itens) {

            // Insere o móvel principal
            $sql = $this->db->prepare(
                "INSERT INTO movel (descricao, id_categoria, preco_venda, data_cadastro, observacao)
                 VALUES (:descricao, :id_categoria, :preco_venda, :data_cadastro, :observacao)"
            );
            $sql->bindValue(":descricao",    $movel->getDescricao());
            $sql->bindValue(":id_categoria", $movel->getIdCategoria());
            $sql->bindValue(":preco_venda",  $movel->getPrecoVenda());
            $sql->bindValue(":data_cadastro",$movel->getDataCadastro());
            $sql->bindValue(":observacao",   $movel->getObservacao());
            $sql->execute();

            // Pega o ID do móvel recém inserido
            $id_movel = $this->db->lastInsertId();

            // Para cada item da composição...
            foreach ($itens as $item) {
                // Insere o item na tabela movel_item
                $sqlItem = $this->db->prepare(
                    "INSERT INTO movel_item (id_movel, id_produto, quantidade)
                     VALUES (:id_movel, :id_produto, :quantidade)"
                );
                $sqlItem->bindValue(":id_movel",   $id_movel);
                $sqlItem->bindValue(":id_produto",  $item['id_produto']);
                $sqlItem->bindValue(":quantidade",  $item['quantidade']);
                $sqlItem->execute();

                // Desconta a quantidade do estoque do produto
                // Usando o método BaixaEstoque da DAL de produto
                $sqlEstoque = $this->db->prepare(
                    "UPDATE produto SET
                        estoque_atual = estoque_atual - :quantidade
                     WHERE id = :id"
                );
                $sqlEstoque->bindValue(":quantidade", $item['quantidade']);
                $sqlEstoque->bindValue(":id",         $item['id_produto']);
                $sqlEstoque->execute();
            }
        }

        // Atualiza os dados do móvel — não altera os itens da composição
        public function Update(\MODEL\Movel $movel) {
        $sql = $this->db->prepare(
            "UPDATE movel SET
                descricao      = :descricao,
                id_categoria   = :id_categoria,
                preco_venda    = :preco_venda,
                data_cadastro  = :data_cadastro,
                observacao     = :observacao
            WHERE id = :id"
        );
        $sql->bindValue(":id",           $movel->getId());
        $sql->bindValue(":descricao",    $movel->getDescricao());
        $sql->bindValue(":id_categoria", $movel->getIdCategoria());
        $sql->bindValue(":preco_venda",  $movel->getPrecoVenda());
        $sql->bindValue(":data_cadastro",$movel->getDataCadastro());
        $sql->bindValue(":observacao",   $movel->getObservacao());
        $sql->execute();
        }   
        // Deleta um móvel e seus itens
        public function Delete(int $id) {
            // Primeiro remove os itens do móvel
            $sql = $this->db->prepare(
                "DELETE FROM movel_item WHERE id_movel = :id"
            );
            $sql->bindValue(":id", $id);
            $sql->execute();

            // Depois remove o móvel
            $sql = $this->db->prepare(
                "DELETE FROM movel WHERE id = :id"
            );
            $sql->bindValue(":id", $id);
            $sql->execute();
        }
        // Adiciona novos itens à composição sem apagar os existentes
        // Também desconta o estoque dos produtos adicionados
        public function AdicionarItens(int $id_movel, array $itens) {
            foreach ($itens as $item) {
            // Insere o novo item
            $sql = $this->db->prepare(
                "INSERT INTO movel_item (id_movel, id_produto, quantidade)
                VALUES (:id_movel, :id_produto, :quantidade)"
            );
            $sql->bindValue(":id_movel",  $id_movel);
            $sql->bindValue(":id_produto", $item['id_produto']);
            $sql->bindValue(":quantidade", $item['quantidade']);
            $sql->execute();

            // Desconta o estoque do produto adicionado
            $sqlEstoque = $this->db->prepare(
                "UPDATE produto SET
                    estoque_atual = estoque_atual - :quantidade
                WHERE id = :id"
            );
            $sqlEstoque->bindValue(":quantidade", $item['quantidade']);
            $sqlEstoque->bindValue(":id",         $item['id_produto']);
            $sqlEstoque->execute();
            }   
        }
    }
?>