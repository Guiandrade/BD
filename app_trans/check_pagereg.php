<html>
<head>
<title>Projeto BD</title>
<meta charset="UTF-8" />
</head>
	
<body>
	<A HREF="#bottom">Saltar para o fim</A>
	</br>
	</br>


<?php
	
	# Recebe os dados da página anterior
	if(isset($_POST['Submit'])) 
	{
        $pagename = utf8_decode($_POST['page_name']);
		$user_id = $_POST['userid'];
	}

	# Dados de ligação ao utilizador
	$host="db.ist.utl.pt";
	$user="ist178034";
	$password="sql";
	$dbname = "ist178034";

	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	# Inicia a transação
	$connection->beginTransaction();

	# Retorna o id da página pretendida
	$sql = "SELECT pagecounter FROM pagina WHERE nome='$pagename' ;";
	$result = $connection->query($sql);
	while ($r = $result->fetch()) 
	{
		$page_id = $r['pagecounter'];
	}
	
	#Caso não haja resultado, é porque não existe a página
	if ($page_id === null)
	{
		echo("Página não existente");
		# Faz rollback da transação
		$connection->rollBack();	
	}
	else
	{
		# Retorna os registo da página
		$sql = "SELECT * FROM reg_pag WHERE pageid=$page_id AND ativa=1;";
		$result = $connection->query($sql);
		$num = $result->rowCount();
	
		# Escreve os registos encontrados
		echo("<p>$num registos encontrados:</p>\n");	
		echo("<table border=\"1\">\n");
		echo("<tr><td>idregpag</td><td>userid</td><td>pageid</td><td>typeid</td><td>idseq</td><td>ativa</td></tr>\n");
		foreach($result as $row)
		{
			echo("<tr><td>");
			echo($row["idregpag"]);
			echo("</td><td>");
			echo($row["userid"]);
			echo("</td><td>");
			echo($row["pageid"]);
			echo("</td><td>");
			echo($row["typeid"]);
			echo("</td><td>");
			echo($row["idseq"]);
			echo("</td><td>");
			echo($row["ativa"]);		
			echo("</td></tr>\n");
		}
		echo("</table>\n");
		
		# Faz commit da transação
		$connection->commit();	
	}

    $connection = null;

?>
</br>
</br>
<A name="bottom">
<A href="menu.html" onclick="location.href=this.href+'?key='+scrt_var;return false;">Retroceder</A>
<script type="text/javascript">
var scrt_var = <?php echo json_encode($user_id); ?>;;
</script>
</body>
</html>
