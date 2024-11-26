<?php
session_start();
require_once('conexao.php');

$movimentacoes = [];

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: movimentacoes.php');
} else {
    $id_movimentacoes = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM movimentacoes WHERE id = '{$id_movimentacoes}'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $movimentacoes = mysqli_fetch_array($query);
    } else {
        echo "Movimentações não encontrada no banco de dados.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Finanças - Movimentações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'navbar.php';?>
    <div class="container mt-5" style="max-width: 800px; margin: 0 auto;">
        <h1 class="mb-4">Edição da Movimentação</h1>
        <?php if (!empty($movimentacoes)): ?>
            <form action="acoes_movimentacoes.php" method="POST">
                <input type="hidden" name="id_movimentacao  " value="<?= $movimentacoes['id']; ?>">
                <div class="card mb-4 border border-dark">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="valor_movimentacao" class="form-label">Valor da movimentação</label>
                            <input type="text" id="valor_movimentacao" name="valor_movimentacao" class="form-control" value="<?= $movimentacoes['valor'] ?>" required>
                        </div>
                        <button type="submit" name="edit_movimentacao" class="btn btn-primary">Editar movimentacoes</button>
                        <a href="movimentacoes.php" class="btn btn-danger float-end">Voltar</a>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Movimentação não encontrada.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>