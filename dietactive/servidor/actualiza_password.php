<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$password=md5($_POST['password']);
	
	$insertar = $c->prepare("update cliente set password = ? where id = ?");
	$insertar->bind_param("si",$password,$_SESSION["id"]);
	if($insertar->execute())
	{
		echo "s";
	}
?>