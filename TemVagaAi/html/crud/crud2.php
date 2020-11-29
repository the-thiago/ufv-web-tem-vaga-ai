<?php
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    echo "to aqui!";
    return $data;
}
function emailExistente($email){
    include('connect.php');
    $sql = "SELECT COUNT(*) FROM Usuario WHERE email=$email";
    $result = $conn->query($sql);
    if($result > 0){
        echo "<script type='javascript'>alert('Email já cadastrado!');</script>";
        return true;
    }
    return false;
}
function emailValido($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
function usuarioSenhaValidos($usuario, $senha){
    if(empty($usuario) || empty($senha)) {
        return false;
    }
    return true;
}
function telefoneValido($telefone){
    if( is_int((int)$telefone)) {
        return true;
    }
    return false;
}

include('connect.php');

if($_GET['mode'] == 'exclude'){
    $id = $_GET['id'];    
    $sql = "DELETE FROM Usuario WHERE id=$id";
    $conn->query($sql);
    $conn->close();

}else if($_POST['mode'] == 'insert'){
    $usuario = test_input($_POST['usuario']);
    $senha = test_input($_POST['senha']);
    $email = test_input($_POST['email']);
    if(emailExistente($email) == false && emailValido($email) && usuarioSenhaValidos($usuario, $senha) && telefoneValido($telefone)){
        $nome = test_input($_POST['nome']);
        $telefone = test_input($_POST['telefone']);

        $sql = "INSERT INTO Usuario (usuario, senha, email, nome, telefone)
                VALUES ('$usuario', '$senha', '$email', '$nome', '$telefone')";
        $conn->query($sql);
        $conn->close();
    }    

}else if($_POST['mode'] == 'update'){

    $id = $_POST['id'];
    $usuario = test_input($_POST['usuario']);
    $senha = test_input($_POST['senha']);
    $email = test_input($_POST['email']);
    if(emailExistente($email) == false && emailValido($email) && usuarioSenhaValidos($usuario, $senha) && telefoneValido($telefone)){
        $nome = test_input($_POST['nome']);
        $telefone = test_input($_POST['telefone']);

        $sql = "UPDATE Usuario SET usuario='$usuario', senha='$senha', email='$email',
                        nome='$nome', telefone='$telefone' WHERE id='$id'";
        $conn->query($sql);
        $conn->close();
    }
}

header("Location: crud1.php");
exit();
?>