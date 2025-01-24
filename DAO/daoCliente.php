<?php 

class daoCliente{

    private $conexao;

    //faz a conexão com o banco de dados
    public function connection(){
        $dsn = "mysql:host=localhost:3306;dbname=mvc_db";
        
        $this->conexao = new PDO($dsn,'root', 'Bolinho123@');
        
    }

    //insere novos clientes no banco
    public function daoInsertCliente($nome, $cpf, $rg, $email, $telefone_1, 
    $telefone_2, $data_nascimento, $id){

        $sql = "INSERT INTO cliente (nome, cpf, rg, email, telefone_1, 
        telefone_2, data_nascimento, ativo, usuario_origem) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $nome);
        $stmt->bindValue(2, $cpf);
        $stmt->bindValue(3, $rg);
        $stmt->bindValue(4, $email);
        $stmt->bindValue(5, $telefone_1);
        $stmt->bindValue(6, $telefone_2);
        $stmt->bindValue(7, $data_nascimento);
        $stmt->bindValue(8, 1);
        $stmt->bindValue(9, $id);

        $stmt->execute();
    }

    //faz uma consulta no banco, trazendo os usuários pelo usuário
    public function daoSelectCliente($id_usuario, $admin){

        if($admin == 1){
            $sql = "SELECT * FROM cliente WHERE ativo = 1";
            return $this->daoSelectAdmin($sql);
        }
               
        $sql = "SELECT * FROM cliente WHERE ativo = 1 AND usuario_origem= ?";
        return $this->daoSelectUser($sql, $id_usuario);
    }

    //função para a seleção de usuários (admin)
    public function daoSelectAdmin($sql){
            
            $stmt = $this->conexao->prepare($sql); 

            $stmt->execute();

            return $stmt->fetchAll();
            
    }

    //função para a seleção de usuários (user)
    public function daoSelectUser($sql, $id_usuario){
            
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $id_usuario);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    //função que pesquisa se um cliente existe pelo cpf
    public function daoSelectByCpf($cpf){
        $sql = 'SELECT cpf FROM cliente WHERE cpf = ?';

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $cpf);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    //Inativa um registro
    public function daoDisableCliente($id_cliente){
        $sql = "UPDATE cliente SET ativo = 0 WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id_cliente);
        $stmt->execute();
    }

    //Atualiza um registro no banco
    public function daoSaveEditCliente($id, $nome, $cpf, $rg, $email, $telefone_1,
    $telefone_2, $data_nascimento){
        $sql = "UPDATE cliente SET nome = ?, cpf = ?, rg = ?, email = ?, telefone_1 = ?, telefone_2 = ?, data_nascimento = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $nome);
        $stmt->bindValue(2, $cpf);
        $stmt->bindValue(3, $rg);
        $stmt->bindValue(4, $email);
        $stmt->bindValue(5, $telefone_1);
        $stmt->bindValue(6, $telefone_2);
        $stmt->bindValue(7, $data_nascimento);
        $stmt->bindValue(8, $id);

        $stmt->execute();
    }

    //insere novos endereços no banco com o padrão setado
    public function daoInsertEndereco($CEP, $rua, $bairro, $numero, $complemento,$cpf){
        $sql = "INSERT INTO endereco_cliente (rua, bairro, numero, complemento, CEP, principal, cpf_cliente) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $rua);
        $stmt->bindValue(2, $bairro);
        $stmt->bindValue(3, $numero);
        $stmt->bindValue(4, $complemento);
        $stmt->bindValue(5, $CEP);
        $stmt->bindValue(6, 1);
        $stmt->bindValue(7, $cpf);

        $stmt->execute();
    }

    //pega as informações pelo CEP
    public function daoSelectByCEP($cep, $cpf){
        $sql = "SELECT * FROM endereco_cliente WHERE CEP = ? AND cpf_cliente = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $cep);
        $stmt->bindValue(2, $cpf);

        $stmt->execute();

        return $stmt->fetchAll();
    }
    //insere novos endereços no banco sem o padrão setado
    public function daoRegisterEndereco($CEP, $rua, $bairro, $numero, $complemento,$cpf){
        $sql = "INSERT INTO endereco_cliente (rua, bairro, numero, complemento, CEP, principal, cpf_cliente) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $rua);
        $stmt->bindValue(2, $bairro);
        $stmt->bindValue(3, $numero);
        $stmt->bindValue(4, $complemento);
        $stmt->bindValue(5, $CEP);
        $stmt->bindValue(6, 0);
        $stmt->bindValue(7, $cpf);

        $stmt->execute();
    }

    //select dos endereços do cliente
    public function daoSelectEndereco($cpf){
        $sql = "SELECT rua, bairro, numero, complemento, CEP, cpf_cliente, principal FROM endereco_cliente WHERE cpf_cliente = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $cpf);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    //exclusão de endereço pelo cpf
    public function daoDisableEndereco($cep,$cpf){
        $sql = "DELETE FROM endereco_cliente WHERE CEP = ? AND cpf_cliente = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cep);
        $stmt->bindValue(2, $cpf);
        $stmt->execute();
    }

    //atualiza um endereço
    public function daoUpdateEndereco($cep, $rua, $bairro, $numero, $complemento, $cpf, $principal){
        $sql = "UPDATE endereco_cliente SET rua= ?, bairro= ?, numero= ?, complemento= ?, CEP= ?, principal= ? WHERE CEP = ?";
        
        //se um endereço for setado como principal, desmarcada os outros
        $sql2 = "UPDATE endereco_cliente SET principal = 0 WHERE CEP != ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt2 = $this->conexao->prepare($sql2);

        $stmt->bindValue(1, $rua);
        $stmt->bindValue(2, $bairro);
        $stmt->bindValue(3, $numero);
        $stmt->bindValue(4, $complemento);
        $stmt->bindValue(5, $cep);
        $stmt->bindValue(6, $principal);
        $stmt->bindValue(7, $cep);

        $stmt2->bindValue(1, $cep);

        $stmt->execute();

        $stmt2->execute();
    }
}
?>