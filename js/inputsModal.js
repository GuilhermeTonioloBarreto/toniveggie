// Esta funcao adiciona mais inputs no modal para o usuário colocar
// mais ingredientes ou preparos para o preparo da receita
function adicioneInput(item){
	// define algumas variáveis que serão utilizadas na função
	let placeholder; // usado no html
	let inputClass; // usado no html
	let id; // usado no html
	if(item == "ingrediente"){
		placeholder = "Digite um dos ingredientes da receita ";
		inputClass = "modalIngrediente";
		nome = "ingredienteReceita[]";
		id = "div-ingrediente";
	}else if (item == "preparo"){
		placeholder = "Digite um dos passos da receita";
		inputClass = "modalPreparo";
		nome = "preparoReceita[]";
		id = "div-preparo";
	}	
	
	// cria um elemento div
    let addFiltro = document.createElement("div");
    addFiltro.classList.add("input-group");
    addFiltro.classList.add("mb-3");

    // cria um elemento input
    let addInput = document.createElement("input");	
    addInput.type = "text";
    addInput.classList.add("form-control");
    addInput.classList.add(inputClass);    
    addInput.placeholder = placeholder;
    addInput.required = true;
    addInput.name = nome;
    
    // cria um elemento button
    let addButton = document.createElement("button");
    addButton.classList.add("btn");
    addButton.classList.add("btn-success");
    addButton.type = "button";
    addButton.innerHTML = "-";

    // funcao que deleta o div criado toda vez que o botao menos "-" é clicado
    // o elemento div e tudo o que estiver nele é removido
    addButton.addEventListener("click", function(){
        parentDiv = addButton.parentNode;
        parentDiv.remove();
    });
    
    // adiciona addInput e addButton como child de addFiltro
    addFiltro.appendChild(addInput);
    addFiltro.appendChild(addButton);

    // adiciona o elemento div na DOM
    document.getElementById(id).appendChild(addFiltro);
}

// função que atualiza a página quando algum dos botões de cancelar do modal for clicado
function closeModal(){
	window.location.reload();
}

