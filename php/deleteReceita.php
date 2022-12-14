<!-- Constantes usadas no programa -->
<?php define ("XML_FILE_NAME", "receitas.xml"); ?>

<?php

// dá uma formatada na string que veio do usuário
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = intval($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$deletarReceitaInt = test_input($_POST["deletarReceita"]);
}

?>


<!-- remover node -->
<?php

$xml=simplexml_load_file('../xml/' . XML_FILE_NAME) or die("Error: Não consegue abrir .xml para deletar receita");

unset($xml->receita[$deletarReceitaInt]);

$xml->asXML('../xml/' . XML_FILE_NAME);

header("Location:../index.php");

?>