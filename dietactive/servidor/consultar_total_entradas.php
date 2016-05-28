<?php
	session_start();
	include("config.inc.php");
	$conn = new MySQLi($servidor,$usuario,$password,$bbdd);
	$conn->set_charset("utf8");
	
	
	$preparada = $conn->prepare("select count(id) from entrada");
	$preparada->execute();
	$preparada->bind_result($total);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"total\": \"".$total."\",";
		$salida.="\"paginacion\": \"".$paginacion."\"";
		
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$conn->close();
?>