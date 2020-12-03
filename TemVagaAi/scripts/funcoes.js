var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("slide");
    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
    }
    x[slideIndex-1].style.display = "block";  
}
function fecharAvisoCovid(){
    document.getElementById("aviso").style.display = 'none';                
}  
function trocaCss(cssPrincipal,cssSecundario){
    document.getElementById('temaPrincipal').setAttribute("href", cssPrincipal);
    document.getElementById('temaSecundario').setAttribute("href", cssSecundario);
}

function carregarSlidesCSV(){
    d3.csv("CSV/slidesCSV.csv", function (data){               
        document.getElementById(data.id).src=data.src;
    });
}
function carregarComentariosCSV(){
    d3.csv("CSV/comentarios.csv", function (data){    
        if(document.getElementById('nome'+data.id) == null)
            return;
        document.getElementById('nome'+data.id).innerHTML =data.nome;
        document.getElementById('idade'+data.id).innerHTML =data.idade+' anos.';
        document.getElementById('comentario'+data.id).innerHTML =data.comentario;
    });
}
function carregarUmComentario(id){
    d3.csv("../CSV/comentarios.csv", function (data){   
        if('nome'+data.id == 'nome'+id){
            document.getElementById('nome'+data.id).innerHTML =data.nome;
            document.getElementById('idade'+data.id).innerHTML =data.idade+' anos.';
            document.getElementById('comentario'+data.id).innerHTML =data.comentario;
        }
    });
}