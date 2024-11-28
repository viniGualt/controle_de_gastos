<nav class="navbar navbar-expand-lg navbar-light bg-light" id="nav">
        <div class="container-fluid p-3 pb-1 pt-1 align-bottom justify-content-between">
            <a href="#nav" class="navbar-brand text-dark mb-0 h1">
                <img src="" height="30vh" class="d-inline-block align-text-top">
                <span id="logo-title">Controle de gastos</span>
            </a>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categoria.php">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="meses.php">Meses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="movimentacoes.php">Movimentações</a>
                    </li>
                </ul>
            </div>
</nav>

<?php 
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
?>