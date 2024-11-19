<?php
session_start();
require_once('conexao.php');

if (isset($_POST['create_usuario'])) {
    $nome = trim($_POST['txtNome']);
    $email = trim($_POST['txtEmail']);
    $dataNascimento = trim($_POST['txtDataNascimento']);

    if (isset($_POST['txtSenha'])) {
        $senha = mysqli_real_escape_string($conn, password_hash(trim($_POST['txtSenha']), PASSWORD_DEFAULT));
    } else {
        $senha = '';
    }

    $sql = "INSERT INTO usuarios (nome, email, data_nascimento, senha) VALUES('$nome', '$email', '$dataNascimento', '$senha')";

    mysqli_query($conn, $sql);

    header('Location: index.php');
    exit();
}

if (isset($_POST['delete_usuario'])) {
    $usuarioId = mysqli_real_escape_string($conn, $_POST['delete_usuario']);
    $sql = "DELETE FROM usuarios WHERE id = '$usuarioId'";  

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Usuário com ID {$usuarioId} excluído com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Ops! Não foi possível excluir o usuário";
        $_SESSION['type'] = 'error';
    }

    header('Location: index.php');
    exit;
}

if (isset($_POST['edit_usuario'])) {
    $usuarioId = mysqli_real_escape_string($conn, $_POST['usuario_id']);
    $nome = mysqli_real_escape_string($conn, $_POST['txtNome']);
    $email = mysqli_real_escape_string($conn, $_POST['txtEmail']);
    $dataNascimento = mysqli_real_escape_string($conn, $_POST['txtDataNascimento']);
    $senha = mysqli_real_escape_string($conn, $_POST['txtSenha']);

    $sql = "UPDATE usuarios SET nome = '{$nome}', email = '{$email}', data_nascimento = '{$dataNascimento}'";

    if (!empty($senha)) {
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        $sql .= ", senha = '{$senha}'";
    }

    $sql .= " WHERE id = '{$usuarioId}'";

    mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Usuário {$usuarioId} atualizado com sucesso!";
        $_SESSION['message'] = 'success';
    } else {
        $_SESSION['message'] = "Não foi possível atualizar o usuário {$usuarioId}.";
        $_SESSION['message'] = 'error';
    }
    
    header('Location: index.php');
    exit;

}