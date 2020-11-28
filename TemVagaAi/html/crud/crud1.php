<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Tem Vaga Ai!</title>
    <link rel="stylesheet" href="../../css/folhaDeEstiloCadastroCRUD.css">
</head>
<body>

<form action="crud2.php" method="post" id="f1" name="f1">
<?php
    include('connect.php');

    // Se existe GET id e GET mode
    if(isset($_GET['id']) && isset($_GET['mode'])){
        
        if($_GET['id'] != '' && $_GET['mode'] == 'update'){
            $id = $_GET['id'];

            $sql = "SELECT * FROM Usuario WHERE id=$id";
            $result = $conn->query($sql);

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $id = $row['id'];
                    $nome = $row['nome'];
                    $email = $row['email'];
                }            
            }

            echo "
            <table>
                <tr>
                    <td><b>Nome: </b></td>
                    <td><input type='text' id='nome' name='nome' value='$nome'></td>
                </tr>
                <tr>
                    <td><b>Email: </b></td>
                    <td><input type='text' name='email' id='email' value='$email'></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>                
                    <td>
                        <br>
                        <input type='submit' values='SUBMIT'>
                    </td>
                </tr>
            </table>

            <input type='hidden' id='id' name='id' value='$id'>
            <input type='hidden' id='mode' name='mode' value='update'>";

        }
        
    }else{
        
        echo "  <table>
            <tr>
                <td><b>Nome: </b></td>
                <td><input type='text' id='nome' name='nome'></td>
            </tr>
            <tr>
                <td><b>Email: </b></td>
                <td><input type='text' name='email' id='email'></td>
            </tr>
            <tr>
                <td>&nbsp;</td>                
                <td>
                    <br>
                    <input type='submit' values='SUBMIT'>
                </td>
            </tr>
        </table>
        <input type='hidden' id='id' name='id' value='-1'>
        <input type='hidden' id='mode' name='mode' value='insert'>";
    }

    $conn->close();
?>
</form>

<hr>

<table class="list">
    <tr class="list">
        <th class="list">id</th>
        <th class="list">Nome</th>
        <th class="list">Email</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    
<?php # Lista o select do BD

include('connect.php');
$sql = "SELECT * FROM Usuario";
$result = $conn->query($sql);

if($result->num_rows > 0){
    // Coloca na tabela cada linha da tabela do BD
    while($row = $result->fetch_assoc()){
        $id = $row['id'];
        $nome = $row['nome'];
        $email = $row['email'];

        echo "
        <tr class='list'>
            <td class='list'>$id</td>
            <td class='list'>$nome</td>
            <td class='list'>$email</td>
            <td class='action'><a href='crud1.php?mode=update&id=$id'>Editar</a></td>
            <td class='action'><a href='crud2.php?mode=exclude&id=$id'>Excluir</a></td>
        </tr>
        ";

    }            
}else{
    echo "  <tr class='list'>
                <td class='list'>&nbsp;</td>
                <td class='list'>&nbsp;</td>
                <td class='list'>&nbsp;</td>
                <td class='action'>&nbsp;</td>
                <td class='action'>&nbsp;</td>
            </tr>
    ";
}

$conn->close();
?>






    
</body>
</html>