<?php
include_once './DAO/daoUser.php';

class modelUser{
    public $rows;
    public $senha_login;

    //realiza o login no sistema e retorna os dados do usuário
    public function modelLogin($login){
        
        $userDAO = new daoUser();

        $userDAO->connection();

        $this->rows = $userDAO->daoLogin($login);
    }

    //realiza o cadastro de novos usuários no sistema, sem podendo escolher permissão
    public function modelRegister($login, $senha){
        $userDAO = new daoUser();

        $userDAO->connection();

        $userDAO->daoRegister($login, $senha);
    }


    //realiza a listagem dos usuarios cadastrados no sistema
    public function modelSelect(){
        $userDAO = new daoUser();

        $userDAO->connection();

        $this->rows = $userDAO->daoSelect();
    }

    //função que seleciona os dados pelo login
    public function modelSelectByLogin($login){
        $userDAO = new daoUser();

        $userDAO->connection();

        $this->senha_login = $userDAO->daoSelectByLogin($login);
    }

    //salva a edição do usuario no formulário de edição
    public function modelUpdateUser($id, $login, $admin){
        $userDAO = new daoUser();

        $userDAO->connection();

        $userDAO->daoUpdateUser($id, $login, $admin);
    }

    //deleta um registro no banco
    public function modelDisableUser($id){
        $userDAO = new daoUser();

        $userDAO->connection();

        $userDAO->daoDisableUser($id);
    }

    //cadastra um novo usuario, podendo escolher a permissão
    public function modelInsertUser($login, $senha, $permissao){
        $userDAO = new daoUser();

        $userDAO->connection();

        $userDAO->daoInsertUser($login, $senha, $permissao);
    }
}