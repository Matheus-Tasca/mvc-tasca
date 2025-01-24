<?php
 include_once './DAO/daoCliente.php';
 include_once './controller/userController.php';

class modelCliente{

    public $rowsCliente;
    public $rowsEndereco;
    public $rowsCEP;
   
     //cadastro de novo cliente
    public function modelInsertCliente($nome, $cpf, $rg, $email, $telefone_1, 
    $telefone_2, $data_nascimento, $id){

        $daoCliente = new daoCliente();

        $daoCliente->connection();
        $daoCliente->daoInsertCliente($nome, $cpf, $rg, $email, $telefone_1, 
        $telefone_2, $data_nascimento, $id);
    }

    //funcao que pega as infos dos clientes
    public function modelSelectCliente($id_usuario, $admin){

        $daoCliente = new daoCliente();
        $controllerUser = new userController();

        $daoCliente->connection();

        $this->rowsCliente = $daoCliente->daoSelectCliente($id_usuario, $admin);
    }

    //função que pega os dados do cliente pelo cpf
    public function modelSelectBycpf($cpf){

        $daoCliente = new daoCliente();

        $daoCliente->connection();

        $this->rowsCliente = $daoCliente->daoSelectByCpf($cpf);
    }

    //desativa um usuario
    public function modelDisableUser($id_cliente){
        
        $daoCliente = new daoCliente();
        
        $daoCliente->connection();
        $daoCliente->daoDisableCliente($id_cliente);
    }

    //edita um registro de cliente
    public function modelEditUser($id, $nome, $cpf, $rg, $email, $telefone_1,
    $telefone_2, $data_nascimento){

        $daoCliente = new daoCliente();

        $daoCliente->connection();

        $daoCliente->daoSaveEditCliente($id, $nome, $cpf, $rg, $email, $telefone_1,
        $telefone_2, $data_nascimento);
    }

    //registro de um novo endereco com o padrão setado
    public function modelInsertEndereco($CEP, $rua, $bairro, $numero, $complemento, $cpf){

        $daoCliente = new daoCliente();

        $daoCliente->connection();

        $daoCliente->daoInsertEndereco($CEP, $rua, $bairro, $numero, $complemento, $cpf);
    }

    //pega as informações pelo CEP
    public function modelSelectByCEP($cep, $cpf){
        $daoCliente = new daoCliente();

        $daoCliente->connection();

        $this->rowsCEP = $daoCliente->daoSelectByCEP($cep, $cpf);
    }

    //registro de um novo endereço sem o padrão setado
    public function modelRegisterEndereco($CEP, $rua, $bairro, $numero, $complemento, $cpf){

        $daoCliente = new daoCliente();

        $daoCliente->connection();

        $daoCliente->daoRegisterEndereco($CEP, $rua, $bairro, $numero, $complemento, $cpf);
    }

    //select do endereço com base no cpf
    public function modelSelectEndereco($cpf){
        $daoCliente = new daoCliente();

        $daoCliente->connection();

        $this->rowsEndereco = $daoCliente->daoSelectEndereco($cpf);
    }

    //desativa um endereço
    public function modelDisableEndereco($cep, $cpf){

        $daoCliente = new daoCliente();
        
        $daoCliente->connection();
        $daoCliente->daoDisableEndereco($cep,$cpf);
    }

    //atualiza os dados de um endereco
    public function modelUpdateEndereco($cep, $rua, $bairro, $numero, $complemento, $cpf, $principal){
        $daoCliente = new daoCliente();

        if($principal == 'on'){
            $principal = 1;
        }else{
            $principal = 0;
        }

        $daoCliente->connection();
        $daoCliente->daoUpdateEndereco($cep, $rua, $bairro, $numero, $complemento, $cpf, $principal);
    }
}
?>