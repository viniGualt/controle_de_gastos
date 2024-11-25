<?php
session_start();
require_once('conexao.php');

$sql = 'SELECT * FROM tabela';

// $tabela = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./src/style.css">
    <title>Contabilidade</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="nav">
        <div class="container-fluid p-3 pb-1 pt-1 align-bottom justify-content-between">
            <a href="#nav" class="navbar-brand text-dark mb-0 h1">
                <img src="" height="30vh" class="d-inline-block align-text-top">
                <span id="logo-title">Controle de gastos</span>
            </a>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categoria.php">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="meses.php">Meses</a>
                    </li>
                </ul>
            </div>
            <a href="#" class="btn btn-success float-end text-light"><b>Adicionar</b></a>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de finanças</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Movimentação</th>
                                    <th>Categoria</th>
                                    <th>Descrição</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Janeiro/2024</td>
                                    <td>R$ 200,00</td>
                                    <td>Alimentação</td>
                                    <td>Gasto com McDonalds</td>
                                    <td class="green">+R$200,00</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered table-striped w-25 float-end">
                            <thead>
                                <tr>
                                    <th>Saldo Final:</th>
                                    <td>R$ 200,00</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./src/script.js"></script>
</body>

</html>