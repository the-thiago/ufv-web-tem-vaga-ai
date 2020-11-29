<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Tem Vaga Ai!</title>
    <link rel="stylesheet" href="../../css/IdentidadeVisual.css">
    <link rel="stylesheet" href="../../css/folhaDeEstiloCadastroCRUD.css">
    <script src="../../scripts/funcoes.js"></script>
    <script>
        function fnSubmit(){
            /*
            var continuar = confirm("Clique em 'Ok', para confirmar as alterações.");
            if(continuar){

                var teveErro = false;
                var erros = "";
                var usuario = document.getElementById('usuario');
                var senha = document.getElementById('senha');
                var email = document.getElementById('email');
                var nome = document.getElementById('nome');
                var telefone = document.getElementById('telefone');

                if(usuario.length > 25 || usuario.length == 0){
                    erros += "Tamanho invalido para usuario!\n";
                    teveErro = true;
                } else if(senha.length > 50 || senha.length == 0){
                    erros += "Tamanho invalido para senha!\n";
                    teveErro = true;
                } else if(email.length > 80 || email.length == 0){
                    erros += "Tamanho invalido para email!\n";
                    teveErro = true;
                } else if(nome.length > 250 ){
                    erros += "Tamanho de 'nome' é maior que 250!\n";
                    teveErro = true;
                } else if(telefone.length > 11){
                    erros += "Tamanho de 'telefone' é maior que 11!\n";
                    teveErro = true;
                }
                if(teveErro == false){
                    document.getElementById('f1').submit();
                } else {
                    alert(erros);
                }
            }*/
            var continuar = confirm("Clique em 'Ok', para confirmar as alterações.");
            if(continuar){
                document.getElementById('f1').submit();
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


<!-- div aviso do covid-19 -->
<div id="aviso">
    <div class="AvisoEsquerda" id="AvisoEsquerda">
        COVID-2019: Seguimos todas as medidas de segurança à risca.
        Saiba mais clicando
        <a href="https://coronavirus.saude.gov.br/">aqui.</a>
    </div>
    <div class="AvisoDireita">
        <button id="BotaoAvisoCovid" onclick="fecharAvisoCovid()">X</button>
    </div>
</div>
<!-- div topo da pagina-->
<div id="cabecalho">
    <a href="../../index.html">
        <img id="logo" src="../../imagens/LOGO TEM VAGA AI.png" alt="logo">
    </a>
    <form action="../../html/paginaresultados2.html" form="entrada">
        <input type="text" id="pesuisa" name="pesquisa" placeholder="Buscar..." class="TextoPesquisar">
    </form>

    <form action="../../html/paginaresultados2.html" id="entrada">
        <select id="Categorias" name="Categorias" form="entrada">
            <option value="Chacaras">Chacaras</option>
            <option value="Apartamentos">Apartamentos</option>
            <option value="Ranchos Rios">Ranchos Rios</option>
            <option value="Casas Beira Mar">Casas Beira Mar</option>
        </select>
        <select id="Cidades" name="Cidades" form="entrada">
            <option value="Rio Paranaiba">Rio Paranaiba</option>
            <option value="São Gotardo">São Gotardo</option>
            <option value="Tres Marias">Tres Marias</option>
            <option value="Rio de Janeiro">Rio de Janeiro</option>
        </select>
        <input type="submit">
    </form>

    <ul id="BotoesMenu">
        <li class="Menu"> <a class="Menu" href="http://localhost/TemVagaAiProjeto/TemVagaAi/html/crud/crud1.php">Cadastro</a> </li>
        <li class="Menu"> <a class="Menu" href="#AvisosMensagens">Avisos e Mensagens</a> </li>
        <li class="Menu"> <a class="Menu" href="#Login">Login</a> </li>
    </ul>
</div>

<div id="formInserirExterna">
    <div id="formInserirInterna">
        <h3 class="obrigatorio">*E-mail deve ser único, usuario e senha são obrigatórios. Telefone apenas números e no máximo 11 números.</h3>
        <form action="crud2.php" method="post" id="f1" name="f1">
        <?php
            include('connect.php');

            // Se existe GET id e GET mode
            if(isset($_GET['id']) && isset($_GET['mode'])){
                
                if($_GET['id'] != '' && $_GET['mode'] == 'update'){
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM vaga WHERE id=$id";
                    $result = $conn->query($sql);

                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $id = $row['id'];
                            $nome = $row['nome'];
                            $descricao = $row['descricao'];
                            $diaria = $row['diaria'];
                            $caminhoFoto = $row['caminhoFoto'];
                            $cidade = $row['cidade'];                    
                        }            
                    }

                    echo "
                    <table>            
                        <tr>
                            <td><b>Nome: </b></td>
                            <td><input type='text' name='nome' id='nome' value='$nome'></td>
                        </tr>
                        <tr>
                            <td><b>Descricao: </b></td>
                            <td><input type='text' id='descricao' name='descricao' value='$descricao'></td>
                        </tr>
                        <tr>
                            <td><b>Diaria: </b></td>
                            <td><input type='text' name='diaria' id='diaria' value='$diaria'></td>
                        </tr>
                        <tr>
                            <td><b>CaminhoFoto: </b></td>
                            <td><input type='text' name='caminhoFoto' id='caminhoFoto' value='$caminhoFoto'></td>
                        </tr>
                        <tr>
                            <td><b>Cidade: </b></td>
                            <td><input type='text' name='cidade' id='cidade' value='$cidade'></td>
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
                        <td><b>Nome: </b></td>
                        <td><input type='text' name='nome' id='nome'></td>
                    </tr>
                    <tr>
                        <td><b>Descricao: </b></td>
                        <td><input type='text' id='descricao' name='descricao'></td>
                    </tr>
                    <tr>
                        <td><b>Diaria: </b></td>
                        <td><input type='text' name='diaria' id='diaria'></td>
                    </tr>
                    <tr>
                        <td><b>CaminhoFoto: </b></td>
                        <td><input type='text' id='caminhoFoto' name='caminhoFoto'></td>
                    </tr>
                    <tr>
                        <td><b>Cidade: </b></td>
                        <td><input type='text' name='cidade' id='cidade'></td>
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
    </div>
</div>

<hr>

<table class="list">
    <tr class="list">
        <th class="list">id</th>
        <th class="list">nome</th>
        <th class="list">descricao</th>
        <th class="list">diaria</th>
        <th class="list">caminhoFoto</th>
        <th class="list">cidade</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    
<?php # Lista o select do BD

include('connect.php');
$sql = "SELECT * FROM vaga";
$result = $conn->query($sql);

if($result->num_rows > 0){
    // Coloca na tabela cada linha da tabela do BD
    while($row = $result->fetch_assoc()){
        $id = $row['id'];
        $nome = $row['nome'];
        $descricao = $row['descricao'];
        $diaria = $row['diaria'];
        $caminhoFoto = $row['caminhoFoto'];
        $cidade = $row['cidade'];    
        

        echo "
        <tr class='list'>
            <td class='list'>$id</td>
            <td class='list'>$nome</td>
            <td class='list'>$descricao</td>
            <td class='list'>$diaria</td>
            <td class='list'>$caminhoFoto</td>
            <td class='list'>$cidade</td>
            
            
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