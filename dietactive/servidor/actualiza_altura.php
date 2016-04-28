<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$_SESSION["altura"]=floor($_POST["actaltura"]);
	$_SESSION["pesodeseable"]=pesoDeseable($_SESSION["altura"],$_SESSION["sexo"]);
	
	$insertar = $c->prepare("update cliente set altura = ?, pesodeseable = ? where id = ?");
	$insertar->bind_param("ddi",$_SESSION["altura"],$_SESSION["pesodeseable"],$_SESSION["id"]);
	if($insertar->execute())
	{
		borrarIntercambios($_SESSION["id"]);
		crearIntercambios($_SESSION["id"]);
		echo "s";
	}
?>