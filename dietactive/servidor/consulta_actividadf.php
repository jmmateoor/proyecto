<?php
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$preparada = $c->prepare("select id, nombre, descripcion from actividadfisica");
	$preparada->execute();
	$preparada->bind_result($id,$nombre,$descripcion);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"id\": \"".$id."\",";
		$salida.="\"nombre\": \"".$nombre."\",";
		$salida.="\"descripcion\": \"".$descripcion."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>