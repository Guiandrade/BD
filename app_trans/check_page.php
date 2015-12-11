<html>
<head>
<title>Projeto BD</title>
<meta charset="UTF-8" />
</head>
	
<body>
	<A HREF="#bottom">Saltar para o fim</A>

<?php

	$host="db.ist.utl.pt";	// o MySQL esta disponivel nesta maquina
	$user="ist178034";	// -> substituir pelo nome de utilizador
	$password="sql";	// -> substituir pela password (dada pelo mysql_reset, ou atualizada pelo utilizador)
	$dbname = "ist178034";	// a BD tem nome identico ao utilizador
	
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	# Inicia a transação
	$connection->beginTransaction();

	$sql = "SELECT * FROM pagina;";
	$result = $connection->query($sql);
	$num = $result->rowCount();

	echo("<p>$num páginas encontradas</p>\n");

	echo("<table border=\"1\">\n");
	echo("<tr><td>userid</td><td>pagecounter</td><td>nome</td><td>idseq</td><td>ativa</td></tr>\n");
	foreach($result as $row)
	{
		echo("<tr><td>");
		echo($row["userid"]);
		echo("</td><td>");
		echo($row["pagecounter"]);
		echo("</td><td>");
		echo($row["nome"]);
		echo("</td><td>");
		echo($row["idseq"]);
		echo("</td><td>");
		echo($row["ativa"]);		
		echo("</td></tr>\n");
	}
	echo("</table>\n");
		
	# Faz commit da transação
	$connection->commit();			
		
    $connection = null;
?>
<A name="bottom">
<A href="menu.html" onclick="location.href=this.href+'?'+scrt_var;return false;" >Retroceder</A>
<script type="text/javascript">
var scrt_var = location.search.substring(1) ;
</script>
</body>
</html>
