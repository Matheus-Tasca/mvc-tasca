<?php
//inclusão dos controllers utilizados
include_once './controller/clienteController.php';
include_once './controller/userController.php';
$controllerUser = new userController();
$controllerCliente = new clienteController();

//Valor do "módulo" que é passado via GET pelo .htaccess
$modulo = $_GET['modulo'];

//switch-case de redirecionamento das páginas com base no valor fornecido do módulo
    switch($modulo){
    
    //página para a exibição dos clientes
    case 'listar':
        $controllerCliente->controllerSelect();
        break;

    //página para o formulario de cadastro dos clientes
    case 'form':
        $controllerCliente->formCadastro();
        break;   

    //página que salva os dados do formulario de cadastro    
    case 'save':
        $controllerCliente->controllerSaveForm();
        break;

    //função para desabilitar algum cliente
    case 'disable':
        $controllerCliente->controllerDisableUser();
        break;

    //função que salva os edits da alteração no registro de um cliente
    case 'saveEdit':
        $controllerCliente->controllerSaveEdit();
        break;

    //página que lista os endereços de um cliente
    case 'listEnderecos':
        $controllerCliente->controllerEnderecos();
        break;

    //funcao que exclui os endereços de um cliente
    case 'enderecoDisable':
        $controllerCliente->controllerDisableEndereco();
        break;

    //função que insere um novo endereço para o cliente
    case 'novoEndereco':
        $controllerCliente->controllerRegisterEndereco();
        break;

    //função que salva as alterações feitas no endereço de um cliente
    case 'saveEndereco':
        $controllerCliente->controllerSaveEndereco();
        break;

    //página com o formulário de registro de um novo usuário
    case 'formUser':
        $controllerUser->controllerUserForm();
        break;

    //função que salva o registro de um novo usuário
    case 'register':
        $controllerUser->controllerRegister();
        break;

    //função que faz o login no sistema
    case 'loginUser':
        $controllerUser->controllerLogin();
        break;

    //função quie faz o logout do sistema
    case 'logout':
        $controllerUser->logout();
        break;

    //página para a listagem de usuários do sistema
    case 'gerenciaUser':
        $controllerUser->listUsuarios();
        break;

    //função que insere um usuario
    case 'novoUser':
        $controllerUser->controllerInsertUser();
        break;

    //função que salva as edições dos dados de um usuário no sistema
    case 'saveEditUser':
        $controllerUser->controllerUpdateUser();
        break;

    //função que remove um usuario
    case 'disableUser':
        $controllerUser->controllerDisableUser();
        break;
        
    //caso default, onde se alguma rota não é conhecida, manda pro login do sistema
    case 0:
        $controllerUser->controllerUserForm();
        break;
    }
