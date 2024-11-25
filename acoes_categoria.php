<?php
session_start();
require_once('conexao.php');

if (isset($_POST['create_categoria'])) {
    $nome_categoria = mysqli_real_escape_string($conn, $_POST['nome_categoria']);
    $numero_categoria = mysqli_real_escape_string($conn, $_POST['numero_categoria']);

    $sql = "INSERT INTO lista_categoria (nome_categoria, numero_categoria) 
            VALUES ('$nome_categoria', '$numero_categoria')";

    if (mysqli_query($conn, $sql)) {
        header('Location: lista.php');
        exit();
    } else {
        echo "Erro ao inserir a categoria: " . mysqli_error($conn);
    }
}

if (isset($_POST['delete_categoria'])) {

    $id_categoria = mysqli_real_escape_string($conn, $_POST['delete_categoria']);
    
    $sql = "DELETE FROM lista_categoria WHERE id_categoria = '$id_categoria'";
    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "A categoria com o ID {$id_categoria} foi excluída com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Não foi possível excluir a categoria.";
        $_SESSION['type'] = 'error';
    }

    header('Location: lista.php');
    exit;
}

if (isset($_POST['edit_categoria'])) {
    $id_categoria = mysqli_real_escape_string($conn, $_POST['id_categoria']);
    $nome_categoria = mysqli_real_escape_string($conn, $_POST['nome_categoria']);
    $numero_categoria = mysqli_real_escape_string($conn, $_POST['numero_categoria']);

    $sql = "UPDATE lista_categoria SET nome_categoria = '{$nome_categoria}', numero_categoria = '{$numero_categoria}' WHERE id_categoria = '{$id_categoria}'";

    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn) > 0) {
            $_SESSION['message'] = 'Categoria editada com sucesso!';
            $_SESSION['type'] = 'success'; 
        } else {
            $_SESSION['message'] = 'Não foi possível editar a categoria';
            $_SESSION['type'] = 'error';
        }
    } else {
        $_SESSION['message'] = 'Erro ao executar a atualização!';
        $_SESSION['type'] = 'error';
    }

    header("Location: lista.php");
    exit;
}

?>