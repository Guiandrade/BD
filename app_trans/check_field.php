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

	echo("<p>Connected to MySQL database $dbname on $host as user $user</p>\n");

	$sql = "SELECT * FROM campo;";

	echo("<p>Query: " . $sql . "</p>\n");

	$result = $connection->query($sql);
	
	$num = $result->rowCount();

	echo("<p>$num records retrieved:</p>\n");

	echo("<table border=\"1\">\n");
	echo("<tr><td>userid</td><td>typecnt</td><td>campocnt</td><td>idseq</td><td>ativo</td><td>nome</td></tr>\n");
	foreach($result as $row)
	{
		echo("<tr><td>");
		echo($row["userid"]);
		echo("</td><td>");
		echo($row["typecnt"]);
		echo("</td><td>");
		echo($row["campocnt"]);
		echo("</td><td>");
		echo($row["idseq"]);
		echo("</td><td>");
		echo($row["ativo"]);
		echo("</td><td>");
		echo($row["nome"]);		
		echo("</td></tr>\n");
	}
	echo("</table>\n");
		
        $connection = null;
	
	echo("<p>Connection closed.</p>\n");

	echo("<p>Test completed successfully.</p>\n");

?>
<A name="bottom">
<A href="menu.html" onclick="location.href=this.href+'?'+scrt_var;return false;" >Retroceder</A>
<script type="text/javascript">
var scrt_var = location.search.substring(1) ;
</script>
</body>
</html>
