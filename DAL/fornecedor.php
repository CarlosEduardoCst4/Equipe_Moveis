<?php
    namespace DAL;

    class Fornecedor {

        private $db;

        // Construtor já conecta ao banco
        public function __construct() {
            $this->db = \DAL\Conexao::conectar();
        }

        // ---- SELECT ALL ----
        // Retorna todos os fornecedores ordenados por nome
        // Usado na listagem lstFornecedor.php
        public function SelectAll() {
            $sql = $this->db->prepare(
                "SELECT * FROM fornecedor ORDER BY nome"
            );
            $sql->execute();

            // FETCH_CLASS — o PDO já preenche os atributos da classe MODEL
            // automaticamente, sem precisar chamar os setters manualmente
            $sql->setFetchMode(
                \PDO::FETCH_CLASS, '\MODEL\Fornecedor'
            );

            // fetchAll retorna um array com todos os registros
            return $sql->fetchAll();
        }

        // ---- SELECT BY ID ----
        // Retorna um fornecedor pelo ID
        // Usado no formulário de edição para pré-preencher os campos
        public function SelectById(int $id) {
            $sql = $this->db->prepare(
                "SELECT * FROM fornecedor WHERE id = :id"
            );
            $sql->bindValue(":id", $id);
            $sql->execute();

            $sql->setFetchMode(
                \PDO::FETCH_CLASS, '\MODEL\Fornecedor'
            );

            // fetch retorna só um registro (o primeiro encontrado)
            return $sql->fetch();
        }

        // ---- INSERT ----
        // Insere um novo fornecedor no banco
        // Recebe um objeto MODEL\Fornecedor já preenchido
        public function Insert(\MODEL\Fornecedor $fornecedor) {
            $sql = $this->db->prepare(
                "INSERT INTO fornecedor (nome, cnpj, telefone, email, cidade, uf)
                 VALUES (:nome, :cnpj, :telefone, :email, :cidade, :uf)"
            );

            // Cada bindValue vincula um parâmetro ao valor do getter do objeto
            $sql->bindValue(":nome",     $fornecedor->getNome());
            $sql->bindValue(":cnpj",     $fornecedor->getCnpj());
            $sql->bindValue(":telefone", $fornecedor->getTelefone());
            $sql->bindValue(":email",    $fornecedor->getEmail());
            $sql->bindValue(":cidade",   $fornecedor->getCidade());
            $sql->bindValue(":uf",       $fornecedor->getUf());

            $sql->execute();
        }

        // ---- UPDATE ----
        // Atualiza os dados de um fornecedor existente
        // O WHERE id = :id garante que só esse registro seja alterado
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

        // ---- DELETE ----
        // Remove um fornecedor pelo ID
        // Cuidado: só funciona se não houver produtos vinculados a esse fornecedor
        public function Delete(int $id) {
            $sql = $this->db->prepare(
                "DELETE FROM fornecedor WHERE id = :id"
            );
            $sql->bindValue(":id", $id);
            $sql->execute();
        }
    }
?>