<?php
    namespace MODEL;

    class Movel {

        private ?int    $id;
        private ?string $descricao;
        private ?int    $id_categoria;
        private ?float  $preco_venda;
        private ?string $data_cadastro;
        private ?string $observacao;

        public function __construct() {}

        public function getId()           { return $this->id; }
        public function getDescricao()    { return $this->descricao; }
        public function getIdCategoria()  { return $this->id_categoria; }
        public function getPrecoVenda()   { return $this->preco_venda; }
        public function getDataCadastro() { return $this->data_cadastro; }
        public function getObservacao()   { return $this->observacao; }

        public function setId(int $id)                    { $this->id = $id; }
        public function setDescricao(string $descricao)   { $this->descricao = $descricao; }
        public function setIdCategoria(int $id)           { $this->id_categoria = $id; }
        public function setPrecoVenda(float $v)           { $this->preco_venda = $v; }
        public function setDataCadastro(string $data)     { $this->data_cadastro = $data; }
        public function setObservacao(string $observacao) { $this->observacao = $observacao; }
    }
?>