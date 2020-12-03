<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Tem Vaga Ai!</title>
    <link id="temaPrincipal" rel="stylesheet" href="../../css/IdentidadeVisual.css">
    <link id="temaSecundario"  rel="stylesheet" href="../../css/folhaDeEstiloCadastroCRUD.css">
    <script src="../../scripts/funcoes.js"></script>
    <script>
        function test_input(data){
            data = data.trim();
            data = data.replace('&', '&amp;').replace('<', '&lt;');
            data = data.replace('>', '&gt;').replace('"', '&quot;').replace("'", '&#039');
            return data;
        }
        function verificacoes(){
            var teveErro = false;
            var erros = "ERRO!\n";
            var nome = test_input(document.getElementById('nome').value);
            var descricao = test_input(document.getElementById('descricao').value);
            var diaria = test_input(document.getElementById('diaria').value);
            var caminhoFoto = test_input(document.getElementById('caminhoFoto').value);            
            var cidade = test_input(document.getElementById('cidade').value);
            if(nome == null || nome == ""){
                teveErro = true;
                erros += "Nome está vazio!\n";
            }
            if(descricao == null || descricao == ""){
                teveErro = true;
                erros += "Descrição está vazio!\n";
            }
            if(diaria == null || diaria == ""){
                teveErro = true;
                erros += "Diaria está vazio!\n";
            }
            if( isNaN(diaria) ){
                teveErro = true;
                erros += "Valor do campo 'Diaria' deve ser numerico!\n(Use ponto para valor flutuante)\n";
            }
            if(caminhoFoto == null || caminhoFoto == ""){
                teveErro = true;
                erros += "Caminho da Foto está vazio!\n";
            }
            if(cidade == null || cidade == ""){
                teveErro = true;
                erros += "Cidade está vazio!";
            }              

            if(teveErro){                
                alert(erros);
                return false;
            }
            return true;
        }
        function resultadosVagas(){
            test_input(document.getElementById('pesquisa').value);
            document.getElementById('entrada').submit();           
        }
        function fnSubmit(){
            if(verificacoes()){
                var continuar = confirm("Clique em 'Ok', para confirmar as alterações.");
                if(continuar){
                    document.getElementById('f1').submit();
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

    <form action="../../html/paginaresultados2.php" id="entrada" method="POST">
        <input type="text" id="pesquisa" name="pesquisa" placeholder="Buscar..." class="TextoPesquisar">
        <select id="cidade" name="cidade" form="entrada">
            <option selected value="qualquer">Qualquer localização</option>
            <option value="rio">Rio Paranaiba</option>                
        </select>
        <input type='button' onclick='resultadosVagas();' value='Buscar' id="botaoTopo"> 
    </form>

    <ul id="BotoesMenu">
        <li class="Menu"> <a class="Menu" href="crud1.php">Cadastro</a> </li>
        <li class="Menu"> <a style="cursor: pointer;" class="Menu"  onclick="trocaCss('../../css/IdentidadeVisual.css','../../css/folhaDeEstiloCadastroCRUD.css')">Tema Original</a> </li>
        <li class="Menu"> <a style="cursor: pointer;" class="Menu" onclick="trocaCss('../../css/IdentidadeVisualStile02.css','../../css/folhaDeEstiloCadastroCRUDStile02.css')">Tema Novo</a> </li>
    </ul>
</div>

<div id="formInserirExterna">
    <div id="formInserirInterna">
    <hr>
    <h1>Cadastro:</h1>
    <hr>
        <form  action="crud2.php" method="post" id="f1" name="f1">

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

        <h3 class="obrigatorio">*Todos os campos devem ser preenchidos.</h3>
</div>

<hr>

<div class="divTabela">

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
    
</div> 

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
<div id="fica aqui">
<div id="rodape">
        <ul class="rodape">
            <li class="rodape">Sobre</li>
            <li class="rodape"><a href="../sobreTemVagaAi.html">Tem Vaga Ai</a></li> 
            <li class="rodape"><a href="../sobreDesenvolvedor.html">Desenvolvido</a></li> 
        </ul>
</div>
</div>



</body>
</html>