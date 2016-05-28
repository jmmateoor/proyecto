<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$id=$_POST["id"];
	$preparada = $c->prepare("delete from entrada where id = ?");
	$preparada->bind_param("i",$id);
	if($preparada->execute())
	{
		echo "s";
	}
	$c->close();
?>