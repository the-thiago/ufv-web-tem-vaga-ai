<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Tem Vaga Ai!</title>
    <link rel="stylesheet" href="../../css/folhaDeEstiloCadastroCRUD.css">
    <script src="../../scripts/funcoes.js"></script>
    <script>
        function fnSubmit(){
            var continuar = confirm("Clique em 'Ok', para confirmar as alterações.");
            if(continuar){

                var teveErro = false;
                var erros = "";
                var usuario = document.getElementById('usuario');
                var senha = document.getElementById('senha');
                var email = document.getElementById('email');
                var nome = document.getElementById('nome');
                var telefone = document.getElementById('telefone');

                if(usuario.length > 25){
                    erros += "Tamanho de 'usuario' é maior que 25!\n";
                    teveErro = true;
                } else if(senha.length > 50){
                    erros += "Tamanho de 'senha' é maior que 50!\n";
                    teveErro = true;
                } else if(email.length > 80){
                    erros += "Tamanho de 'email' é maior que 80!\n";
                    teveErro = true;
                } else if(nome.length > 250){
                    erros += "Tamanho de 'nome' é maior que 250!\n";
                    teveErro = true;
                } else if(telefone.length > 11){
                    erros += "Tamanho de 'telefone' é maior que 11!\n";
                    teveErro = true;
                }
                if(teveErro == false){
                    document.getElementById('f1').submit();
                } else {
                    alert("Tente novamente.\n" + erros);
                }
            }
        }
        function fnExclude(id){
            var continuar = confirm("Clique em 'Ok', para excluir o registro.");
            if(continuar){
                document.getElementById('f1').submit();
                window.location.replace("crud2.php?mode=exclude&id="+id);
            }
        }
        function fnEditar(id){
            window.location.replace("crud1.php?mode=update&id="+id);
        }
    </script>
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
                    $usuario = $row['usuario'];
                    $senha = $row['senha'];
                    $email = $row['email'];
                    $nome = $row['nome'];
                    $telefone = $row['telefone'];                    
                }            
            }

            echo "
            <table>            
                <tr>
                    <td><b>Email: </b></td>
                    <td><input type='text' name='email' id='email' value='$email'></td>
                </tr>
                <tr>
                    <td><b>Usuario: </b></td>
                    <td><input type='text' id='usuario' name='usuario' value='$usuario'></td>
                </tr>
                <tr>
                    <td><b>Senha: </b></td>
                    <td><input type='text' name='senha' id='senha' value='$senha'></td>
                </tr>
                <tr>
                    <td><b>Nome: </b></td>
                    <td><input type='text' id='nome' name='nome' value='$nome'></td>
                </tr>
                <tr>
                    <td><b>Telefone: </b></td>
                    <td><input type='text' name='telefone' id='telefone' value='$telefone'></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>                
                    <td>
                        <br>
                        <input type='button' onclick='fnSubmit();' value='Enviar'>   
                    </td>
                </tr>
            </table>

            <input type='hidden' id='id' name='id' value='$id'>
            <input type='hidden' id='mode' name='mode' value='update'>";

        }
        
    }else{
        
        echo "  <table>
            <tr>
                <td><b>Email: </b></td>
                <td><input type='text' name='email' id='email'></td>
            </tr>
            <tr>
                <td><b>Usuario: </b></td>
                <td><input type='text' id='usuario' name='usuario'></td>
            </tr>
            <tr>
                <td><b>Senha: </b></td>
                <td><input type='text' name='senha' id='senha'></td>
            </tr>
            <tr>
                <td><b>Nome: </b></td>
                <td><input type='text' id='nome' name='nome'></td>
            </tr>
            <tr>
                <td><b>Telefone: </b></td>
                <td><input type='text' name='telefone' id='telefone'></td>
            </tr>
            <tr>
                <td>&nbsp;</td>                
                <td>
                    <br>
                    <input type='button' onclick='fnSubmit();' value='Enviar'>                    
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
        <th class="list">email</th>
        <th class="list">usuario</th>
        <th class="list">senha</th>
        <th class="list">nome</th>
        <th class="list">telefone</th>
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
        $email = $row['email'];
        $usuario = $row['usuario'];
        $nome = $row['nome'];
        $senha = $row['senha'];
        $telefone = $row['telefone'];
        

        echo "
        <tr class='list'>
            <td class='list'>$id</td>
            <td class='list'>$email</td>
            <td class='list'>$usuario</td>
            <td class='list'>$senha</td>
            <td class='list'>$nome</td>
            <td class='list'>$telefone</td>
            
            
            <td class='action'>
                <input type='button' onclick='fnEditar($id);' value='Editar'>
            </td>         
            <td class='action'>
                <input type='button' onclick='fnExclude($id);' value='Excluir'>
            </td>
        </tr>
        ";

    }            
}else{
    echo "  <tr class='list'>
                <td class='list'>&nbsp;</td>
                <td class='list'>&nbsp;</td>
                <td class='list'>&nbsp;</td>
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