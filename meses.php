<?php
session_start();
require_once('conexao.php');

$contabilidades = [];

$meses = [
    1 => 'Janeiro',
    2 => 'Fevereiro',
    3 => 'Março',
    4 => 'Abril',
    5 => 'Maio',
    6 => 'Junho',
    7 => 'Julho',
    8 => 'Agosto',
    9 => 'Setembro',
    10 => 'Outubro',
    11 => 'Novembro',
    12 => 'Dezembro'
];

$sql = "SELECT * FROM meses";
$contabilidade_result = mysqli_query($conn, $sql);

if ($contabilidade_result) {
    while ($contabilidade = mysqli_fetch_assoc($contabilidade_result)) {
        $contabilidades[] = $contabilidade;
    }
} else {
    echo "Erro ao carregar os meses: " . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Finanças - Meses</title>
    <link rel="stylesheet" href="./src/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Meses</h1>
        <div class="table">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="mes_create.php" class="btn btn-success">Adicionar Mês</a>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mês</th>
                            <th>Ano</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contabilidades as $contabilidade): ?>
                            <tr>
                                <td><?php echo $contabilidade['id_mes']; ?></td>
                                <td><?php echo $meses[$contabilidade['nome_mes']]; ?></td>
                                <td><?php echo $contabilidade['ano']; ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="edit_mes.php?id=<?= $contabilidade['id_mes'] ?>" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-fill"></i>Editar</a>
                                        <form action="acoes_mes.php" method="POST" class="d-inline">
                                            <button onclick="return confirm('Tem certeza que deseja excluir?')" name="delete_mes" type="submit" value="<?= $contabilidade['id_mes']; ?>" class="btn btn-danger btn-sm">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>