<html>
<body>	
	
<?php

	# Processa os dados da página anterior
	if(isset($_POST['Submit'])) 
	{
        $user_name = $_POST['user_name'];
		$e_mail = $_POST['email'];
		$pass_word = $_POST['pass_word'];
		$q1 = $_POST['q1'];
		$a1 = $_POST['a1'];
		$q2 = $_POST['q2'];
		$a2 = $_POST['a2'];
		$country = $_POST['country'];
	}

	# Dados de ligação ao servidor
	$servername="db.ist.utl.pt";
	$username="ist178034";	
	$password="sql";
	$dbname = "ist178034";

try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		#Procura por um utilizador com o username requisitado para ver se não existe já algum com esse nome		
		$sql = "SELECT userid FROM utilizador WHERE nome = '$user_name' OR email='$e_mail' ;";
		$result = $conn->query($sql);
		while ($r = $result->fetch()) 
		{
			$userid = $r['userid'];		
		}	
		#Caso não haja resultado, é porque o utilizador é válido
		if ($userid === null)
		{
			
			# Cria o utilizador tendo por base os dados fornecidos antes
	    	$sql = "INSERT INTO utilizador (email,nome,password, questao1, resposta1, questao2, resposta2, pais, categoria) VALUES ('$email', '$user_name' ,'$pass_word','$q1','$a1','$q2','$a2','$country','PT')";
		    $conn->exec($sql);
		    echo "Novo utilizador criado com sucesso";
			
			#Vai buscar o userid do utilizador recém criado para ser passado como argumento à página seguinte
			$sql = "SELECT userid FROM utilizador ORDER BY userid DESC LIMIT 1;";
			$result = $conn->query($sql);
			while ($r = $result->fetch()) 
			{
				$userid = $r['userid'];		
			}
		}
		else
		{
			echo("Utilizador ou email já existente");
			$userid = null ;	
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
<!--
	Passa como argumento do url da página seguinte o userid recém criado
-->
<a id="forward" href="menu.html" onclick="location.href=this.href+'?key='+scrt_var;return false;">Avançar</a>
<a id="back" href="add_user.html">Regressar</a>
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
