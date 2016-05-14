<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$cita=$_POST["cita"];
	$iddietista=$_POST["dietista"];
	$preparada = $c->prepare("delete from cita where idcliente = ? and cita = ? and iddietista = ?");
	$preparada->bind_param("isi",$_SESSION["id"],$cita,$iddietista);
	if($preparada->execute())
	{
		echo "s";
	}
	$c->close();
?>