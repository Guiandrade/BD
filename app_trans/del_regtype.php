<html>
<body>
<?php

	# Herda a informação da página anterior
	if(isset($_POST['Submit'])) 
	{
        $pagename = $_POST['page_name'];
		$user_id = $_POST['userid'];
	}
	
	# Dados de ligação ao servidor
	$host="db.ist.utl.pt";
	$user="ist178034";	
	$password="sql";
	$dbname = "ist178034";	

	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	# Inicia a transação
	$connection->beginTransaction();

	$sql = "UPDATE tipo_registo SET ativo=0 WHERE userid=$user_id AND nome='$pagename'";
	$connection->query($sql);
	
	# Faz commit da transação
	$connection->commit();	
	
    $connection = null;
	echo("<p>Tipo de Registo apagado</p>\n");

?>

</br>
</br>
<A href="menu.html" onclick="location.href=this.href+'?key='+scrt_var;return false;">Retroceder</A>

<script language="javascript" type="text/javascript">
var scrt_var = <?php echo json_encode($user_id); ?>;;
</script>

</body>
</html>