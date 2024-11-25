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
    <div class="container mt-5" style="max-width: 800px; margin: 0 auto;">
        <h1 class="mb-4">Cadastro de Categorias</h1>
        <div class="card mb-4">
            <form action="acoes_categoria.php" method="POST">
                <div class="card-header fw-bold">Cadastrar Categoria</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nome_categoria" class="form-label">Nome da Categoria</label>
                        <input type="text" id="nome_categoria" name="nome_categoria" class="form-control" placeholder="Ex: Alimentação" required>
                    </div>
                    <div class="mb-3">
                        <label for="numero_categoria" class="form-label">Número da Categoria</label>
                        <input type="number" id="numero_categoria" name="numero_categoria" class="form-control" required>
                    </div>
                    <button type="submit" name="create_categoria" class="btn btn-primary">Salvar</button>
                    <a href="categoria.php" class="btn btn-danger float-end">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</body>