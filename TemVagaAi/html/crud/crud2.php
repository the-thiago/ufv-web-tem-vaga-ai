<?php
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function addFoto($arquivo){
    $extensao = strtolower(substr($_FILES[$arquivo]['name'], -4));
    $novo_nome = md5(time()) . $extensao;
    $diretorio = "../../imagensVagasBD/";
    move_uploaded_file($_FILES[$arquivo]['tmp_name'], $diretorio.$novo_nome);
    return $novo_nome;
}

include('connect.php');

if($_GET['mode'] == 'exclude'){
    $id = $_GET['id']; 

    // Deletando as 3 fotos antigas dos arquivos do servidor
    $sql = "SELECT arquivo1, arquivo2, arquivo3, arquivo4 FROM vaga WHERE id=$id";
    $result = $conn->query($sql);    
    $row = $result->fetch_assoc();
    $nomeFotoAntiga = $row['arquivo1'];
    unlink('../../imagensVagasBD/' . $nomeFotoAntiga);
    $nomeFotoAntiga = $row['arquivo2'];
    unlink('../../imagensVagasBD/' . $nomeFotoAntiga);
    $nomeFotoAntiga = $row['arquivo3'];
    unlink('../../imagensVagasBD/' . $nomeFotoAntiga);
    $nomeFotoAntiga = $row['arquivo4'];
    unlink('../../imagensVagasBD/' . $nomeFotoAntiga);

    $sql = "DELETE FROM vaga WHERE id=$id";
    $conn->query($sql);
    $conn->close();

}else if($_POST['mode'] == 'insert'){
    
    $nome = test_input($_POST['nome']);
    $descricao = test_input($_POST['descricao']);
    $diaria = test_input($_POST['diaria']);
    $cidade = test_input($_POST['cidade']);

    $novo_nome1 = addFoto('arquivo1'); // Adiciona a foto nos arquivos do servidor
    sleep(1); // Para nao add tudo muito rapido, ja que o nome da foto depende do tempo
    $novo_nome2 = addFoto('arquivo2');
    sleep(1);
    $novo_nome3 = addFoto('arquivo3');
    sleep(1);
    $novo_nome4 = addFoto('arquivo4');

    $sql = "INSERT INTO vaga (nome, descricao, diaria, cidade, arquivo1, arquivo2, arquivo3, arquivo4)
    VALUES ('$nome', '$descricao', '$diaria', '$cidade', '$novo_nome1', '$novo_nome2', '$novo_nome3', '$novo_nome4')";
    $conn->query($sql);
    $conn->close();


}else if($_POST['mode'] == 'update'){

    $id = $_POST['id'];
    $nome = test_input($_POST['nome']);
    $descricao = test_input($_POST['descricao']);
    $diaria = test_input($_POST['diaria']);
    $cidade = test_input($_POST['cidade']);

    // Deletando a foto antiga nos arquivos do servidor
    $sql = "SELECT arquivo1, arquivo2, arquivo3, arquivo4 FROM vaga WHERE id=$id";
    $result = $conn->query($sql);    
    $row = $result->fetch_assoc();
    $nomeFotoAntiga = $row['arquivo1'];
    unlink('../../imagensVagasBD/' . $nomeFotoAntiga);
    $nomeFotoAntiga = $row['arquivo2'];
    unlink('../../imagensVagasBD/' . $nomeFotoAntiga);
    $nomeFotoAntiga = $row['arquivo3'];
    unlink('../../imagensVagasBD/' . $nomeFotoAntiga);
    $nomeFotoAntiga = $row['arquivo4'];
    unlink('../../imagensVagasBD/' . $nomeFotoAntiga);

    // Adiciona as novas fotos no servidor e muda o nome delas no BD
    $novo_nome1 = addFoto('arquivo1'); // Adiciona a foto nos arquivos do servidor
    sleep(1); // Para nao add tudo muito rapido, ja que o nome da foto depende do tempo
    $novo_nome2 = addFoto('arquivo2');
    sleep(1);
    $novo_nome3 = addFoto('arquivo3');
    sleep(1);
    $novo_nome4 = addFoto('arquivo4');

    $sql = "UPDATE vaga SET nome='$nome', descricao='$descricao', diaria='$diaria',
                    cidade='$cidade', arquivo1='$novo_nome1',
                    arquivo2='$novo_nome2', arquivo3='$novo_nome3', arquivo4='$novo_nome4' WHERE id='$id'";
    $conn->query($sql);
    $conn->close();

}

header("Location: crud1.php");
exit();
?>