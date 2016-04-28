<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$_SESSION["peso"]=$_POST["actpeso"];
	
	$insertar = $c->prepare("update cliente set peso = ? where id = ?");
	$insertar->bind_param("di",$_SESSION["peso"],$_SESSION["id"]);
	if($insertar->execute())
	{
		borrarIntercambios($_SESSION["id"]);
		crearIntercambios($_SESSION["id"]);
		pesoHistorico($_SESSION["id"]);
		echo "s";
	}
?>