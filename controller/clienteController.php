<?php
include_once './controller/userController.php';
include_once './model/modelCliente.php';

class clienteController{

    //fchama o formulario de cadastro
    public function formCadastro(){
        include_once './controller/userController.php';

        $controllerUser = new userController();
        
        include_once './view/modules/Cliente/formCliente.php';
    }

    //salva as infos do formulario de cadastro e manda pro banco de dados
    public function controllerSaveForm(){
        
        $model = new modelCliente();

        //pega o usuario de origem
        $id= $_POST['id'];

        //pega os dados enviados pelo form
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $email = $_POST['email'];
        $telefone_1 = $_POST['telefone_1'];
        $telefone_2 = $_POST['telefone_2'];
        $data_nascimento = $_POST['data_nascimento'];
        $CEP = $_POST['cep'];
        $rua = $_POST['rua'];
        $bairro = $_POST['bairro'];
        $numero= $_POST['numero'];
        $complemento = $_POST['complemento'];

        //verifica se o cliente já existe
        $model->modelSelectBycpf($cpf);
        
        if(!empty($model->rowsCliente)){
            //se existir, da erro
            print('<script>alert("O cliente já existe no banco de dados.")</script>');
            print('<script>window.location.href = "../cliente"</script>');

        }else{
            //se não existir, cadastra no banco
            $model->modelInsertCliente($nome, $cpf, $rg, $email, $telefone_1, 
            $telefone_2, $data_nascimento, $id);
            
            $model->modelInsertEndereco($CEP, $rua, $bairro, $numero, $complemento,$cpf);
    
            header('Location: ../cliente');
        }
    }

    //pega os dados do banco de dados
    public function controllerSelect(){
        $controllerUser = new userController();
        
        $model = new modelCliente();

        session_start();

        //faz o select no banco, pegando os clientes do usuario logado
        $id_usuario = $_SESSION['idUsuario'];
        $admin = $_SESSION['admin'];

        $model->modelSelectCliente($id_usuario, $admin);

        include_once './view/modules/Cliente/listCliente.php';
    }

    //desativa o usuario
    public function controllerDisableUser(){
        session_start();

        $model = new modelCliente();
        $id_usuario = $_SESSION['admin'];
        $id_cliente = $_POST['id'];
        
        //verifica se um usuário é adm
        if(strcmp($id_usuario,'1') == 0){
            $model->modelDisableUser($id_cliente);
            header('Location: ../cliente');
        }
            //se não for, a função é desabilitada
            print('<script>alert("Função exclusiva para administradores.")</script>');
            print('<script>window.location.href = "../cliente"</script>');
    }


    //salva as edições do usuario do formulário de edição
    public function controllerSaveEdit(){
        $cpf_banco = "";
        $model = new modelCliente();

        //pega os dados do form
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $cpf_semEditar = $_POST['cpf_semEditar'];
        $rg = $_POST['rg'];
        $email = $_POST['email'];
        $telefone_1 = $_POST['telefone_1'];
        $telefone_2 = $_POST['telefone_2'];
        $data_nascimento = $_POST['data_nascimento'];

        //verifica se o campo CPF foi editado
        if(strcmp($cpf, $cpf_semEditar) != 0){
            //verifica se o cliente já existe
            $model->modelSelectBycpf($cpf);
                    
            //extrai o cpf armazenado
            foreach($model->rowsCliente as $cpfSelect){
                $cpf_banco = $cpfSelect["cpf"];
            }

            //var_dump($cpf_banco);
            if(!empty($cpf_banco)){
                print('<script>alert("O cliente já existe no banco de dados.")</script>');
                print('<script>window.location.href = "../cliente"</script>');
            }else{
                $model->modelEditUser($id, $nome, $cpf, $rg, $email, $telefone_1,
                $telefone_2, $data_nascimento);
                header('Location: ../cliente');
            };
            
        }else{
            //cadastra as edições no banco pelo model
            $model->modelEditUser($id, $nome, $cpf, $rg, $email, $telefone_1,
            $telefone_2, $data_nascimento);
            header('Location: ../cliente');
        };
    }

    //listagem de endereços do usuário
    public function controllerEnderecos(){
        
        //inclusão do userController para uso da sessão
        include_once './controller/userController.php';

        $controllerUser = new userController();
        
        $model = new modelCliente();

        //pega o cpf do form
        $cpf = $_POST['cpf'];
        
        //seleciona os endereços desse usuário e manda pra view
        $model->modelSelectEndereco($cpf);

        include_once './view/modules/Cliente/listEnderecos.php';
    }

    //exclusão de endereço pelo cpf
    public function controllerDisableEndereco(){
        
        $model = new modelCliente();


        $cep = $_POST['cep'];
        $cpf = $_POST['cpf'];

        $model->modelDisableEndereco($cep,$cpf);

        header('Location:../../cliente');
    }

    //cadastra novo endereço por cpf
    public function controllerRegisterEndereco(){

        $model = new modelCliente();

        $cpf = $_POST['cpf'];
        $CEP = $_POST['cep'];
        $rua = $_POST['rua'];
        $bairro = $_POST['bairro'];
        $numero= $_POST['numero'];
        $complemento = $_POST['complemento'];

        $model->modelSelectByCEP($CEP, $cpf);

        if(!empty($model->rowsCEP)){
            print('<script>alert("Endereço já cadastrado no sistema.")</script>');
            print('<script>window.location.href = "../../cliente"</script>');
        }else{
            $model->modelRegisterEndereco($CEP, $rua, $bairro, $numero, $complemento, $cpf);

            header('Location: ../../cliente');
        }
    }

    //atualiza um endereço por cpf
    public function controllerSaveEndereco(){

        $model = new modelCliente();

        $cpf = $_POST['cpf_cliente'];
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $bairro = $_POST['bairro'];
        $numero= $_POST['numero'];
        $complemento = $_POST['complemento'];
        $principal = $_POST['principal'];

                
        $model->modelUpdateEndereco($cep, $rua, $bairro, $numero, $complemento, $cpf, $principal);
        header('Location: ../../cliente');
    }
}