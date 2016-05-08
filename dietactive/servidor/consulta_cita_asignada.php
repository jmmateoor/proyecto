<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$_SESSION["id"]=17;
	$fecha=date("Y-m-d H:i:s");
	
	$preparada = $c->prepare("select cita.cita, cita.iddietista, dietista.nombre, dietista.apellidos from cita join dietista on cita.iddietista = dietista.id where idcliente= ? and cita >= ?");
	$preparada->bind_param("is",$_SESSION["id"],$fecha);
	$preparada->execute();
	$preparada->bind_result($cita,$iddietista,$nombredietista,$apellidosdietista);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"cita\" : \"".$cita."\",";
		$salida.="\"iddietista\" : \"".$iddietista."\",";
		$salida.="\"nombredietista\" : \"".$nombredietista."\",";
		$salida.="\"apellidosdietista\" : \"".$apellidosdietista."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>