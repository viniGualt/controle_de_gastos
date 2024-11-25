<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'tarefas';

$conn = mysqli_connect($host, $usuario, $senha, $banco) or die('Não foi possível conectar-se ao banco');

?>