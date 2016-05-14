<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$cita=$_POST["cita"];
	$iddietista=$_POST["dietista"];
	$tipo=$_POST["tipo"];
	$preparada = $c->prepare("insert into cita(cita, iddietista, idcliente, tipocita) values (?, ?, ?, ?)");
	$preparada->bind_param("siis",$cita,$iddietista,$_SESSION["id"],$tipo);
	if($preparada->execute())
	{
		echo "s";
	}
	$c->close();
?>