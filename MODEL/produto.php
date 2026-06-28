<?php
    namespace MODEL;

    class Produto {

        private ?int    $id;
        private ?string $descricao;
        private ?int    $id_fornecedor;
        private ?int    $id_categoria;
        private ?float  $preco_custo;
        private ?float  $preco_venda;
        private ?int    $estoque_atual;
        private ?int    $estoque_minimo;
        private ?int    $ativo;

        public function __construct() {}

        public function getId()            { return $this->id; }
        public function getDescricao()     { return $this->descricao; }
        public function getIdFornecedor()  { return $this->id_fornecedor; }
        public function getIdCategoria()   { return $this->id_categoria; }
        public function getPrecoCusto()    { return $this->preco_custo; }
        public function getPrecoVenda()    { return $this->preco_venda; }
        public function getEstoqueAtual()  { return $this->estoque_atual; }
        public function getEstoqueMinimo() { return $this->estoque_minimo; }
        public function getAtivo()         { return $this->ativo; }

        public function setId(int $id)                  { $this->id = $id; }
        public function setDescricao(string $descricao) { $this->descricao = $descricao; }
        public function setIdFornecedor(int $id)        { $this->id_fornecedor = $id; }
        public function setIdCategoria(int $id)         { $this->id_categoria = $id; }
        public function setPrecoCusto(float $v)         { $this->preco_custo = $v; }
        public function setPrecoVenda(float $v)         { $this->preco_venda = $v; }
        public function setEstoqueAtual(int $v)         { $this->estoque_atual = $v; }
        public function setEstoqueMinimo(int $v)        { $this->estoque_minimo = $v; }
        public function setAtivo(int $v)                { $this->ativo = $v; }
    }
?>