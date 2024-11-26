<?php
session_start();
require_once('conexao.php');

$categoria = [];

if (!isset($_GET['id_categoria']) || empty($_GET['id_categoria'])) {
    header('Location: categoria.php');
} else {
    $id_categoria = mysqli_real_escape_string($conn, $_GET['id_categoria']);
    $sql = "SELECT * FROM lista_categoria WHERE id_categoria = '{$id_categoria}'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $categoria = mysqli_fetch_array($query);
    } else {
        echo "Categoria não encontrada no banco de dados.";
        exit();
    }
}
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
   <?php include 'navbar.php';?>

    <div class="container mt-5" style="max-width: 800px; margin: 0 auto;">
        <h1 class="mb-4">Edição da Categoria</h1>
        <?php if (!empty($categoria)): ?>
            <form action="acoes_categoria.php" method="POST">
                <input type="hidden" name="id_categoria" value="<?= $categoria['id_categoria']; ?>">
                <div class="card mb-4 border border-dark">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nome_categoria" class="form-label">Nome da Categoria</label>
                            <input type="text" id="nome_categoria" name="nome_categoria" class="form-control" value="<?= $categoria['nome_categoria'] ?>" required>
                        </div>
                        <a href="categoria.php" class="btn btn-danger">Voltar</a>
                        <button type="submit" name="edit_categoria" class="btn btn-primary float-end">Editar categoria</button>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Categoria não encontrada.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>