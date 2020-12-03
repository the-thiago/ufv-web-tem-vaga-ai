<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de pesquisa - Tem Vaga Ai!</title>
    <link id="temaPrincipal" rel="stylesheet" href="../css/IdentidadeVisual.css">
    <link id="temaSecundario" rel="stylesheet" href="../css/folhaDeEstiloPagina02.css">
    <script src="../scripts/funcoes.js"></script>
    <script>
        function test_input(data){
            data = data.trim();
            data = data.replace('&', '&amp;').replace('<', '&lt;');
            data = data.replace('>', '&gt;').replace('"', '&quot;').replace("'", '&#039');
            return data;
        }
        function resultadosVagas(){
            test_input(document.getElementById('pesquisa').value);
            document.getElementById('entrada').submit();
        }
        function verMaisInfos(id){
            document.getElementById('verMaisInfos'+id).submit();
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
        <a href="../index.html">
            <img id="logo" src="../imagens/LOGO TEM VAGA AI.png" alt="logo">
        </a>        

        <form action="paginaresultados2.php" id="entrada" method="POST">
            <input type="text" id="pesquisa" name="pesquisa" placeholder="Buscar..." class="TextoPesquisar">
            <select id="cidade" name="cidade" form="entrada">
                <!-- Se chegou nessa pagina por meio de uma pesquisa, pega os valores anteriores-->
                <option <?php if(isset($_POST['cidade'])){if($_POST['cidade'] == 'qualquer'){ echo'selected';}} ?> value="qualquer">Qualquer localização</option>
                <option <?php if(isset($_POST['cidade'])){if($_POST['cidade'] == 'rio'){ echo'selected';}} ?> value="rio">Rio Paranaiba</option>                
            </select>
            <input type='button' onclick='resultadosVagas();' value='Nova Busca' id="botaoTopo" style="padding:15px 15px;"> 
        </form>

        <ul id="BotoesMenu">
            <li class="Menu"> <a class="Menu" href="crud/crud1.php">Cadastro</a> </li>
            <li class="Menu"> <a style="cursor: pointer;" class="Menu"  onclick="trocaCss('../css/IdentidadeVisual.css','css/folhaDeEstiloPagina01.css')">Tema Original</a> </li>
            <li class="Menu"> <a style="cursor: pointer;" class="Menu" onclick="trocaCss('../css/IdentidadeVisualStile02.css','css/folhaDeEstiloPagina01Stile02.css')">Tema Novo</a> </li>
        </ul>
    </div>
    <?php    // Mantem a pesquisa antiga para possivel edição
        if( isset($_POST['pesquisa'])){ // Se pesquisa não é vazio
            $pesquisa = $_POST['pesquisa'];
            echo "
            <script> document.getElementById('pesquisa').value = '$pesquisa'; 
            </script>
            ";
        }
    ?> 
    <!-- div resultados -->
    <?php

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $pesquisa = test_input($_POST['pesquisa']);
        $cidade = test_input($_POST['cidade']);

        include('crud/connect.php');

        if(empty($pesquisa) && $cidade == 'qualquer'){
            $sql = "SELECT * FROM vaga";
        } else if(empty($pesquisa) && $cidade == 'rio'){
            $sql = "SELECT * FROM vaga WHERE cidade LIKE '%Rio Parana_ba%'";
        } else if($cidade == 'qualquer'){
            $sql = "SELECT * FROM vaga WHERE nome LIKE '%$pesquisa%'";
        } else if($cidade == 'rio'){
            $sql = "SELECT * FROM vaga WHERE nome LIKE '%$pesquisa%' AND cidade LIKE '%Rio Parana_ba%'";
        }        

        $result = $conn->query($sql);
        
        if($result->num_rows > 0){
            // Apresenta cada resultado da pesquisa
            echo"
            <div id='resultados' class='cadaResultado'>            
            ";
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $nome = $row['nome'];
                $descricao = $row['descricao'];
                $diaria = $row['diaria'];
                $caminhoFoto = $row['caminhoFoto'];
                $cidade = $row['cidade'];    
                

                echo "
                <div class='cadaResultado'>
                    <div class='result'>
                        <div class='DivFotoResultados'>
                            <div class='DivTamanhoFoto'>
                                
                                    <img class='fotoResultados' src='$caminhoFoto' alt='Rancho Amarelo'>
                                
                            </div>
                        </div>
                        <div class='DivConteudo'>                    
                            <h1>$nome</h1>                    
                            <h2>Diaria: R$$diaria</h2>
                            <h3>Localização: $cidade</h3>
                            <p>$descricao</p>
                        </div>
                    </div>  
                    <div class='divVerMaisInfos' id='divVerMaisInfos'>
                        <form action='resultadoselecao3.php' id='verMaisInfos$id' class='verMaisInfos' method='POST'>        
                            <input type='hidden' id='id' name='id' value=$id>
                            <input type='button' class='btnVerMaisInfos' id='btnSubmit$id' name='btnSubmit$id' onclick='verMaisInfos($id);' value='Alugue!'> 
                        </form>
                    </div>
                </div>              
                ";
            }   
            echo"
            </div>            
            ";         
        }else{
            echo "  
            <div id='resultados'>
                <div class='result' style='margin: 0 auto;
                width: 100%;'>
                    <h1 style='margin-left: 33%; margin-top: 15px;'>Nenhum resultado encontrado, tente novamente.</h1>
                </div>
            </div>
            ";
        }

        $conn->close();
    ?>     
    <!-- div de rodape-->
    <div id="rodape">
        <ul class="rodape">
            <li class="rodape">Sobre</li>
            <li class="rodape"><a href="sobreTemVagaAi.html">Tem Vaga Ai</a></li> 
            <li class="rodape"><a href="sobreDesenvolvedor.html">Desenvolvido</a></li> 
        </ul>
    </div>   
   

</body>

</html>