<?php
	session_start();
	include("config.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$idalimento=$_POST['idalimento'];
	$preparada = $c->prepare("select id, alimento, idtipoalimento from alimento where id = ?");
	$preparada->bind_param("i",$idalimento);
	$preparada->execute();
	$preparada->bind_result($id,$alimento,$idtipoalimento);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"id\": \"".$id."\",";
		$salida.="\"alimento\": \"".$alimento."\",";
		$salida.="\"idtipoalimento\": \"".$idtipoalimento."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>