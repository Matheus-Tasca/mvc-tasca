<?php

class daoUser{
    private $conexao;

    //faz a conexão com o banco de dados
    public function connection(){
        $dsn = "mysql:host=localhost:3306;dbname=mvc_db";
        
        $this->conexao = new PDO($dsn,'root', 'Bolinho123@');
        
    }

    //faz o select dos usuarios cadastrados no sistema
    public function daoSelect(){
        $sql = 'SELECT * FROM usuario';

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    //pega a senha do usuario pelo login
    public function daoSelectByLogin($login){
        $sql = 'SELECT senha FROM usuario WHERE login = ?';

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $login);

        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    //salva a edição do usuário no formulário de edição
    public function daoUpdateUser($id, $login, $admin){
        $sql = "UPDATE usuario SET login = ? , admin = ? WHERE idUsuario = ?";
        
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $login);
        $stmt->bindValue(2, $admin);
        $stmt->bindValue(3, $id);

        $stmt->execute();
    }

    //adiciona novos usuários, podendo escolher se é admin ou não
    public function daoInsertUser($login, $senha, $permissao){
        $sql = "INSERT INTO usuario (login, senha, admin) VALUES (?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $login);
        $stmt->bindValue(2, $senha);
        $stmt->bindValue(3, $permissao);

        $stmt->execute();
    }

    //faz o login no sistema, retornando os dados do usuário
    public function daoLogin($login){

        $sql = "SELECT idUsuario, login, admin FROM usuario WHERE login = ?";
        $stmt = $this->conexao->prepare($sql);
        
        $stmt->bindValue(1, $login);

        $stmt->execute();

        return $stmt->fetchAll();
    }

     //remove um registro com base no login
     public function daoDisableUser($id){
        $sql = "DELETE FROM usuario WHERE idUsuario = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    //faz o registro de novos usuarios pelo formulário de registro
    public function daoRegister($login, $senha){
        $sql = "INSERT INTO usuario (login, senha, admin) VALUES (?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $login);
        $stmt->bindValue(2, $senha);
        $stmt->bindValue(3, 0);

        $stmt->execute();
    }


}