<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!--Adicionando o bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="card" style="width: 18rem;">
                
            <form method="POST" action="./login">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <!--Campo de usuário-->
                <h2>Login</h2>
                <b class="form-label">Usuário:</b>
                <input type="text" name="login" class="form-control">

              </li>
              <li class="list-group-item">
                <!--Campo da senha-->

                <b class="form-label">Senha:</b>
                <input type="password" name="senha" class="form-control">

              </li>
              <li class="list-group-item">

            <!--botão para login-->
              <button class="btn btn-primary" type="submit">Entrar</button>
            </form>
                <!--Offcanvas para registro-->
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">Ainda não tem conta?</button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasRightLabel">Registrar-se</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    <!-- Formulário de cadastro dentro do Offcanvas-->
                    <div class="offcanvas-body">
                        <form method="POST" action="./user/register">
                            <b>Login</b>
                            <input type="text" name="login" class="form-control"><br>
                            <b>Senha:</b>
                            <input type="password" name="senha" class="form-control"><br>
                            
                            <button class="btn btn-primary" >Registrar</button>
                            
                            </form>
                        
                        </div>

                </div>
              </li>
            </ul>
            
          </div>
                  
    </div>    
    <!--Adicionando o bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>