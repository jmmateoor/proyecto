<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$idcliente=$_POST["idcliente"];
	$preparada = $c->prepare("SELECT patologia.id, patologia.nombre FROM patologiacliente JOIN patologia ON patologiacliente.idpatologia=patologia.id WHERE idcliente = ?");
	$preparada->bind_param("i",$idcliente);
	$preparada->execute();
	$preparada->bind_result($id,$nombre);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"id\": \"".$id."\",";
		$salida.="\"nombre\": \"".$nombre."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>