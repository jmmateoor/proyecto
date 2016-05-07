<?php
	session_start();
	include("config.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$dia=$_POST["dia"];
	$momento=$_POST["momento"];
	$alimentos=$_POST["alimentos"];
	$cantidades=$_POST["cantidad"];
	
	$preparada = $c->prepare("insert into testdias (dia, momento, idcliente, idalimento, cantidad) values (?, ?, ?, ?, ?)");
	$preparada->bind_param("isiid",$dia,$momento,$_SESSION["id"],$idalimento,$cantidad);
	
	for($i=0;$i<count($alimentos);$i++)
	{
		$idalimento=$alimentos[$i];
		$cantidad=$cantidades[$i];
		$preparada->execute();
	}
	echo "s";
?>