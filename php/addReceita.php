<!-- Constantes usadas no programa -->
<?php define ("XML_FILE_NAME", "receitas.xml"); ?>

<!-- adiciona receitas no arquivo XML -->

<!-- Get dados do formulário -->
<?php
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

function test_input_array($datas){
	foreach($datas as $data){
		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
	}
	return $datas;
}

?>

<!-- adicionar receita -->
<?php
$xml=simplexml_load_file('../xml/' . XML_FILE_NAME) or die("Error: deu erro na parte de adicionar a receita");

// descobre qual a posição do node recém criado
$xml->addChild('receita');
$receitaCount = $xml->receita->count() - 1;

// adicionar node de nome da receita
$xml->receita[$receitaCount]->addChild('nome', $nomeReceita);

// adicionar node de descrição da receita
$xml->receita[$receitaCount]->addChild('descricao', $descricaoReceita);

// adicionar nodes de ingredientes
$xml->receita[$receitaCount]->addChild('ingredientes');
foreach($ingredienteReceita as $ingrediente){
	$xml->receita[$receitaCount]->ingredientes->addChild('ingrediente', $ingrediente);
}

// adicionar nodes de preparo da receita
$xml->receita[$receitaCount]->addChild('preparos');
foreach($preparoReceita as $preparo){
	$xml->receita[$receitaCount]->preparos->addChild('preparo', $preparo);
}

$xml->asXML('../xml/' . XML_FILE_NAME);
?>

<!-- Voltar para a página inicial -->
<?php
	header("Location:../index.php");
?>

