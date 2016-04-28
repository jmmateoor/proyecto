<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$_SESSION["telefono"]=$_POST["acttelefono"];
	
	$insertar = $c->prepare("update cliente set telefono = ? where id = ?");
	$insertar->bind_param("si",$_SESSION["telefono"],$_SESSION["id"]);
	if($insertar->execute())
	{
		echo "s";
	}
?>