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
    <title>Cadastrar Devedores</title>
</head>
<body onload="loadCompany();">
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
    <h3 class="text-center mt-3 mb-3">Cadastro de devedores</h3>
    <div class="container">    
        <form>
            <div class="form-group">
                <label for="email">Endereço de email</label>
                <input type="email" class="form-control" id="email" placeholder="Seu email">
                <span id="email-error-01" class="text-danger d-none">Este campo é obrigatório</span>
            </div>
            <div class="form-group">
                <label for="address">Endereço</label>
                <input type="text" class="form-control" id="address" placeholder="Seu endereço">
            </div>
            <div class="form-group">
                <label for="type_cod">Tipo</label>
                <select id="type_cod" class="form-control">
                    <option value="cnpj">CNPJ</option>
                    <option value="cpf">CPF</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cod">Código</label>
                <input type="text" class="form-control" id="cod" placeholder="Seu CPF/CNPJ">
                <span id="cod-error-01" class="text-danger d-none">Este campo é obrigatório</span>
            </div>
            <div class="form-group">
                <label for="company_id">Empresa devedora</label>
                <select id="company_id" class="form-control"></select>
                <span id="cod-error-01" class="text-danger d-none">Este campo é obrigatório</span>
            </div>
            <div class="form-group">
                <label for="date_of_birth">Data de nascimento</label>
                <input type="date" class="form-control" id="date_of_birth" placeholder="Sua data de nascimento">
            </div>
            <div class="form-group">
                <label for="description">Descrição do título</label>
                <textarea class="form-control" id="description" placeholder="A descrição do título"></textarea>
                <span id="description-error-01" class="text-danger d-none">Este campo é obrigatório</span>
            </div>
            <div class="form-group">
                <label for="value">Valor do título</label>
                <input type="text" class="form-control" id="value" placeholder="Insira o valor">
                <span id="value-error-01" class="text-danger d-none">Este campo é obrigatório</span>
            </div>
            <button type="button" class="btn btn-primary" onClick="create();">Salvar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/js/debtors/index.js"></script>
    <script type="text/javascript" src="/js/global.js"></script>
</body>
</html>