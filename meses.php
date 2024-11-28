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
    <div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 800px; margin: 0 auto;">
        <h1 class="mb-0">Lista de Meses</h1>
        <a href="mes_create.php" class="btn btn-success">Adicionar Mês</a>
        </div>
        <div class="card mb-4 border border-dark" style="max-width: 800px; margin: 0 auto;">
        <div class="card-body">
            <div class="card-body">
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mês</th>
                            <th>Ano</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = 1; ?>
                        <?php foreach ($contabilidades as $contabilidade): ?>
                            <tr>
                                <td><?php echo $contador++; ?></td>
                                <td><?php echo $meses[(int)$contabilidade['nome_mes']]; ?></td>
                                <td><?php echo $contabilidade['ano']; ?></td>
                                <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-3">
                                    <a href="edit_mes.php?id_mes=<?= $contabilidade['id_mes'] ?>" class="btn btn-warning btn-sm">
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