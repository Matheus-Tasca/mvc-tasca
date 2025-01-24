<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de clientes</title>
    <!--Adicionando o bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./view/modules/Cliente/styles.css">
</head>
<body>

  <?php 
    $controllerUser->validaSessao();
  ?>
    <div class="container">
        <!--navbar-->
        <div class="navBarCustom">
            <nav class="navbar bg-body-tertiary fixed-top">
                <div class="container-fluid">

                  <a class="navbar-brand" href="./cliente"><img src="./view/modules/Cliente/images/kabum.jpg" heigth="70" width="70" alt="logo kabum"></a>
                  <h1>Bem vindo, <?= $_SESSION['login']?></h1>
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
                            <li><a class="dropdown-item" href="./cliente">Listagem de clientes</a></li>
                            <li><a class="dropdown-item" href="./cliente/form">Cadastro de clientes</a></li>
                            <li><a class="dropdown-item" href="./user/gerenciaUser">Gerenciamento de usuarios</a></li>
                          </ul>
                        </li>
                        <a class="dropdown-item" href="./logout">Sair</a>
                      </ul>

                    </div>
                  </div>
                </div>
                
              </nav>
        </div>
          <!--Fim da navbar-->
        
        <h1>Listagem Clientes</h1>
        <table class="table table-striped ">

        <thead>
          <!--Cabeçario da tabela de listagem-->
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">RG</th>
                <th scope="col">EMAIL</th>
                <th scope="col">Celular</th>
                <th scope="col">Telefone</th>
                <th scope="col">Data de Nascimento</th>
            </tr>
        </thead>
        <tbody>
          <!--Foreach para exibição dos dados coletados pela Model-->
          <?php foreach ($model->rowsCliente as $cliente): ?>
          <tr>

              <th scope="row"><?= $cliente['id'] ?></th>
              <td><?= $cliente['nome'] ?></td>
              <td><?= $cliente['cpf'] ?></td>
              <td><?= $cliente['rg'] ?></td>
              <td><?= $cliente['email'] ?></td>
              <td><?= $cliente['telefone_1'] ?></td>
              <td><?= $cliente['telefone_2'] ?></td>
              <td><?= $cliente['data_nascimento'] ?></td>

              <!--Coluna para o botão de edição-->
              <td>
                <!--Offcanvas para exibição do formulário de edição-->
                  <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight-<?= $cliente['id'] ?>">Editar</button>
                  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight-<?= $cliente['id'] ?>">
                      <div class="offcanvas-header">
                          <h5 class="offcanvas-title" id="offcanvasRightLabel">Editar cliente</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                      </div>
    
                      <!-- Formulário de edição dentro do Offcanvas-->
                      <div class="offcanvas-body">
                          <form method="POST" action="./cliente/saveEdit">
                              <input type="hidden" value="<?= $cliente['id'] ?>" name="id">
                              <b>Nome:</b>
                              <input type="text" value="<?= $cliente['nome'] ?>" name="nome"><br>
                              
                              <input type="text" value="<?= $cliente['cpf'] ?>" name="cpf_semEditar" style="display: none;"><br>

                              <b>CPF:</b>
                              <input type="text" value="<?= $cliente['cpf'] ?>" name="cpf" id="cpf"><br>
                              <b>RG:</b>
                              <input type="text" value="<?= $cliente['rg'] ?>" name="rg"><br>
                              <b>EMAIL:</b>
                              <input type="email" value="<?= $cliente['email'] ?>" name="email"><br>
                              <b>Celular:</b>
                              <input type="tel" value="<?= $cliente['telefone_1'] ?>" name="telefone_1"><br>
                              <b>Telefone:</b>
                              <input type="tel" value="<?= $cliente['telefone_2'] ?>" name="telefone_2"><br>
                              <b>Data de nascimento:</b>
                              <input type="date" value="<?= $cliente['data_nascimento'] ?>" name="data_nascimento"><br>
                                  
                              
                              <button class="btn btn-primary" id="btnSalvaEdit">Salvar edição</button>
                          </form>
                          
                          <form action="./cliente/enderecos" method="post">
                            <input value="<?= $cliente['cpf'] ?>" style="display: none;" name="cpf"></input>
                            <button type="submit" class="btn btn-danger">Endereços cadastrados</button><br>
                          </form>
                      </div>

                  </div>
              </td>
              <!--Final coluna para o botão de edição-->

              <!--Botão de inativar usuario-->
              <form method="POST" action="./cliente/disable">
                  <input value="<?= $cliente['id'] ?>" style="display:none" name="id">
                  <td><button class="btn btn-danger" type="submit">Inativar</button></td>
              </form>  
              <!--Final botão para inativar usuário-->
              
            </tr>
          <?php  endforeach ?>
          <!--Final foreach de exibição dos dados-->
        </tbody>

      </table>

    </div>
        <!--Adicionando o bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!--Importando script para funções js-->
    <script src="../view/modules/Cliente/script.js"></script>

</body>
</html>