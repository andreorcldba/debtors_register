<?php
    if(isset($_SESSION['login'])){
        header("location:../home");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/auth/styles.css" type="text/css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <form class="bg-white">
            <div class="form-group">
                <label for="email">Endereço de email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Seu email">
                <span id="email-error-01" class="text-danger d-none">Este campo é obrigatório</span>
                <span id="email-error-02" class="text-danger d-none">Usuário ou senha inválido</span>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" placeholder="Senha">
                <span id="password-error-01" class="text-danger d-none">Este campo é obrigatório</span>
                <span id="password-error-02" class="text-danger d-none">Usuário ou senha inválido</span>
            </div>
            <button type="button" class="btn btn-primary" onClick="auth();">Acessar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/auth/index.js"></script>
</body>
</html>