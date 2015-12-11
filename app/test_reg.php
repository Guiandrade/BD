<html>
<body>
<?php
	
	$host="db.ist.utl.pt";	// o MySQL esta disponivel nesta maquina
	$user="ist178034";	// -> substituir pelo nome de utilizador
	$password="sql";	// -> substituir pela password (dada pelo mysql_reset, ou atualizada pelo utilizador)
	$dbname = "ist178034";	// a BD tem nome identico ao utilizador

	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	echo("<p>Connected to MySQL database $dbname on $host as user $user</p>\n");

	echo 'Registo: <input type="text" name="Registo:" />' ;
	echo '<input type="submit" name="Submit">';
	

?>

</br>
</br>
<A href="menu.html" onclick="location.href=this.href+'?key='+scrt_var;return false;">Retroceder</A>

<script language="javascript" type="text/javascript">
var scrt_var = <?php echo json_encode($user_id); ?>;;
</script>

</body>
</html>