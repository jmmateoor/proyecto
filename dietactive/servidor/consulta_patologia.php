<?php
	include("config.inc.php");
	include("funciones.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$preparada = $c->prepare("select id, nombre from patologia");
	$preparada->execute();
	$preparada->bind_result($id,$nombre);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"id\" : \"".$id."\",";
		$salida.="\"nombre\" : \"".$nombre."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>