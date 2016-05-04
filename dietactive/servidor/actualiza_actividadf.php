<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$idactividad=$_POST["idactividad"];
	
	$insertar = $c->prepare("update cliente set idactividad = ? where id = ?");
	$insertar->bind_param("ii",$idactividad,$_SESSION["id"]);
	if($insertar->execute())
	{
		borrarIntercambios($_SESSION["id"]);
		crearIntercambios($_SESSION["id"]);
		echo "s";
	}
?>