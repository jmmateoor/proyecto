<?php
	session_start();
	include("config.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	$preparada = $c->prepare("select id, nombre, ruta from imagenpre");
	$preparada->execute();
	$preparada->bind_result($id,$nombre,$ruta);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"id\": \"".$id."\",";
		$salida.="\"nombre\": \"".$nombre."\",";
		$salida.="\"ruta\": \"".$ruta."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>