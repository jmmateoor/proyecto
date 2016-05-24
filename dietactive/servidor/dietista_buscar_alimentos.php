<?php
	session_start();
	include("config.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$texto="%{$_POST['texto']}%";
	$preparada = $c->prepare("select id, alimento from alimento where alimento like ?");
	$preparada->bind_param("s",$texto);
	$preparada->execute();
	$preparada->bind_result($id,$alimento);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"id\": \"".$id."\",";
		$salida.="\"alimento\": \"".$alimento."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>