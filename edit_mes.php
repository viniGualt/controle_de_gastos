<?php
session_start();
require_once('conexao.php');

$contabilidade = [];

if (!isset($_GET['id_mes']) || empty($_GET['id_mes'])) {
    header('Location: meses.php');
    exit();
} else {
    $id_mes = mysqli_real_escape_string($conn, $_GET['id_mes']);

    $sql = "SELECT * FROM meses WHERE id_mes = '{$id_mes}'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $contabilidade = mysqli_fetch_array($query);
    } else {
        echo "Mês não encontrada no banco de dados.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Finanças - Meses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5" style="max-width: 800px; margin: 0 auto;">
        <h1 class="mb-4">Edição do Mês</h1>
        <?php if (!empty($contabilidade)): ?>
           <form action="acoes_mes.php" method="POST">
    <input type="hidden" name="id_mes" value="<?= $contabilidade['id_mes']; ?>">
    <div class="card mb-4 border border-dark">
        <div class="card-body">
            <div class="mb-3">
                <label for="nome_mes" class="form-label">Nome do Mês</label>
                <select class="form-select" name="nome_mes" id="nome_mes">
                    <option value="1" <?= $contabilidade['nome_mes'] == 1 ? 'selected' : ''; ?>>Janeiro</option>
                    <option value="2" <?= $contabilidade['nome_mes'] == 2 ? 'selected' : ''; ?>>Fevereiro</option>
                    <option value="3" <?= $contabilidade['nome_mes'] == 3 ? 'selected' : ''; ?>>Março</option>
                    <option value="4" <?= $contabilidade['nome_mes'] == 4 ? 'selected' : ''; ?>>Abril</option>
                    <option value="5" <?= $contabilidade['nome_mes'] == 5 ? 'selected' : ''; ?>>Maio</option>
                    <option value="6" <?= $contabilidade['nome_mes'] == 6 ? 'selected' : ''; ?>>Junho</option>
                    <option value="7" <?= $contabilidade['nome_mes'] == 7 ? 'selected' : ''; ?>>Julho</option>
                    <option value="8" <?= $contabilidade['nome_mes'] == 8 ? 'selected' : ''; ?>>Agosto</option>
                    <option value="9" <?= $contabilidade['nome_mes'] == 9 ? 'selected' : ''; ?>>Setembro</option>
                    <option value="10" <?= $contabilidade['nome_mes'] == 10 ? 'selected' : ''; ?>>Outubro</option>
                    <option value="11" <?= $contabilidade['nome_mes'] == 11 ? 'selected' : ''; ?>>Novembro</option>
                    <option value="12" <?= $contabilidade['nome_mes'] == 12 ? 'selected' : ''; ?>>Dezembro</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="ano" class="form-label">Ano</label>
                <input type="number" id="ano" name="ano" min="2000" max="2050" class="form-control" value="<?= $contabilidade['ano'] ?>" required>
            </div>
            <button type="submit" name="edit_mes" class="btn btn-primary">Salvar</button>
        </div>
    </div>
</form>
        <?php else: ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Mês não encontrado.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>