// este script tem como objetivo liberar o acesso aos botões de edição do site,
// mediante a senha correta digitada pelo usuário
let botaoAdicionar = document.getElementById("botao-adicionar");
let botoesAtualizarExlcluir = document.getElementsByClassName("botoesAtualizarExcluir");

// esta função verifica se os botões de edição do site já estão ativos ou não
// se eles já estiverem ativos, eles ficarão inativos
// se eles não estiverem ativos, será chamado um modal pedindo pela senha correta
function liberarEdicaoSite() {
	
	if(botaoAdicionar.style.display == 'none'){
		let modalLiberarEdicao = new bootstrap.Modal(document.getElementById('modalLiberarEdicao'));
		modalLiberarEdicao.show();
		document.getElementById("modalSenhaDigitada").value = "";
		
	}else{
		botaoAdicionar.style.display = 'none';
		
		for(let btn of botoesAtualizarExlcluir){
			btn.style.display = 'none';		
		}
	}
}

// esta função verifica se a senha digitada pelo usuário é a mesma que se encontra no servidor
function modalVerificarSenha() {
	// pegar senha digitada pelo usuário
	let senhaDigitada = document.getElementById("modalSenhaDigitada").value;	
	
	// pegar senha salva no arquivo senha.txt
 	const xhttp = new XMLHttpRequest();
 	
 	
 	// quando o dado requisitado do servidor chegar ... 
  	xhttp.onload = function() {
		// pega a senha do servidor
  		let senhaCorreta = this.responseText;
  		senhaCorreta = senhaCorreta.replace(/(\r\n|\n|\r)/gm, "");

		// se a senha estiver correta, os botões de edição da receita irão aparecer
    	if(senhaDigitada.localeCompare(senhaCorreta) == 0){
			botaoAdicionar.style.display = 'inline-block';
		
			for(let btn of botoesAtualizarExlcluir){
				btn.style.display = 'inline-block';
			}
		// se a senha estiver errada, um modal aparecerá dizendo que a senha está errada
		}else{
			let modalSenhaErrada = new bootstrap.Modal(document.getElementById('modalSenhaErrada'));
			modalSenhaErrada.show();
		}  	
    	
    }
    
    // requisição para pegar dados do servidor
  	xhttp.open("GET", "senha/senha.txt", true);
  	xhttp.send();
  	
}