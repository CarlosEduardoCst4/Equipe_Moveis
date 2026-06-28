<?php
    namespace MODEL;

    
    class Fornecedor {

        private ?int    $id;
        private ?string $nome;
        private ?string $cnpj;
        private ?string $telefone;
        private ?string $email;
        private ?string $cidade;
        private ?string $uf;

        public function __construct() {}

        public function getId()       { return $this->id; }
        public function getNome()     { return $this->nome; }
        public function getCnpj()     { return $this->cnpj; }
        public function getTelefone() { return $this->telefone; }
        public function getEmail()    { return $this->email; }
        public function getCidade()   { return $this->cidade; }
        public function getUf()       { return $this->uf; }

        public function setId(int $id)          { $this->id = $id; }
        public function setNome(string $nome)   { $this->nome = $nome; }
        public function setCnpj(string $cnpj)   { $this->cnpj = $cnpj; }
        public function setTelefone(string $t)  { $this->telefone = $t; }
        public function setEmail(string $email) { $this->email = $email; }
        public function setCidade(string $c)    { $this->cidade = $c; }
        public function setUf(string $uf)       { $this->uf = $uf; }
    }
?>