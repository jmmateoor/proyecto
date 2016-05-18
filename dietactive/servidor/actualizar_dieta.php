<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$idcliente=$_POST["idcliente"];
	$dieta=$_POST["dieta"];
	
	$insertar = $c->prepare("update cliente set dieta = ? where id = ?");
	$insertar->bind_param("si",$dieta,$idcliente);
	if($insertar->execute())
	{
		echo "s";
	}
?>