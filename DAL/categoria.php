<?php
    namespace DAL;

    class Categoria {

        private $db;

        public function __construct() {
            $this->db = \DAL\Conexao::conectar();
        }

        public function SelectAll() {
            $sql = $this->db->prepare(
                "SELECT * FROM categoria ORDER BY descricao"
            );
            $sql->execute();
            $sql->setFetchMode(
                \PDO::FETCH_CLASS, '\MODEL\Categoria'
            );

            return $sql->fetchAll();
        }

        public function SelectById(int $id) {
            $sql = $this->db->prepare(
                "SELECT * FROM categoria WHERE id = :id"
            );
            $sql->bindValue(":id", $id);
            $sql->execute();

            $sql->setFetchMode(
                \PDO::FETCH_CLASS, '\MODEL\Categoria'
            );

            return $sql->fetch();
        }

        public function Insert(\MODEL\Categoria $categoria) {
            $sql = $this->db->prepare(
                "INSERT INTO categoria (descricao)
                 VALUES (:descricao)"
            );

            $sql->bindValue(":descricao",     $categoria->getDescricao());

            $sql->execute();
        }

        public function Update(\MODEL\Categoria $categoria) {
            $sql = $this->db->prepare(
                "UPDATE categoria SET
                    descricao     = :descricao
                 WHERE id = :id"
            );

            $sql->bindValue(":id",       $categoria->getId());
            $sql->bindValue(":descricao",     $categoria->getDescricao());

            $sql->execute();
        }

        public function Delete(int $id) {
            $sql = $this->db->prepare(
                "DELETE FROM categoria WHERE id = :id"
            );
            $sql->bindValue(":id", $id);
            $sql->execute();
        }
    }
?>