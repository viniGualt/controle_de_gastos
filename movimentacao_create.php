<?php
session_start();
require_once('conexao.php');

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

$sqlCategorias = "SELECT * FROM lista_categoria";
$resultCategorias = mysqli_query($conn, $sqlCategorias);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];
    $valor = $_POST['valor'];
    $id_categoria = $_POST['id_categoria'];
    $descricao = $_POST['descricao'];

    if (!empty($data) && !empty($valor) && !empty($id_categoria) && !empty($descricao)) {
        $sqlInsert = "INSERT INTO movimentacoes (data, valor, id_categoria, descricao) VALUES ('$data', '$valor', '$id_categoria', '$descricao')";
        
        if (mysqli_query($conn, $sqlInsert)) {
            $_SESSION['msg'] = "Movimentação cadastrada com sucesso!";
            header("Location: index.php"); 
            exit();
        } else {
            $_SESSION['msg'] = "Erro ao cadastrar movimentação: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['msg'] = "Todos os campos são obrigatórios!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Movimentação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5" style="max-width: 800px; margin: 0 auto;">
        <h1 class="mb-4">Criar Nova Movimentação</h1>
        
        <?php if (isset($_SESSION['msg'])): ?>
            <div class="alert alert-info">
                <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="movimentacao_create.php">
            <div class="mb-3">
                <label for="data" class="form-label">Mês/Ano</label>
                <select name="data" id="data" class="form-select" required>
                    <?php foreach ($meses as $mes_id => $mes_nome): ?>
                        <option value="<?php echo $mes_id; ?>"><?php echo $mes_nome; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="valor" class="form-label">Valor</label>
                <input type="number" step="0.01" name="valor" id="valor" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="id_categoria" class="form-label">Categoria</label>
                <select name="id_categoria" id="id_categoria" class="form-select" required>
                    <?php while ($categoria = mysqli_fetch_assoc($resultCategorias)): ?>
                        <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nome_categoria']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" name="descricao" id="descricao" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar Movimentação</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>