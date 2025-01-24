<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de usuarios</title>
</head>
<body>
    <!--Adicionando o bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../view/modules/User/styles.css">

    
    <div class="container">
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
                                <li><a class="dropdown-item" href="../cliente/form">Cadastro de clientes</a></li>
                                <li><a class="dropdown-item" href="./user/gerenciaUser">Gerenciamento de usuarios</a></li>
                                </ul>
                            </li>
                            </ul>

                        </div>
                    </div>
                </div>
            
            </nav>
        </div>
    <!--Fim da navbar-->
    
    <table class="table table-striped ">

        <thead>
          <!--Cabeçario da tabela de listagem-->
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Login</th>
                <th scope="col">Permissão</th>
            </tr>
        </thead>
        <tbody>
        <!--Exibição dos usuarios cadastrados -->
            <?php foreach ($model->rows as $user): ?>
                <tr>
                    <td><?= $user['idUsuario']?></td>
                    <td><?= $user['login']?></td>
                    <td><?= $user['admin'] == 1 ? "admin" : "usuario comum"?></td>
                <!--Coluna para o botão de edição-->
                <td>
                <!--Offcanvas para exibição do formulário de edição-->
                  <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight-<?= $user['idUsuario'] ?>">Editar</button>
                  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight-<?= $user['idUsuario'] ?>">
                      <div class="offcanvas-header">
                          <h5 class="offcanvas-title" id="offcanvasRightLabel">Editar usuário</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                      </div>
    
                      <!-- Formulário de edição dentro do Offcanvas-->
                      <div class="offcanvas-body">
                          <form method="POST" action="./saveEdit">
                            <input type="hidden" value="<?= $user['idUsuario'] ?>" name="idUsuario">
                            <b>Login:</b>
                            <input type="text" class="form-control" value="<?= $user['login'] ?>" name="login"><br>

                            <hr>
                            <b>Permissão:</b>
                            <div class="row">
                                <div class="col">
                                    Admin:
                                    <input type="radio" name="radioPermissao" value=1 <?= $user['admin'] == 1 ? "checked" : ""?>>
                                </div>

                                <div class="col">
                                    Usuario comum:
                                    <input type="radio" name="radioPermissao" value=0 <?= $user['admin'] == 0 ? "checked" : ""?>>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Salvar edição</button>
                          </form>
                          
                      </div>

                  </div>
              </td>
              <!--Final coluna para o botão de edição-->

              <!--Botão de inativar usuario-->
              <form method="POST" action="./disable">
                  <input value="<?= $user['idUsuario'] ?>" style="display:none" name="id">
                  <td><button class="btn btn-danger" type="submit">Inativar</button></td>
              </form>  
              <!--Final botão para inativar usuário-->
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

            <!--Cadastro de novos usuários-->
            <form action="./novoUser" method="post">
                <div class="card" style="width: 35rem;">
                    <div class="card-header">
                      <b>Cadastro de Usuário</b>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item"><b>Login: </b><input class="form-control" name="login" type="text" ></input></li>
                      <li class="list-group-item"><b>Senha: </b><input class="form-control" name="senha" type="password" ></input></li>
                      <li class="list-group-item"><b>Permissão: </b>
                        <div class="row">
                            <div class="col">
                                Admin:
                                <input type="radio" name="radioPermissao" value=1 <?= $user['admin'] == 1 ? "checked" : ""?>>
                            </div>

                            <div class="col">
                                Usuario comum:
                                <input type="radio" name="radioPermissao" value=0 <?= $user['admin'] == 0 ? "checked" : ""?>>
                            </div>
                        </div>
                    </li>
                      <li class="list-group-item"><button class="btn btn-primary" type="submit">Cadastrar</button></li>
                    </ul>
                  </div>
                
            </form>
    <!--Adicionando o bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>