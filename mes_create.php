<?php
session_start();
require_once('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Finanças - Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h1 class="mb-4">Cadastro de Mês</h1>
        <div class="card mb-4">
            <form action="acoes_mes.php" method="POST">
                <div class="card-header">Cadastrar Mês</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="id_mes">Selecione um mês:</label>
                        <select class="form-select" name="nome_mes" id="nome_mes" aria-label="Default select example" required>
                            <option value="" selected>Selecione um mês</option>
                            <option value="1">Janeiro</option>
                            <option value="2">Fevereiro</option>
                            <option value="3">Março</option>
                            <option value="4">Abril</option>
                            <option value="5">Maio</option>
                            <option value="6">Junho</option>
                            <option value="7">Julho</option>
                            <option value="8">Agosto</option>
                            <option value="9">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ano" class="form-label">Ano:</label>
                        <input type="number" id="ano" name="ano" class="form-control" required>
                    </div>
                    <button type="submit" name="mes_create" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>