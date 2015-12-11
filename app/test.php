<html>
<body>
<?php

	$host="db.ist.utl.pt";	// o MySQL esta disponivel nesta maquina
	$user="ist178034";	// -> substituir pelo nome de utilizador
	$password="sql";	// -> substituir pela password (dada pelo mysql_reset, ou atualizada pelo utilizador)
	$dbname = "ist178034";	// a BD tem nome identico ao utilizador

	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	echo("<p>Connected to MySQL database $dbname on $host as user $user</p>\n");

	$sql = "SELECT * FROM login;";

	echo("<p>Query: " . $sql . "</p>\n");

	$result = $connection->query($sql);
	
	$num = $result->rowCount();

	echo("<p>$num records retrieved:</p>\n");

	echo("<table border=\"1\">\n");
	echo("<tr><td>contador_login</td><td>user_id</td><td>sucesso</td><td>moment</td></tr>\n");
	foreach($result as $row)
	{
		echo("<tr><td>");
		echo($row["contador_login"]);
		echo("</td><td>");
		echo($row["userid"]);
		echo("</td><td>");
		echo($row["sucesso"]);
		echo("</td><td>");
		echo($row["moment"]);
		echo("</td></tr>\n");
	}
	echo("</table>\n");
		
        $connection = null;
	
	echo("<p>Connection closed.</p>\n");

	echo("<p>Test completed successfully.</p>\n");

?>
</body>
</html>
