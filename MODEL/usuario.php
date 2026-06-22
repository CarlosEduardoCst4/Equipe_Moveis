<?php
    // Define o namespace MODEL para organizar as classes
    // Isso evita conflito de nomes entre classes de diferentes camadas
    namespace MODEL;

    // Classe que representa umUsuário do sistema
    // No padrão MVC, o MODEL é responsável por representar os dados
    class Usuario {

        // Atributos privados — só podem ser acessados dentro da própria classe
        // O "?" antes do tipo significa que o campo pode ser nulo (nullable)
        private ?int    $id;
        private ?string $nome;
        private ?string $login;
        private ?string $senha;

        // Construtor vazio — o objeto é criado sem dados
        // Os dados são preenchidos depois pelos setters
        public function __construct() {}

        // ---- GETTERS ----
        // Métodos que retornam o valor dos atributos privados

        public function getId() {
            return $this->id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getLogin() {
            return $this->login;
        }

        public function getSenha() {
            return $this->senha;
        }

        // ---- SETTERS ----
        // Métodos que definem o valor dos atributos privados

        public function setId(int $id) {
            $this->id = $id;
        }

        public function setNome(string $nome) {
            $this->nome = $nome;
        }

        public function setLogin(string $login) {
            $this->login = $login;
        }

        public function setSenha(string $senha) {
            $this->senha = $senha;
        }
    }
?>