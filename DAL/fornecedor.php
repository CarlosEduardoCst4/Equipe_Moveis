<?php
    namespace DAL;

    class Fornecedor {

        private $db;

        public function __construct() {
            $this->db = \DAL\Conexao::conectar();
        }

        public function SelectAll() {
            $sql = $this->db->prepare(
                "SELECT * FROM fornecedor ORDER BY nome"
            );
            $sql->execute();

            $sql->setFetchMode(
                \PDO::FETCH_CLASS, '\MODEL\Fornecedor'
            );

            return $sql->fetchAll();
        }

        public function SelectById(int $id) {
            $sql = $this->db->prepare(
                "SELECT * FROM fornecedor WHERE id = :id"
            );
            $sql->bindValue(":id", $id);
            $sql->execute();

            $sql->setFetchMode(
                \PDO::FETCH_CLASS, '\MODEL\Fornecedor'
            );

            return $sql->fetch();
        }

        public function Insert(\MODEL\Fornecedor $fornecedor) {
            $sql = $this->db->prepare(
                "INSERT INTO fornecedor (nome, cnpj, telefone, email, cidade, uf)
                 VALUES (:nome, :cnpj, :telefone, :email, :cidade, :uf)"
            );

            $sql->bindValue(":nome",     $fornecedor->getNome());
            $sql->bindValue(":cnpj",     $fornecedor->getCnpj());
            $sql->bindValue(":telefone", $fornecedor->getTelefone());
            $sql->bindValue(":email",    $fornecedor->getEmail());
            $sql->bindValue(":cidade",   $fornecedor->getCidade());
            $sql->bindValue(":uf",       $fornecedor->getUf());

            $sql->execute();
        }

        public function Update(\MODEL\Fornecedor $fornecedor) {
            $sql = $this->db->prepare(
                "UPDATE fornecedor SET
                    nome     = :nome,
                    cnpj     = :cnpj,
                    telefone = :telefone,
                    email    = :email,
                    cidade   = :cidade,
                    uf       = :uf
                 WHERE id = :id"
            );

            $sql->bindValue(":id",       $fornecedor->getId());
            $sql->bindValue(":nome",     $fornecedor->getNome());
            $sql->bindValue(":cnpj",     $fornecedor->getCnpj());
            $sql->bindValue(":telefone", $fornecedor->getTelefone());
            $sql->bindValue(":email",    $fornecedor->getEmail());
            $sql->bindValue(":cidade",   $fornecedor->getCidade());
            $sql->bindValue(":uf",       $fornecedor->getUf());

            $sql->execute();
        }

        public function Delete(int $id) {
            $sql = $this->db->prepare(
                "DELETE FROM fornecedor WHERE id = :id"
            );
            $sql->bindValue(":id", $id);
            $sql->execute();
        }
    }
?>