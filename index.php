<?php
session_start();
require_once('conexao.php');

$sql = 'SELECT mov.*, mes.nome_mes, mes.ano, cat.nome_categoria FROM movimentacoes mov
        JOIN meses mes ON mov.data = mes.id_mes
        JOIN lista_categoria cat ON cat.id_categoria = mov.id_categoria';

$sqlMeses = "SELECT * FROM meses ORDER BY ano, id_mes";
$queryMeses = mysqli_query($conn, $sqlMeses);

if (isset($_GET['filtro_mes']) && !empty($_GET['filtro_mes'])) {
    $filtroMes = $_GET['filtro_mes'];
} else {
    $filtroMes = null;
}

if ($filtroMes) {
    $sql .= " WHERE mes.id_mes = " . intval($filtroMes);
}

$movimentacoes = mysqli_query($conn, $sql);

$saldo = 0;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./src/style.css">
    <title>Contabilidade</title>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="d-inline-flex">Lista de Finanças</h4>
                        <form method="GET" class="d-flex align-items-center">
                            <select name="filtro_mes" class="form-select me-2" style="width: auto;">
                                <option value="">Todos os meses</option>
                                <?php foreach ($queryMeses as $mes): ?>
                                    <option value="<?= $mes['id_mes']; ?>" <?php if ($filtroMes == $mes['id_mes']) {
                                                                                echo 'selected';
                                                                            } ?>>
                                        <?= $meses[$mes['nome_mes']] . ' / ' . $mes['ano']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped w-100 mb-3">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Movimentação</th>
                                    <th>Categoria</th>
                                    <th>Descrição</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($movimentacoes as $movimentacao): ?>
                                    <tr>
                                        <td><?php echo $meses[$movimentacao['nome_mes']] . '/' . $movimentacao['ano']; ?></td>
                                        <td>R$ <?php echo number_format($movimentacao['valor'], 2, ',', '.'); ?></td>
                                        <td><?php echo $movimentacao['nome_categoria']; ?></td>
                                        <td><?php echo $movimentacao['descricao']; ?></td>
                                        <td class="<?php if ($movimentacao['valor'] > 0) {
                                                        echo 'green';
                                                    } elseif ($movimentacao['valor'] == 0) {
                                                        echo 'yellow';
                                                    } else {
                                                        echo 'red';
                                                    }; ?>">
                                            R$ <?php echo number_format($movimentacao['valor'], 2, ',', '.'); ?>
                                        </td>
                                    </tr>
                                    <?php $saldo += $movimentacao['valor']; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <table class="table table-bordered table-striped w-25 float-end">
                            <thead>
                                <tr>
                                    <th>Saldo Final:</th>
                                    <td class="<?php if ($saldo > 0) {
                                                    echo 'green';
                                                } elseif ($saldo == 0) {
                                                    echo 'yellow';
                                                } else {
                                                    echo 'red';
                                                }
                                                ?>">
                                        R$ <?php echo number_format($saldo, 2, ',', '.'); ?>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./src/script.js"></script>
</body>

</html>