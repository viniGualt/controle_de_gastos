<?php
session_start();
require_once('conexao.php');

if (isset($_POST['mes_create'])) {
    $nome_mes = mysqli_real_escape_string($conn, $_POST['nome_mes']);
    $ano = mysqli_real_escape_string($conn, $_POST['ano']);

    $sql = "INSERT INTO meses (nome_mes, ano) VALUES ('$nome_mes', '$ano')";

    if (mysqli_query($conn, $sql)) {
        header('Location: meses.php');
        exit();
    } else {
        echo "Erro ao inserir o mês: " . mysqli_error($conn);
    }
}

if (isset($_POST['delete_mes'])) {

    $id_mes = mysqli_real_escape_string($conn, $_POST['delete_mes']);

    $sql = "DELETE FROM meses WHERE id_mes = '$id_mes'";
    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "O mês com o ID {$id_mes} foi excluída com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Não foi possível excluir o mês.";
        $_SESSION['type'] = 'error';
    }
    header('Location: meses.php');
    exit;
}

if (isset($_POST['edit_mes'])) {
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