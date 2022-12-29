let botaoAdicionar = document.getElementById("botao-adicionar");
let botoesAtualizarExlcluir = document.getElementsByClassName("botoesAtualizarExlcluir");

function liberarEdicaoSite() {
	if(botaoAdicionar.style.display == 'none'){
		botaoAdicionar.style.display = 'inline-block';
		
		for(let btn of botoesAtualizarExlcluir){
			btn.style.display = 'inline-block';		
		}
	}else{
		botaoAdicionar.style.display = 'none';
		
		for(let btn of botoesAtualizarExlcluir){
			btn.style.display = 'none';		
		}
	}
}