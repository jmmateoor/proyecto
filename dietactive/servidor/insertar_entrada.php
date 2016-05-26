<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	$fecha=date("Y-m-d H:i");
	
	
	$preparada = $c->prepare("insert into entrada(fecha, titulo, texto, imagen, video, idcategoria, iddietista) values (?, ?, ?, ?, ?, ?, ?)");
	$preparada->bind_param("sssssii",$fecha,$_POST["titulo"],$_POST["texto"], $_POST["imagen"],$_POST["video"],$_POST["idcategoria"],$_SESSION["id"]);
	if($preparada->execute())
	{
		echo "s";
	}
	$c->close();
?>