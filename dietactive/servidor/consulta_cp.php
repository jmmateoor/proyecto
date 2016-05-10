<?php
	session_start();
	include("config.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	$preparada = $c->prepare("select cp from cliente where id = ?");
	$preparada->bind_param("i",$_SESSION["id"]);
	$preparada->execute();
	$preparada->bind_result($cp);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"cp\" : \"".$cp."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>