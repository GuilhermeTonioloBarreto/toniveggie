<!-- Constantes usadas no programa -->
<?php define ("XML_FILE_NAME", "receitas.xml"); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Toni Veggie</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- bootstrap reference -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- css reference-->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

<!-- navbar -->
<?php include 'php/navbar.php' ?>

<!-- exibição das receitas salvas no arquivo XML-->
<div class="container" id="conteudo">
  <h1 id="titulo" class="text-center">Comidas Vegetarianas</h1>

  <div id="divFiltros">

    <div class="input-group mb-3">
      <input type="text" oninput="pesquisarAlimento()" class="form-control ingrediente" placeholder="Filtre as receitas digitando um alimento">
      <button class="btn btn-success" type="submit" onclick="adicioneFiltro()">+</button>
    </div>

  </div>
  
<!-- criar XML (caso ele não tenha sido criado) -->
<?php
	if(file_exists('xml/' . XML_FILE_NAME)){
		;
	}else{
		$xml = new DOMDocument();
		$xml->encoding = 'utf-8';
		$xml->xmlVersion = '1.0';
		$xml->formatOutput = true;

		// eu primeiramente preciso criar um nó root
		$root = $xml->createElement('receitas');

		// obrigatoriamente eu preciso adicionar ao menos um node ao root
		// irei colocar um template do que é gravado no XML
		$node = $xml->createElement('receita');
		$nodeNome = $xml->createElement('nome', 'Arquivo .xml criado');
		$nodeDescricao = $xml->createElement('descricao', 'Toda vez que o arquivo .xml é deletado, o progama 
			php gera outro arquivo .xml. Se preferir, delete este template');

		$node->appendChild($nodeNome);
		$node->appendChild($nodeDescricao);
		
		$root->appendChild($node);
		
		// depois, adiciono o root no xml principal e salvo
		$xml->appendChild($root);
		$xml->save('xml/' . XML_FILE_NAME) or die('não foi possível criar o arquivo .xml');
	}
?>  

<!-- numerar receita -->
<?php $numerarReceita = 0; ?>
 
<?php
	// load xml file
	$xml=simplexml_load_file("xml/" . XML_FILE_NAME) or die('Não foi possível abrir o arquivo .xml');
?> 
 
<!-- mostrar  receitas -->
<div id="conteudoReceitas">  
	<?php
	// display each recipe
  	foreach($xml->children() as $receita){
	?>
  
  	<!-- create class receita -->
  	<details class="receita">
  
 	<!-- display recipe name -->
  	<summary class="h2"><?php echo $receita->nome ?></summary>
  
  	<!-- display description -->
  	<p><?php echo $receita->descricao ?></p>
  
  	<!-- display ingredients -->
  	<h3>Ingredientes</h3>
  	<ul>
  	<?php foreach($receita->ingredientes->children() as $ingrediente){ ?>
    	<li><?php echo $ingrediente ?></li>
  	<?php } ?>
  	</ul>
  
 	<!-- display food prepare -->
  	<h3>Preparo</h3>
  	<ul>
  	<?php foreach($receita->preparos->children() as $preparo){ ?>
    	<li><?php echo $preparo ?></li>
  	<?php } ?>
  	</ul>

	<!-- adicionar botões de atualizar e deletar -->	
	<div class="botoesAtualizarExcluir" style="display: none;"> 	
		<div class="btn-group mb-2" >
		
			<!-- botão atualizar receita -->
  			<button type="button" class="btn btn-outline-success botao-atualizar" 
  				data-bs-toggle="modal" data-bs-target="#modalAdicionar" 
  				onclick=<?php echo "'atualizarReceita(" . $numerarReceita . ")'" ?> >
  				Atualizar Receita
  			</button>
  		
			<!-- botão deletar receita -->
			<form method="post" action="php/deleteReceita.php" class="deletarForm" name="deletarForm">
				<button type="submit" class="btn btn-outline-success deletarReceitaButton"
					name="deletarReceita" value= <?php echo $numerarReceita++; ?> >Deletar Receita
				</button>
			</form>

  		</div>
  	</div>
  	
  	</details>

  	<?php } ?> <!-- end of main foreach -->
	
</div>
  
</div>

<!-- botão para adicionar receita -->  
<div id="botao-adicionar" data-bs-toggle="modal" data-bs-target="#modalAdicionar" style="display: none;">+</div>

<!-- modal para adicionar receita -->
<div class="modal fade" id="modalAdicionar" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"  data-bs-target="#staticBackdrop">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <form id="myForm" name="myForm" method="post" action="php/addReceita.php">

      <div class="modal-header">
        <h5 class="modal-title" id="modalTitulo">Adicionar Receita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
      </div>
      
      <div class="modal-body">        
          <!-- adicionar nome da receita -->
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Nome da Receita</label>
            <input type="text" class="form-control" name="nomeReceita" id="modalNome" required>
          </div>
          
          <!-- adicionar descricao da receita -->
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Descrição da Receita</label>
            <textarea class="form-control" name="descricaoReceita" id="modalDescricao" required></textarea>
          </div>
          
          <!-- adicionar ingredientes da receita -->
          <div class="mb-3" id="div-ingrediente">
            <label for="recipient-name" class="col-form-label">Ingredientes</label>
            <div class="input-group mb-3">
      			<input type="text" class="form-control modalIngrediente" placeholder="Digite um dos ingredientes da receita" name="ingredienteReceita[]" required>
      			<button class="btn btn-success" type="button" onclick="adicioneInput('ingrediente')">+</button>
    		</div>
          </div>
          
          <!-- adicionar os passos do preparo da receita -->
          <div class="mb-3" id="div-preparo">
            <label for="recipient-name" class="col-form-label">Preparo</label>
            <div class="input-group mb-3">
      			<input type="text" class="form-control modalPreparo" placeholder="Digite um dos passos da receita" name="preparoReceita[]" required>
      			<button class="btn btn-success" type="button" onclick="adicioneInput('preparo')">+</button>
    		</div>
          </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeModal()">Cancelar</button>
        <button id="modalAdicionarReceitaButton" type="submit" name="updateReceita" value="" class="btn btn-success">Adicionar Receita</button>
      </div>

	  </form>
    
    </div>

  </div>
</div>

<!-- botão para liberar edição de receitas no site -->
<div id="botao-editar" onclick="liberarEdicaoSite()">&#9997</div>


<!-- modal para liberar edição das receitas no site -->
<div class="modal fade" id="modalLiberarEdicao" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"  data-bs-target="#staticBackdrop">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitulo">Verificar Senha</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
      </div>
      
      <div class="modal-body">        
          <!-- adicionar senha de acesso ao site -->
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Digite a senha para editar as receitas</label>
            <input type="password" class="form-control" id="modalSenhaDigitada" required>
          </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeModal()">Cancelar</button>
        <button onclick="modalVerificarSenha()" data-bs-dismiss="modal" class="btn btn-success">Liberar Acesso</button>
      </div>
    
    </div>

  </div>
</div>

<!-- modal para sinalizar senha errada -->
<div class="modal fade" id="modalSenhaErrada" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"  data-bs-target="#staticBackdrop">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitulo">Senha Errada</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
      </div>
      
      <div class="modal-body">        
            <label for="recipient-name" class="col-form-label">A senha está errada!</label>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="closeModal()">Ok</button>
      </div>
    
    </div>

  </div>
</div>

<script src="js/filtroReceitas.js"></script>
<script src="js/inputsModal.js"></script>
<script src="js/atualizaInputsModal.js"></script>
<script src="js/ordenarReceitas.js"></script>
<script src="js/liberarEdicaoSite.js"></script>
<script src="js/funcoesComuns.js" ></script>

</body>
</html>
