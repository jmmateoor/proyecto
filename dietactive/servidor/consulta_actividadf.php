<?php
	$c = new MySQLi("localhost","root","1234","dietactive");
	$c->set_charset("utf8");
	$preparada = $c->prepare("select id, nombre from actividadfisica");
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