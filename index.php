<?php
session_start();
require_once('conexao.php');

$sql = 'SELECT mov.*, mes.nome_mes, mes.ano, cat.nome_categoria FROM movimentacoes mov
        JOIN meses mes ON mov.data = mes.id_mes
        JOIN lista_categoria cat ON cat.id_categoria = mov.id_categoria';

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
                        <h4>Lista de Finanças</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
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
                                <?php
                                while ($movimentacao = mysqli_fetch_assoc($movimentacoes)) {
                                    $mesAno = $movimentacao['nome_mes'] . '/' . $movimentacao['ano'];
                                    $valor = $movimentacao['valor'];
                                    $categoria = $movimentacao['nome_categoria'];
                                    $descricao = $movimentacao['descricao'];

                                    $saldo += $valor;

                                    echo "<tr>
                                            <td>{$mesAno}</td>                                    
                                            <td>R$ " . number_format($valor, 2, ',','.') . "</td>
                                            <td>{$categoria}</td>
                                            <td>{$descricao}</td>";
                                            if ($valor > 0) {
                                                echo "<td class='green'>+" . number_format($valor, 2, ',', '.') . "</td>";
                                            } else {
                                                "<td class='red'>+" . number_format($valor, 2, ',', '.') . "</td>";
                                            }
                                    echo  "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <table class="table table-bordered table-striped w-25 float-end">
                            <thead>
                                <tr>
                                    <th>Saldo Final:</th>
                                    <td>R$ <?php echo number_format($saldo, 2, ',', '.');?></td>
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