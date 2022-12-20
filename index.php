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
<div id="barraDeNavegacao" class="container">
  <nav class="navbar navbar-expand-sm bg-success navbar-dark ">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">Toni Veggie</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Receitas Veggies</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Temperos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Dieta</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Alimentos</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> 
</div>

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

<script src="js/functions.js"></script>
</body>
</html>
