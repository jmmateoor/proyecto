<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$dia=$_POST["dia"];
	$momento=$_POST["momento"];
	$preparada = $c->prepare("select testdias.dia, testdias.momento, testdias.idalimento, testdias.cantidad, alimento.alimento from testdias join alimento on testdias.idalimento = alimento.id where idcliente = ? and testdias.dia = ? and testdias.momento = ?");
	$preparada->bind_param("iis",$_SESSION["id"],$dia,$momento);
	$preparada->execute();
	$preparada->bind_result($dia,$momento,$idalimento,$cantidad,$alimento);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"dia\" : \"".$dia."\",";
		$salida.="\"momento\" : \"".$momento."\",";
		$salida.="\"idalimento\" : \"".$idalimento."\",";
		$salida.="\"cantidad\" : \"".$cantidad."\",";
		$salida.="\"alimento\" : \"".$alimento."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>