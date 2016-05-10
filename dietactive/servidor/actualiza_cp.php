<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$_SESSION["cp"]=$_POST["actcp"];
	
	$insertar = $c->prepare("update cliente set cp = ? where id = ?");
	$insertar->bind_param("si",$_SESSION["cp"],$_SESSION["id"]);
	if($insertar->execute())
	{
		echo "s";
	}
?>