<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$dia=$_POST["dia"];
	$momento=$_POST["momento"];
	$preparada = $c->prepare("delete from testdias where idcliente = ? and dia = ? and momento = ?");
	$preparada->bind_param("iis",$_SESSION["id"],$dia,$momento);
	if($preparada->execute())
	{
		echo "s";
	}
	$c->close();
?>