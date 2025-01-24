<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de cadastro</title>
     <!--Adicionando o bootstrap-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="../view/modules/Cliente/styles.css">
</head>
    <body>
      <?php 
        $controllerUser->validaSessao();
      ?>
        <!--navbar-->
        <div class="navBarCustom">
            <nav class="navbar bg-body-tertiary fixed-top">
                <div class="container-fluid">

                    <a class="navbar-brand" href="../cliente"><img src="../view/modules/User/images/kabum.jpg" heigth="70" width="70" alt="logo kabum"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">CRUD clientes</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>

                        <div class="offcanvas-body">

                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Telas
                                </a>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../cliente">Listagem de clientes</a></li>
                                <li><a class="dropdown-item" href="./cliente/form">Cadastro de clientes</a></li>
                                <li><a class="dropdown-item" href="../user/gerenciaUser">Gerenciamento de usuarios</a></li>
                                </ul>
                            </li>
                            </ul>

                        </div>
                    </div>
                </div>
            
            </nav>
        </div>
          <!--Fim da navbar-->

    
    <div class="container">

      <h1>Formulario de cadastro de usuário</h1>

      <form method="POST" action="../cliente/save">
        
      <!--Linha 1 com nome e cpf-->
      <div class="row">
        <div class="col">
          <input type="text" value="<?= $_SESSION['idUsuario'] ?>" style="display: none;" name='id'></input>
          <li class="list-group-item"><b>Insira o nome: </b><input name="nome" type="text" class="form-control" required></input></li>

        </div>

        <div class="col">
          <li class="list-group-item"><b>Insira o cpf: </b><input name="cpf" type="text" class="form-control"  id="cpf" required></input></li>
          
        </div>

      </div>

      <!--Linha 2 com rg e e-mail-->
      <div class="row">
        <div class="col">
          <li class="list-group-item"><b>Insira o rg: </b><input name="rg" type="tel" class="form-control" required ></input></li>
          
        </div>

        <div class="col">
          <li class="list-group-item"><b>Insira o e-mail: </b><input name="email" class="form-control" type="email" required></input></li>

        </div>

      </div>

      <!--Linha 3 com numero de celular e telefone fixo-->
      <div class="row">
        <div class="col">
          <li class="list-group-item"><b>Insira o seu número de celular: </b><input id="tel_celular" class="form-control" name="telefone_1" type="text" required></input></li>

        </div>
        
        <div class="col">

          <li class="list-group-item"><b>Insira o seu número de telefone fixo (Opcional): </b><input class="form-control" name="telefone_2" type="text" id="numero_fixo"></input></li>

        </div>

      </div>

      <!--Linha 4 com data de nascimento-->  
      <div class="row">
        <div class="col-6">
          <li class="list-group-item"><b>Insira sua data de nascimento:  </b><input class="form-control" name="data_nascimento" type="date" required></input></li>

        </div>

      </div>

      
      <hr>
      <!--Linha 5 com CEP e rua-->
      <div class="row">
        <div class="col-6">
          <li class="list-group-item"><b>CEP: </b><input class="form-control" name="cep" type="text" required id="cep"></input></li>
  
        </div>

        <div class="col-6">
          <li class="list-group-item"><b>Rua: </b><input class="form-control" name="rua" type="text" required></input></li>

        </div> 

      </div>

      <!--Linha 6 com bairro e numero-->    
      <div class="row">
        <div class="col-6">
          <li class="list-group-item"><b>Bairro: </b><input class="form-control" name="bairro" type="text" required></input></li>

        </div>

        <div class="col-6">
          <li class="list-group-item"><b>Numero: </b><input class="form-control" name="numero" type="text" required></input></li>
          
        </div>

      </div>
      
      <!--Linha 7 com complemento-->
      <div class="row">
        <div class="col">
          <li class="list-group-item"><b>Complemento (Opcional): </b><input class="form-control" name="complemento" type="text"></input></li>

        </div>

      </div>

      <!--Linha 8 com botão enviar-->
      <div class="row">
        <div class="col-6">
          <button type="submit" class="btn btn-primary" id="botaoEnviarForm">Enviar</button>

        </div>

      </div>

    </form>
     
    </div>

    <!--Adicionando o bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!--Importando script para funções js-->
    <script src="../view/modules/Cliente/script.js"></script>
</body>
</html>