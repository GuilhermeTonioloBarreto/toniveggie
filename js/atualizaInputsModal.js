// esta função adiciona as informações da receita no modal,
// para que assim a receita possa ser atualizada
let botoesAtualizar = document.getElementsByClassName("botao-atualizar");

// adiciona o evento listener em cada um dos botões de atualizar nas receitas
for(let i = 0; i < botoesAtualizar.length; i++){
	
	botoesAtualizar[i].addEventListener("click", function () {
		// esta variável id identifica a receita que será atualizada
		let id = botoesAtualizar[i].value;
		loadXmlDoc(id);		
	});
}

// realiza um http request para pegar os dados do arquivo receitas.xml
function loadXmlDoc(id) {
	let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
  
    	// Request finished and response 
    	// is ready and Status is "OK"
    	if (this.readyState == 4 && this.status == 200) {
    		lerXmlFile(this, id);
		}
	};
  
	// employee.xml is the external xml file
	xmlhttp.open("GET", "xml/receitas.xml", true);
	xmlhttp.send();
}

// esta função realiza a leitura dos dados da receita especificada em id
function lerXmlFile(xml, id){
	let xmlDoc = xml.responseXML;
	let receita = xmlDoc.getElementsByTagName("receita");
	
	let nome = receita[id].getElementsByTagName("nome")[0].childNodes[0].nodeValue;
	
	let descricao = receita[id].getElementsByTagName("descricao")[0].childNodes[0].nodeValue;
	
	let ingredientes = [];
	for (let i = 0; i < receita[id].getElementsByTagName("ingrediente").length; i++){
		ingredientes.push(receita[id].getElementsByTagName("ingrediente")[i].childNodes[0].nodeValue);	
	}
	
	let preparos = [];
	for (let i = 0; i < receita[id].getElementsByTagName("preparo").length; i++){
		preparos.push(receita[id].getElementsByTagName("preparo")[i].childNodes[0].nodeValue);	
	}
	
	addInfoModal(nome, descricao, ingredientes, preparos, id);
	
}

// esta função exibe os dados da receita que será atualizada no modal
function addInfoModal(nome, descricao, ingredientes, preparos, id){
	document.getElementById("modalNome").value = nome;
	document.getElementById("modalDescricao").value = descricao;
	
	for(let i = 1; i < ingredientes.length; i++){
		adicioneInput('ingrediente');	
	}
	
	for(let i = 1; i < preparos.length; i++){
		adicioneInput('preparo');	
	}
	
	let modIngr = document.getElementsByClassName("modalIngrediente");
	for(let i = 0; i < modIngr.length; i++){
		modIngr[i].value = ingredientes[i];
	}
	
	let modPrep = document.getElementsByClassName("modalPreparo");
	for(let i = 0; i < modPrep.length; i++){
		modPrep	[i].value = preparos[i];
	}
	
	atualizaModal(id);
}

// atualiza o nome do botão de "Adicionar Receita" para "Atualizar Receita"
// atualiza o titulo do modal de "Adicionar Receita" para "Atualizar Receita"
// modifica o arquivo php que será redirecionado quando o botão submit for clicado
function atualizaModal(id) {
	document.getElementById("modalTitulo").innerHTML = "Atualizar Receita";	
	
	document.getElementById("modalAdicionarReceitaButton").innerHTML = "Atualizar Receita";
	document.getElementById("modalAdicionarReceitaButton").value = id;
	
	document.getElementById("myForm").action = "php/updateReceita.php";
	
}
