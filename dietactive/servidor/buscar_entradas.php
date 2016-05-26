<?php
	session_start();
	include("config.inc.php");
	$conn = new MySQLi($servidor,$usuario,$password,$bbdd);
	$conn->set_charset("utf8");
	$titulo="%{$_POST['titulo']}%";
	$preparada = $conn->prepare("select id, fecha, titulo from entrada where titulo like ?");
	$preparada->bind_param("s", $titulo);
	$preparada->execute();
	$preparada->bind_result($id, $fecha, $titulo);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"id\": \"".$id."\",";
		$salida.="\"fecha\": \"".$fecha."\",";
		$salida.="\"titulo\": \"".$titulo."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$conn->close();
?>