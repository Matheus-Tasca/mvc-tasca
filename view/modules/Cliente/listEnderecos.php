<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de endereços</title>
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
              <a class="navbar-brand" href="../cliente"><img src="../view/modules/Cliente/images/kabum.jpg" heigth="70" width="70" alt="logo kabum"></a>
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
                        <li><a class="dropdown-item" href="./form">Cadastro de clientes</a></li>
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
        <table class="table table-striped ">

            <thead>
              <!--Cabeçario da tabela de listagem-->
                <tr>
                    <th scope="col">Rua</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Numero</th>
                    <th scope="col">Complemento</th>
                    <th scope="col">Cep</th>
                    <th scope="col">É principal?</th>
                    
                </tr>

            </thead>

            <tbody>
                <!--Foreach para exibição dos dados coletados pela Model-->
                <?php foreach ($model->rowsEndereco as $endereco): ?>
                <tr>
                    <!--Pega o cpf para uso no cadastro-->
                    <div style="display: none;">$cpf = <?= $endereco['cpf_cliente'] ?>;</div>

                    <th scope="row"><?= $endereco['rua'] ?></th>
                    <td><?= $endereco['bairro'] ?></td>
                    <td><?= $endereco['numero'] ?></td>
                    <td><?= $endereco['complemento'] ?></td>
                    <td><?= $endereco['CEP'] ?></td>
                    <td><input type="radio"  <?= $endereco['principal'] == 1 ? 'checked' : '' ?> name="radio-<?= $endereco['CEP'] ?>" disabled></td>
                    <!--Coluna para o botão de edição-->
                    <td>
                      <!--Offcanvas para exibição do formulário de edição-->
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight-<?= $endereco['CEP'] ?>">Editar</button>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight-<?= $endereco['CEP'] ?>">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Editar endereço</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
          
                            <!-- Formulário de edição dentro do Offcanvas-->
                            <div class="offcanvas-body">
                                <form method="POST" action="./endereco/saveEdit">
                                    <input class="form-control" type="hidden" value="<?= $endereco['cpf_cliente'] ?>" name="cpf_cliente">
                                    <b>Rua:</b>
                                    <input class="form-control" type="text" value="<?= $endereco['rua'] ?>" name="rua"><br>
                                    <b>Bairro: </b>
                                    <input class="form-control" value= "<?= $endereco['bairro']?>"name="bairro" type="text" required></input><br>
                                    <b>Numero:</b>
                                    <input class="form-control" type="text" value="<?= $endereco['numero'] ?>" name="numero"><br>
                                    <b>Complemento:</b>
                                    <input class="form-control" type="text" value="<?= $endereco['complemento'] ?>" name="complemento"><br>
                                    <b>CEP:</b>
                                    <input class="form-control" type="text" value="<?= $endereco['CEP'] ?>" name="cep"><br>
                                    Principal?
                                    <input type="radio" class="form-checked-input" name="principal" >
                                    <button class="btn btn-primary">Salvar edição</button>
                                </form>
                                
                            </div>
      
                        </div>
                    </td>
                    <!--Final coluna para o botão de edição-->
      
                    <!--Botão de inativar usuario-->
                    <form method="POST" action="./enderecos/disable">
                        <input value="<?=$endereco['CEP'] ?>" style="display:none" name="cep">
                        <input value="<?=$endereco['cpf_cliente'] ?>" style="display:none" name="cpf">
                        <td><button class="btn btn-danger" type="submit">Inativar</button></td>
                    </form> 
                    <!--Final botão para inativar usuário-->
                  </tr>
                <?php  endforeach ?>
                <!--Final foreach de exibição dos dados-->
                
              </tbody>
        </table>
        <!--Cadastro de novo endereço-->
        <form action="./enderecos/novoEndereco" method="post">

            <div class="card" style="width: 35rem;">

                <div class="card-header">
                  <b>Cadastro de novo endereço</b>
                </div>

                <ul class="list-group list-group-flush">

                  <input value="<?= $cpf ?>" style="display: none;" name="cpf">

                  <li class="list-group-item"><b>CEP: </b><input class="form-control" name="cep" type="text" required></input></li>

                  <li class="list-group-item"><b>Rua: </b><input class="form-control" name="rua" type="text" required></input></li>

                  <li class="list-group-item"><b>Bairro: </b><input class="form-control" name="bairro" type="text" required></input></li>

                  <li class="list-group-item"><b>Numero: </b><input class="form-control" name="numero" type="text" required></input></li>

                  <li class="list-group-item"><b>Complemento (Opcional): </b><input class="form-control" name="complemento" type="text"></input></li>

                  <li class="list-group-item"><button class="btn btn-primary" type="submit">Enviar</button></li>
                </ul>
              </div>
            
            <td></td>
            
        </form>
      </div>
      <!--Adicionando o bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
      //funcao que marca qual endereço é principal
      function enderecoPrincipal(){

        document.addEventListener('DOMContentLoaded',()=>{
          var principal_valor = document.getElementById("principal_valor-<?=  $endereco['CEP']?>");

          var principal_input = document.getElementById("principal_input-<?= $endereco['CEP']?>");

          console.log(principal_input.id)
          console.log(principal_valor.id)
        })

      }

      enderecoPrincipal();
    </script>
</body>
</html>