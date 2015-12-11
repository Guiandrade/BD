<html>
<body>
<?php

	# Herda as informações pedidas na página anterior
	if(isset($_POST['Submit'])) 
	{
        $nome = $_POST['nome'];
		$user_id = $_POST['userid'];
	}

	# Dados de ligação ao servidor	
	$host="db.ist.utl.pt";	// o MySQL esta disponivel nesta maquina
	$user="ist178034";	// -> substituir pelo nome de utilizador
	$password="sql";	// -> substituir pela password (dada pelo mysql_reset, ou atualizada pelo utilizador)
	$dbname = "ist178034";	// a BD tem nome identico ao utilizador

	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	# Cria uma nova sequência
	$sql = "INSERT INTO sequencia (userid) VALUES ($user_id)";
	$connection->exec($sql);

	# Retorna o numero da ultima sequência criada
	$sql = "SELECT contador_sequencia FROM sequencia ORDER BY contador_sequencia DESC LIMIT 1;";
	$result = $connection->query($sql);	
	while ($r = $result->fetch()) 
	{
		$seq_num = $r['contador_sequencia'];		
	}
	
	# Retorna o número do ultimo tipo criado e soma-lhe 1
	$sql = "SELECT typecnt FROM tipo_registo ORDER BY typecnt DESC LIMIT 1;";
	$result = $connection->query($sql);
	while ($r = $result->fetch()) 
	{
		$type_cnt = $r['typecnt'];		
	}
	$type_cnt++ ;
	
	# Cria o novo tipo
	$sql = "INSERT INTO tipo_registo (userid, typecnt, nome, ativo, idseq ) VALUES ($user_id, $type_cnt, '$nome', true, $seq_num)";
	$connection->exec($sql);
	
    $connection = null;
	echo("<p>Novo tipo criado com sucesso</p>\n");

?>

</br>
</br>
<A href="menu.html" onclick="location.href=this.href+'?key='+scrt_var;return false;">Retroceder</A>

<script language="javascript" type="text/javascript">
var scrt_var = <?php echo json_encode($user_id); ?>;;
</script>

</body>
</html>