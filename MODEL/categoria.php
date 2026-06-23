<?php
    namespace MODEL;

    // Classe que representa um Fornecedor no sistema
    // Cada atributo corresponde a uma coluna da tabela fornecedor no banco
    class Categoria {

        private ?int    $id;
        private ?string $descricao;

        public function __construct() {}

        // ---- GETTERS ----

        public function getId()       { return $this->id; }
        public function getDescricao()     { return $this->descricao; }

        // ---- SETTERS ----

        public function setId(int $id)          { $this->id = $id; }
        public function setDescricao(string $descricao)   { $this->descricao = $descricao; }
    }
?>