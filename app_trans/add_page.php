<html>
<body>
<?php

	#Informação pedida ao utilizador anteriormente
	if(isset($_POST['Submit'])) 
	{
        $pagename = $_POST['page_name'];
		$user_id = $_POST['userid'];
	}
	
	#Dados de ligação ao servidor
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

	# Retorna o número da sequência criada
	$sql = "SELECT contador_sequencia FROM sequencia ORDER BY contador_sequencia DESC LIMIT 1;";
	$result = $connection->query($sql);
	while ($r = $result->fetch()) 
	{
		$seq_num = $r['contador_sequencia'];		
	}
	
	# Retorna o id da ultima página criada e adiciona-lhe 1
	$sql = "SELECT pagecounter FROM pagina ORDER BY pagecounter DESC LIMIT 1;";
	$result = $connection->query($sql);
	while ($r = $result->fetch()) 
	{
		$pagecounter = $r['pagecounter'];		
	}	
	$pagecounter++ ;
	
	
	#Procura por uma página desse utilizador com o mesmo nome	
	$sql = "SELECT pagecounter FROM pagina WHERE userid=$user_id AND nome='$pagename' ;";
	$result = $connection->query($sql);
	while ($r = $result->fetch()) 
	{
		$exists = $r['pagecounter'];		
	}	
	
	# Se não existir nenhuma, pode criar uma nova
	if ($exists === null)
		{
			#Insere a página na base de dados conforme os dados obtidos
			$sql = "INSERT INTO pagina (userid, pagecounter, nome, idseq, ativa) VALUES ($user_id, $pagecounter, '$pagename',$seq_num, true)";
			$connection->query($sql);

			# Faz commit da transação
			$connection->commit();
			
			echo("<p>Página criada com sucesso</p>\n");
		}
		else
		{
			# Faz rollback da transação
			$connection->rollBack();
			
			echo("O utilizador já tem essa página");
			$result = null ;	
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