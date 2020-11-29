<?php
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    echo "to aqui!";
    return $data;
}
function usuarioSenhaValidos($usuario, $senha){
    if(empty($usuario) || empty($senha)) {
        return false;
    }
    return true;
}

include('connect.php');

if($_GET['mode'] == 'exclude'){
    $id = $_GET['id'];    
    $sql = "DELETE FROM vaga WHERE id=$id";
    $conn->query($sql);
    $conn->close();

}else if($_POST['mode'] == 'insert'){
    
    $nome = test_input($_POST['nome']);
    $descricao = test_input($_POST['descricao']);
    $diaria = test_input($_POST['diaria']);
    $caminhoFoto = test_input($_POST['caminhoFoto']);
    $cidade = test_input($_POST['cidade']);
          
    $sql = "INSERT INTO vaga (nome, descricao, diaria, caminhoFoto, cidade)
            VALUES ('$nome', '$descricao', '$diaria', '$caminhoFoto', '$cidade')";
    $conn->query($sql);
    $conn->close();
      

}else if($_POST['mode'] == 'update'){

    $id = $_POST['id'];
    $nome = test_input($_POST['nome']);
    $descricao = test_input($_POST['descricao']);
    $diaria = test_input($_POST['diaria']);
    $caminhoFoto = test_input($_POST['caminhoFoto']);
    $cidade = test_input($_POST['cidade']);
    
    $sql = "UPDATE vaga SET nome='$nome', descricao='$descricao', diaria='$diaria',
                    caminhoFoto='$caminhoFoto', cidade='$cidade' WHERE id='$id'";
    $conn->query($sql);
    $conn->close();
    
}

header("Location: crud1.php");
exit();
?>