<?php
	include("config.php");
	$email=$_GET['email'];
	
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$preparada = $c->prepare("select email from cliente where email = ?");
	$preparada->bind_param("s",$email);
	$preparada->execute();
	$preparada->store_result();
	if($preparada->num_rows>0)
	{
		echo "s";	
	}
	else
	{
		echo "n";
	}
	$c->close();
?>