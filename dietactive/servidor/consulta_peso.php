<?php
	include("config.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	$idcliente=$_POST['idcliente'];
	
	$preparada = $c->prepare("select fecha, peso from historicopeso where idcliente = ? order by 1 desc limit 5");
	$preparada->bind_param("i",$idcliente);
	$preparada->execute();
	$preparada->bind_result($fecha,$peso);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"fecha\" : \"".$fecha."\",";
		$salida.="\"peso\" : \"".$peso."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>