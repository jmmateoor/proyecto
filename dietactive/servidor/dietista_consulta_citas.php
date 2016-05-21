<?php
	include("config.inc.php");
	include("funciones.inc.php");
	session_start();
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$dias=$_POST["dias"];
	$fecha=date("Y-m-d");
	if($dias==1)
	{
		$fechainicio=$fecha." 0:00:00";
		$fechafin=$fecha." 23:59:59";
		$preparada = $c->prepare("select cita.cita, cita.idcliente, cita.tipocita, cliente.nombre, cliente.apellidos, cliente.email from cita join cliente on cita.idcliente = cliente.id  where iddietista = ? and cita >= ? and cita <= ? order by 1");
		$preparada->bind_param("iss",$_SESSION["id"],$fechainicio,$fechafin);
		$preparada->execute();
		$preparada->bind_result($cita,$idcliente,$tipocita, $nombre, $apellidos,$email);
	}
	else
	{
		$preparada = $c->prepare("select cita.cita, cita.idcliente, cita.tipocita, cliente.nombre, cliente.apellidos, cliente.email from cita join cliente on cita.idcliente = cliente.id  where iddietista = ? and cita >= ? order by 1");
		$preparada->bind_param("is",$_SESSION["id"],$fecha);
		$preparada->execute();
		$preparada->bind_result($cita,$idcliente,$tipocita, $nombre, $apellidos, $email);
	}
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"cita\": \"".$cita."\",";
		$salida.="\"idcliente\": \"".$idcliente."\",";
		$salida.="\"tipocita\": \"".$tipocita."\",";
		$salida.="\"nombre\": \"".$nombre." ".$apellidos."\",";
		$salida.="\"email\": \"".$email."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>