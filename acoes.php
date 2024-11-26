<?php
session_start();
require_once('conexao.php');


if (isset($_POST['delete_movimentacao'])) {

    $id_mov = mysqli_real_escape_string($conn, $_POST['delete_movimentacao']);

    $sql = "DELETE FROM movimentacoes WHERE id = '$id_mov'";
    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "A movimentação com o ID {$id_mov} foi excluída com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Não foi possível excluir a movimentação.";
        $_SESSION['type'] = 'error';
    }
    header('Location: financas.php');
    exit;
}

if (isset($_POST['edit_movimentacoes'])) {
    $id_mes = mysqli_real_escape_string($conn, $_POST['id_mes']);
    $nome_mes = mysqli_real_escape_string($conn, $_POST['nome_mes']);
    $ano = mysqli_real_escape_string($conn, $_POST['ano']);

    $sql = "UPDATE contabilidade SET nome_mes = '{$nome_mes}', ano = '{$ano}' WHERE id_mes = '{$id_mes}'";

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Mês {$nome_mes} editado com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = 'Não foi possível editar o mês';
        $_SESSION['type'] = 'error';
    }


    header("Location: index.php");
    exit;
}


?>