<?php

include('connect.php');

if($_GET['mode'] == 'exclude'){
    $id = $_GET['id'];    
    $sql = "DELETE FROM Usuario WHERE id=$id";
    $conn->query($sql);
    $conn->close();

}else if($_POST['mode'] == 'insert'){
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];

    $sql = "INSERT INTO Usuario (usuario, senha, email, nome, telefone)
            VALUES ('$usuario', '$senha', '$email', '$nome', '$telefone')";
    $conn->query($sql);
    $conn->close();

}else if($_POST['mode'] == 'update'){

    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];

    $sql = "UPDATE Usuario SET usuario='$usuario', senha='$senha', email='$email',
                    nome='$nome', telefone='$telefone' WHERE id='$id'";
    $conn->query($sql);
    $conn->close();
}

header("Location: crud1.php");
exit();
?>