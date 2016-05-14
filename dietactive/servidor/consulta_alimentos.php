<?php
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$idtipoalimento=$_POST["idtipoalimento"];
	$preparada = $c->prepare("select id, alimento from alimento where idtipoalimento = ? order by 2");
	$preparada->bind_param("i",$idtipoalimento);
	$preparada->execute();
	$preparada->bind_result($id,$nombre);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"id\": \"".$id."\",";
		$salida.="\"alimento\": \"".$nombre."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>