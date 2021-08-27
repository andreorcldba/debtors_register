<?php
    if( !isset($_SESSION['login'])){
        header("location:../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Cadatrar Empresas</title>
</head>
<body onload="loadUser();">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link text-light" href="/home">Home <span class="sr-only">(página atual)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuários
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/user/list">Lista</a>
                    <a class="dropdown-item" href="/user/create">Cadastro</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Empresas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/company/list">Lista</a>
                    <a class="dropdown-item" href="/company/create">Cadastro</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Devedores
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/debtors/list">Lista</a>
                    <a class="dropdown-item" href="/debtor/create">Cadastro</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Login
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" style="cursor:pointer" onClick="logout();">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <h3 class="text-center mt-3 mb-3">Editar Empresa</h3>
    <div class="container">    
        <form>
            <div class="form-group">
                <label for="email">Endereço de email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Seu email" maxlength="255">
                <span id="email-error-01" class="text-danger d-none">Este campo é obrigatório</span>
            </div>
            <div class="form-group">
                <label for="address">Endereço</label>
                <input type="text" class="form-control" id="address" placeholder="Seu endereço" maxlength="100">
            </div>
            <div class="form-group">
                <label for="cnpj">Cnpj</label>
                <input type="text" class="form-control" id="cnpj" placeholder="Seu cnpj">
                <span id="cnpj-error-01" class="text-danger d-none" maxlength="18">Este campo é obrigatório</span>
            </div>
            <div class="form-group">
                <label for="telephone">Telefone</label>
                <input type="text" class="form-control" id="telephone" placeholder="Seu telefone, ex: (51) 35880829" maxlength="14">
            </div>
            <button type="button" class="btn btn-primary" onClick="create();">Salvar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js"></script>
    <script type="text/javascript" src="/js/company/index.js"></script>
    <script type="text/javascript" src="/js/company/mask.js"></script>
    <script type="text/javascript" src="/js/global.js"></script>
</body>
</html>