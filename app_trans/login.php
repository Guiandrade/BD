<html>
<body>	
	
<!---
	
-->
	
<?php

	#Recebe os dados da página anterior
	if(isset($_POST['Submit'])) 
	{
        $user_name = $_POST['user_name'];
		$pass_word = $_POST['pass_word'];
	}

	#Dados de ligação à base de dados
	$servername="db.ist.utl.pt";
	$username="ist178034";
	$password="sql";	
	$dbname = "ist178034";
	
	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		# Inicia a transação
		$conn->beginTransaction();

		#Procura por um utilizador com o username e password requisitados				
		$sql = "SELECT userid FROM utilizador WHERE nome = '$user_name' AND password = '$pass_word';";
		$result = $conn->query($sql);
		while ($r = $result->fetch()) 
		{
			$userid = $r['userid'];		
		}	
		#Caso não haja resultado, é porque a password ou utilizador estavam incorretos
		if ($userid === null)
		{
			echo("Utilizador e/ou Password incorretos");
			# Faz rollback da transação
			$conn->rollBack();
		}
		else
		{
			# Faz commit da transação
			$conn->commit();	
			echo("Login com sucesso");
		}
	
    }
catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>

</br>
</br>
<!---
	Em caso de sucesso de login, vai ser disponibilizado o botão para avançar e no endereço da próxima página vai estar incluído o userid do utilizador que acabou de se logar
-->
<a id="forward" href="menu.html" onclick="location.href=this.href+'?key='+scrt_var;return false;">Avançar</a>
<a id="back" href="login.html">Regressar</a>
<script language="javascript" type="text/javascript">
var scrt_var = <?php echo json_encode($userid); ?>;;
if ( scrt_var === undefined || scrt_var === null  ){
	document.getElementById("forward").style.display = 'none';
	document.getElementById("back").style.display = 'block';
}
else
{
	document.getElementById("forward").style.display = 'block';
	document.getElementById("back").style.display = 'none';
};	
</script>
</body>
</html>