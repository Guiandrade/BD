<html>
<body>
<?php

	# Herda a informação da página anterior
	if(isset($_POST['Submit'])) 
	{
        $fieldname = $_POST['field_name'];
		$typename = $_POST['type_name'];
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

	# Cria uma nova sequência
	$sql = "INSERT INTO sequencia (userid ) VALUES ($user_id)";
	$connection->query($sql);

	# Retorna o valor da sequência criada
	$sql = "SELECT contador_sequencia FROM sequencia ORDER BY contador_sequencia DESC LIMIT 1;";
	$result = $connection->query($sql);
	while ($r = $result->fetch()) 
	{
		$seq_num = $r['contador_sequencia'];		
	}
	
	# Retorna o id do tipo de registo que vai ser alterado
	$sql = "SELECT typecnt FROM tipo_registo WHERE nome='$typename' AND userid = $user_id;";
	$result = $connection->query($sql);
	while ($r = $result->fetch()) 
	{
		$type_r = $r['typecnt'];		
	}
	
	# Retorna o id do ultimo campo desse tipo
	$sql = "SELECT campocnt FROM campo ORDER BY campocnt DESC LIMIT 1;";
	$result = $connection->query($sql);
	while ($r = $result->fetch()) 
	{
		$cmpcnt = $r['campocnt'];		
	}
	$cmpcnt++ ;
	
	# Insere o novo campo
	$sql = "INSERT INTO campo (userid, typecnt, campocnt, idseq, ativo, nome) VALUES ($user_id, $type_r, $cmpcnt, $seq_num, true, '$fieldname')";
	$connection->query($sql);
	
	# Faz commit da transação
	$connection->commit();
	
    $connection = null;
	echo("<p>Campo inserido com sucesso</p>\n");

?>

</br>
</br>
<A href="menu.html" onclick="location.href=this.href+'?key='+scrt_var;return false;">Retroceder</A>

<script language="javascript" type="text/javascript">
var scrt_var = <?php echo json_encode($user_id); ?>;;
</script>

</body>
</html>