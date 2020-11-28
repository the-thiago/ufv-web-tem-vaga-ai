<?php

include('connect.php');

if($_GET['mode'] == 'exclude'){
    $id = $_GET['id'];    
    $sql = "DELETE FROM Usuario WHERE id=$id";
    $conn->query($sql);
    $conn->close();

}else if($_POST['mode'] == 'insert'){
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "INSERT INTO Usuario (nome, email) VALUES ('$nome', '$email')";
    $conn->query($sql);
    $conn->close();

}else if($_POST['mode'] == 'update'){

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "UPDATE Usuario SET nome='$nome', email='$email' WHERE id='$id'";
    $conn->query($sql);
    $conn->close();
}

header("Location: crud1.php");
exit();
?>