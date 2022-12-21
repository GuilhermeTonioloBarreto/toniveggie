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

  <!-- display recipes -->  
  <?php
  // load xml file
  $xml=simplexml_load_file("xml/receitas.xml") or die("Error: Cannot create object");
  
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
      <li> <?php echo $ingrediente ?> </li>
  <?php } ?>
  </ul>
  
  <!-- display food prepare -->
  <h3>Preparo</h3>
  <ul>
  <?php foreach($receita->preparos->children() as $preparo){ ?>
      <li> <?php echo $preparo ?> </li>
  <?php } ?>
  </ul>
  
  </details>
  <?php } ?> <!-- end of main foreach -->
  
</div>

<!-- modal para adicionar receita -->
<div class="container" id="modal-adicionar">

<!-- botão para adicionar receita -->  
<div id="botao-adicionar" data-bs-toggle="modal" data-bs-target="#modalAdicionar">+</div>

<!-- modal -->
<div class="modal fade" id="modalAdicionar" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"  data-bs-target="#staticBackdrop">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <form name="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

      <div class="modal-header">
        <h5 class="modal-title">Adicionar Receita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
      </div>
      
      <div class="modal-body">        
          <!-- adicionar nome da receita -->
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Nome da Receita</label>
            <input type="text" class="form-control" name="nomeReceita" required>
          </div>
          
          <!-- adicionar descricao da receita -->
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Descrição da Receita</label>
            <textarea class="form-control" name="descricaoReceita" required></textarea>
          </div>
          
          <!-- adicionar ingredientes da receita -->
          <div class="mb-3" id="div-ingrediente">
            <label for="recipient-name" class="col-form-label">Ingredientes</label>
            <div class="input-group mb-3">
      			<input type="text" class="form-control input-ingrediente" placeholder="Digite um dos ingredientes da receita" name="ingredienteReceita[]" required>
      			<button class="btn btn-success" type="button" onclick="adicioneInput('ingrediente')">+</button>
    		</div>
          </div>
          
          <!-- adicionar os passos do preparo da receita -->
          <div class="mb-3" id="div-preparo">
            <label for="recipient-name" class="col-form-label">Preparo</label>
            <div class="input-group mb-3">
      			<input type="text" class="form-control input-preparo" placeholder="Digite um dos passos da receita" name="preparoReceita[]" required>
      			<button class="btn btn-success" type="button" onclick="adicioneInput('preparo')">+</button>
    		</div>
          </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeModal()">Cancelar</button>
        <button type="submit" name="submit" value="submit" class="btn btn-success">Adicionar Receita</button>
      </div>

    </form>
    
    </div>

  </div>
</div>
</div>


<!-- adiciona receitas no arquivo XML -->
<?php

// Get dados do formulário
$nomeReceita = "";
$descricaoReceita = "";
$ingredienteReceita = "";
$preparoReceita = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeReceita = test_input($_POST["nomeReceita"]);
    $descricaoReceita = test_input($_POST["descricaoReceita"]);
    $ingredienteReceita = test_input_array($_POST["ingredienteReceita"]);
    $preparoReceita = test_input_array($_POST["preparoReceita"]);
  }

// dá uma formatada na string que veio do usuário
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function test_input_array(){
	foreach($datas as $data){
		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
	}
	return $datas;
}

echo $nomeReceita . "<br>";
echo $descricaoReceita . "<br>";
print_r($ingredienteReceita) . "<br>";
print_r($preparoReceita) . "<br>";

?>

<script src="js/script.js"></script>

</body>
</html>
