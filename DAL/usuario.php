<?php
    // Namespace DAL — camada de acesso ao banco de dados
    namespace DAL;

    // Não usamos "use" aqui pois os arquivos são carregados
    // manualmente com include_once no login.php
    // Referenciamos as classes com o caminho completo: \DAL\Conexao, \MODEL\Usuario

    class Usuario {

        // Atributo que guarda a conexão com o banco
        private $db;

        // Construtor — já conecta ao banco ao criar o objeto
        public function __construct() {
            // \DAL\Conexao — barra invertida no início indica namespace global
            $this->db = \DAL\Conexao::conectar();
        }

        // Busca um usuário pelo login
        // Usado no login.php para verificar se o usuário existe
        public function SelectByLogin(string $login) {

            // Prepara a consulta SQL com parâmetro nomeado (:login)
            // Parâmetros nomeados evitam SQL Injection
            $sql = $this->db->prepare(
                "SELECT * FROM usuario WHERE login = :login"
            );

            // Vincula o valor do parâmetro :login ao valor recebido
            $sql->bindValue(":login", $login);

            // Executa a consulta
            $sql->execute();

            // Busca a linha retornada como array associativo
            $linha = $sql->fetch(\PDO::FETCH_ASSOC);

            // Cria um objeto Usuario do MODEL e preenche com os dados do banco
            $usuario = new \MODEL\Usuario();

            // Só preenche se encontrou o usuário no banco
            if ($linha) {
                $usuario->setId($linha['id']);
                $usuario->setNome($linha['nome']);
                $usuario->setLogin($linha['login']);
                $usuario->setSenha($linha['senha']);
            }

            // Retorna o objeto preenchido (ou vazio se não encontrou)
            return $usuario;
        }
    }
?>