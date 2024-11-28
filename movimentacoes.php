<?php
session_start();
require_once('conexao.php');

$data = 1;
$sql = "SELECT mov.*, mes.nome_mes, mes.ano, cat.nome_categoria, cat.numero_categoria FROM movimentacoes mov
        JOIN meses mes ON mov.data = mes.id_mes
        JOIN lista_categoria cat ON cat.id_categoria = mov.id_categoria 
        WHERE `data` = $data";

$movimentacoes = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./src/style.css">
    <title>movimentacao</title>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="card-header">
            <h3 class="mb-4 d-inline">Lista de Movimentações</h3>
            <a href="movimentacao_create.php" class="btn btn-success rounded-circle float-end">+</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mês/Ano</th>
                        <th>Valor</th>
                        <th>Categoria</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($movimentacoes as $movimentacao): ?>
                        <tr>
                            <td><?php echo $movimentacao['id']; ?></td>
                            <td><?php echo $meses[$movimentacao['data']] . "/" . $movimentacao['ano']; ?></td>
                            <td><?php echo $movimentacao['valor']; ?></td>
                            <td><?php echo $movimentacao['nome_categoria']; ?></td>
                            <td><?php echo $movimentacao['descricao']; ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="edit_movimentacao.php?id=<?= $movimentacao['id'] ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>Editar</a>
                                    <form action="acoes_movimentacao.php" method="POST" class="d-inline">
                                        <button onclick="return confirm('Tem certeza que deseja excluir?')" name="delete_movimentacao" type="submit" value="<?= $movimentacao['id']; ?>" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i>Excluir
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./src/script.js"></script>
</body>

</html>