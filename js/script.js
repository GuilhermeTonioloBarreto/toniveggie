// esta funcao pega todos os alimentos digitados e apenas exibe as receitas que
// contém este alimento
function pesquisarAlimento(){

    // pegar ingredientes digitados pelo usuario, deixa tudo em minúsculo e retira acendo
    let ingrediente = document.getElementsByClassName("ingrediente");

    // cria um array com todos os ingredientes digitados pelo usuario
    let arrayIngredientes = [];
    for(let i = 0; i < ingrediente.length; i++){
        arrayIngredientes.push(ingrediente[i].value.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, ""));
    }

    // pega todas as receitas da classe "receita"
    let receita = document.getElementsByClassName("receita");
     
    // verifica se o algum ingrediente digitado está presente em alguma receita
    // caso não esteja, a receita é apagada do script
    for(let i = 0; i < receita.length; i++){

        // se o ingrediente em arrayIngredientes nao estiver incluso na receita,
        // esta receita será reprovada
        let receita_aprovada = true;
        for(let j = 0; j < arrayIngredientes.length; j++){
            if (receita[i].textContent.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(arrayIngredientes[j])) {
                continue;
            } else {
                receita_aprovada = false;
            }
        }

        // se a receita estiver aprovada, ela é exibida
        // caso contrário, ela não é exibida
        if(receita_aprovada){
            receita[i].style.display = 'block';
            receita[i].open = false;
        }else{
            receita[i].style.display = 'none';
        }  
    }
}

// esta funcao adiciona mais filtros para o usuário poder filtar
// mais de um ingrediente
function adicioneFiltro(){

    // cria um elemento div
    let addFiltro = document.createElement("div");
    addFiltro.classList.add("input-group");
    addFiltro.classList.add("mb-3");

    // cria um elemento input
    let addInput = document.createElement("input");
    addInput.type = "text";
    addInput.classList.add("form-control");
    addInput.classList.add("ingrediente");
    addInput.placeholder = "Filtre as receitas digitando um alimento";
    addInput.addEventListener('input', pesquisarAlimento);
    
    // cria um elemento button
    let addButton = document.createElement("button");
    addButton.classList.add("btn");
    addButton.classList.add("btn-success");
    addButton.type = "submit";
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
    document.getElementById("divFiltros").appendChild(addFiltro);
}

// -----------------------------------------------------------------

// Esta funcao adiciona mais inputs para o usuário colocar
// mais ingredientes ou passos para o preparo da receita
function adicioneInput(item){
	// define algumas variáveis que serão utilizadas na função
	let placeholder; // usado no html
	let inputClass; // usado no html
	let id; // usado no html
	if(item == "ingrediente"){
		placeholder = "Digite um dos ingredientes da receita";
		inputClass = "input-ingrediente";
		nome = "ingredienteReceita[]";
		id = "div-ingrediente";
	}else if (item == "preparo"){
		placeholder = "Digite um dos passos da receita";
		inputClass = "input-preparo";
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

function closeModal(){
	window.location.reload();
}


function teste(){
	let ingredientesReceita = document.getElementsByClassName("input-ingrediente");
	for(let i = 0; i < ingredientesReceita.length; i++){
		console.log(ingredientesReceita[i].value);	
	}
}



