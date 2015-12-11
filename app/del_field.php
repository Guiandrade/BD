<html>
<body>
<?php

	# Herda a informação da página anterior
	if(isset($_POST['Submit'])) 
	{
        $pagename = $_POST['page_name'];
		$regname = $_POST['reg_name'];
		$user_id = $_POST['userid'];
	}
	
	# Dados de ligação ao servidor
	$host="db.ist.utl.pt";
	$password="sql";
	$dbname = "ist178034";

	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
	#Procura pelo id do tipo requisitado		
	$sql = "SELECT typecnt FROM tipo_registo WHERE nome = '$regname' ;";
	$result = $connection->query($sql);
	while ($r = $result->fetch()) 
	{
		$regtype = $r['typecnt'];		
	}	
	
	if ($regtype === null)
	{
		echo("<p>Tipo de Registo não encontrado<p>");
	}
	else
	{
		# Atualiza a flag ativa do campo para zero.
		$sql = "UPDATE campo SET ativo=0 WHERE userid=$user_id AND nome='$pagename' AND typecnt=$regtype";
		$connection->query($sql);
		echo("<p>Campo retirado</p>\n");
	}
	
    $connection = null;

?>

</br>
</br>
<A href="menu.html" onclick="location.href=this.href+'?key='+scrt_var;return false;">Retroceder</A>

<script language="javascript" type="text/javascript">
var scrt_var = <?php echo json_encode($user_id); ?>;;
</script>

</body>
</html>