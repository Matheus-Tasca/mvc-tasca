<?php
include_once './model/modelUser.php';
class userController{

    //formulario de registro de novos usuarios
    public function controllerUserForm(){
        include_once './view/modules/User/formUser.php';

    }

    //função que realiza os logins no banco de dados
    public function controllerLogin(){
        
        $model = new modelUser();

        $login = $_POST['login'];
        $senha = $_POST['senha'];

        $senha_banco = '';

        //verifica se os dados são vazios
        if(strlen($login) == 0 || strlen($senha) == 0){
            print('<script>alert("Usuário ou senha em branco.")</script>');
            print('<script>window.location.href = "./"</script>');
        
        }
            //pega as informações de id, login e permissão pelo login
            $model->modelLogin($login);

            //pega a senha criptografada pelo login
            $model->modelSelectByLogin($login);


            //atribui a senha criptograda a uma variável
            foreach ($model->senha_login as $senha_cripto){
                $senha_banco = $senha_cripto["senha"];
            }
           
            //verifica se a senha é correspondente a criptografada
            if(password_verify($senha,$senha_banco) == 1){

                session_start();
                //incorpora os dados do usuario na SESSION
                foreach ($model->rows as $user){

                    $_SESSION['idUsuario'] = $user['idUsuario'];
                    $_SESSION['login'] = $user['login'];
                    $_SESSION['admin'] = $user['admin'];
                    
                    header('Location: ./cliente');
                }
            }else{
                //erro de login incorreto
                print('<script>alert("Usuário ou senha incorretos.")</script>');
                print('<script>window.location.href = "./"</script>');
            }
         
    }

    //função que registra um usuário no sistema
    public function controllerRegister(){
        $login = $_POST['login'];
        $senha = $_POST['senha'];

         //verifica se os dados são vazios
        if(strlen($login) == 0 || strlen($senha) == 0){

            print('<script>alert("Usuário ou senha em branco.")</script>');
            print('<script>window.location.href = "./"</script>');

        }
        $model = new modelUser();

         //pega as informações de id, login e permissão pelo login
        $model->modelLogin($login);
        
        //verifica se o usuário já existe
        if(!empty($model->rows)){

            print('<script>alert("Usuário já cadastrado no sistema.")</script>');
            print('<script>window.location.href = "../"</script>');

        }
            //criptografa a senha e cadastra no banco
            $senha_cripto = password_hash($senha, PASSWORD_DEFAULT);

            $model->modelRegister($login, $senha_cripto);

            print('<script>alert("Usuário cadastrado com sucesso!.")</script>');
            print('<script>window.location.href = "../"</script>');
        
    }
    

    //função para ver se a pessoa está logada ou não
    public function validaSessao(){
        $model = new modelUser();

        if(!isset($_SESSION)){
            session_start();
        }

        if(!isset($_SESSION['login']) || !isset($_SESSION['admin']) || !isset($_SESSION['idUsuario'])){
            die(print('<script>alert("Você não está logado.")</script>'));
        }

    }

    //faz o logout da sessão
    public function logout(){
        if(!isset($_SESSION)){
            session_start();
        }

        session_destroy();

        header('Location: ./user');
    }

    //funcao que lista os usuarios do banco de dados
    public function listUsuarios(){
        session_start();

        //pega a permissão do usuário
        $permissao = $_SESSION['admin'];
        
        //se for admin, tem acesso a tela e chama a listagem de usuários
        if($permissao == 1){
            include_once './model/modelUser';
            $model = new modelUser();

            $model->modelSelect();
            
            include_once './view/modules/User/listUser.php';
        }else{
        //se não for, dá erro e volta pra listagem de clientes
            print('<script>alert("Função exclusiva para administradores.")</script>');
            print('<script>window.location.href = "../cliente"</script>');
        }
    }

    //atualiza os dados de um usuario
    public function controllerUpdateUser(){

        //pega dos dados do form
        $id = $_POST['idUsuario'];
        $login = $_POST['login'];
        $radioPermissao = $_POST['radioPermissao'];

        //manda para edição no model
        $model = new modelUser();
        $model->modelUpdateUser($id,$login,$radioPermissao);

        header('Location: ./gerenciaUser');
    }

    //inativa um usuario um usuario
    public function controllerDisableUser(){
        $id = $_POST['id'];

        //exclui o usuário por id
        $model = new modelUser();
        $model->modelDisableUser($id);

        header('Location: ./gerenciaUser');
    }

    //insere um novo usuario no banco podendo escolher a permissão
    public function controllerInsertUser(){

        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $permissao = $_POST['radioPermissao'];
        $model = new modelUser();

        //pega as informações de id, login e permissão pelo login
        $model->modelLogin($login);

        
        //verifica se o usuário já existe
        if(!empty($model->rows)){

            print('<script>alert("Usuário já cadastrado no sistema.")</script>');
            print('<script>window.location.href = "./gerenciaUser"</script>');

        }else{

            //criptografa a senha e cadastra no banco
            $senha_cripto = password_hash($senha, PASSWORD_DEFAULT);

            $model->modelInsertUser($login, $senha_cripto, (int)$permissao);

            print('<script>alert("Usuário cadastrado com sucesso!.")</script>');
            print('<script>window.location.href = "./gerenciaUser"</script>');
        }
    }
}