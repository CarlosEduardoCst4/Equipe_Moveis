<?php namespace DAL;
if (class_exists('DAL\Usuario')) return;

class Usuario {

    private $db;

    public function __construct() {
        $this->db = \DAL\Conexao::conectar();
    }

    public function SelectAll() {
        $sql = $this->db->prepare(
            "SELECT * FROM usuario ORDER BY nome"
        );
        $sql->execute();
        $sql->setFetchMode(\PDO::FETCH_CLASS, '\MODEL\Usuario');
        return $sql->fetchAll();
    }

    public function SelectById(int $id) {
        $sql = $this->db->prepare(
            "SELECT * FROM usuario WHERE id = :id"
        );
        $sql->bindValue(":id", $id);
        $sql->execute();
        $sql->setFetchMode(\PDO::FETCH_CLASS, '\MODEL\Usuario');
        return $sql->fetch();
    }

    public function SelectByLogin(string $login) {
        $sql = $this->db->prepare(
            "SELECT * FROM usuario WHERE login = :login"
        );
        $sql->bindValue(":login", $login);
        $sql->execute();

        $linha   = $sql->fetch(\PDO::FETCH_ASSOC);
        $usuario = new \MODEL\Usuario();

        if ($linha) {
            $usuario->setId($linha['id']);
            $usuario->setNome($linha['nome']);
            $usuario->setLogin($linha['login']);
            $usuario->setSenha($linha['senha']);
        }

        return $usuario;
    }

    public function Insert(\MODEL\Usuario $usuario) {
        $sql = $this->db->prepare(
            "INSERT INTO usuario (nome, login, senha)
             VALUES (:nome, :login, :senha)"
        );
        $sql->bindValue(":nome",  $usuario->getNome());
        $sql->bindValue(":login", $usuario->getLogin());
        $sql->bindValue(":senha", $usuario->getSenha());
        $sql->execute();
    }

    public function Update(\MODEL\Usuario $usuario) {
        $sql = $this->db->prepare(
            "UPDATE usuario SET
                nome  = :nome,
                login = :login,
                senha = :senha
             WHERE id = :id"
        );
        $sql->bindValue(":id",    $usuario->getId());
        $sql->bindValue(":nome",  $usuario->getNome());
        $sql->bindValue(":login", $usuario->getLogin());
        $sql->bindValue(":senha", $usuario->getSenha());
        $sql->execute();
    }

    public function Delete(int $id) {
        $sql = $this->db->prepare(
            "DELETE FROM usuario WHERE id = :id"
        );
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
}
?>