<?php
	session_start();
	include("config.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	$preparada = $c->prepare("select altura, pesodeseable, geet from cliente where id = ?");
	$preparada->bind_param("i",$_SESSION["id"]);
	$preparada->execute();
	$preparada->bind_result($altura,$pesodeseable,$geet);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"altura\" : \"".$altura."\",";
		$salida.="\"geet\" : \"".$geet."\",";
		$salida.="\"pesodeseable\" : \"".$pesodeseable."\"";
		$salida.="},";
		$_SESSION["geet"]=$geet;
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>