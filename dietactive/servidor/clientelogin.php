<?php
	include("config.inc.php");
	include("funciones.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	$password=md5($_POST['password']);
	$email=$_POST['email'];
	$consulta = $c->prepare("select id from cliente where email = ? and password = ?");
	$consulta->bind_param("ss",$email, $password);
	$consulta->execute();
	$consulta->store_result();
	if($consulta->num_rows>0)
	{
		$salida="s";

	}
	else
	{
		$salida="n";
	}
	echo $salida;
?>