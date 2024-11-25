<?php
session_start();
require_once('conexao.php');

$sql = "SELECT * FROM lista_categoria";
$categorias = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Finanças - Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 800px; margin: 0 auto;">
            <h1 class="mb-0">Lista de Categorias</h1>
            <a href="categoria_create.php" class="btn btn-success">Adicionar categoria</a>
        </div>
        <div class="card mb-4 border border-dark" style="max-width: 800px; margin: 0 auto;">
            <div class="card-body">
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Categoria</th>
                            <th>Gastos</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorias as $categoria): ?>
                            <tr>
                                <td><?php echo $categoria['numero_categoria']; ?></td>
                                <td><?php echo $categoria['nome_categoria']; ?></td>
                                <td><?php echo $categoria['gasto_categoria']; ?></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-3">
                                        <a href="consulta_categoria.php?id=<?= $categoria['id_categoria'] ?>" class="btn btn-primary btn-sm">
                                            Consultar
                                        </a>
                                        <a href="edit_categoria.php?id_categoria=<?= $categoria['id_categoria'] ?>" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-fill"></i> Editar
                                        </a>
                                        <form action="acoes_categoria.php" method="POST" class="d-inline">
                                            <button onclick="return confirm('Excluir categoria?')" name="delete_categoria" type="submit" value="<?= $categoria['id_categoria']; ?>" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash-fill"></i> Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>