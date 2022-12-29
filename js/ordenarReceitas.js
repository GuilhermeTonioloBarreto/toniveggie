// o código abaixo ordena as receitas salvas no próprio javascript
let details = document.getElementsByTagName("details");

let titulos = [];

// este loop pega os títulos de cada uma das receitas
for(let i = 0; i < details.length; i++){
	titulos.push(details[i].childNodes[3].innerHTML);
}

// ordena o título das receitas
titulos.sort();

for(let i = 0; i < titulos.length; i++){
	for(let j = 0; j < details.length; j++){
		if(titulos[i] === details[j].childNodes[3].innerHTML){
			let detail = details[j].cloneNode(true);
			document.getElementById("conteudoReceitas").appendChild(detail);
			details[j].remove();
			break;			
		}
	}
}



