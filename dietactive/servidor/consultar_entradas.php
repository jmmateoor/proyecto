<?php
	session_start();
	include("config.inc.php");
	$conn = new MySQLi($servidor,$usuario,$password,$bbdd);
	$conn->set_charset("utf8");
	//$titulo="%{$_POST['titulo']}%";
	$preparada = $conn->prepare("select entrada.id, entrada.fecha, entrada.titulo, entrada.texto, entrada.imagen, entrada.video, categoria.nombre, dietista.nombre, dietista.apellidos from entrada join categoria on entrada.idcategoria = categoria.id join dietista on entrada.iddietista = dietista.id where entrada.id = ?");
	$preparada->bind_param("i", $_POST["id"]);
	$preparada->execute();
	$preparada->bind_result($id, $fecha, $titulo, $texto,$imagen,$video,$categoria,$dietnombre,$dietapellidos);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"id\": \"".$id."\",";
		$salida.="\"fecha\": \"".$fecha."\",";
		$salida.="\"titulo\": \"".$titulo."\",";
		$salida.="\"texto\": \"".$texto."\",";
		$salida.="\"imagen\": \"".$imagen."\",";
		$salida.="\"video\": \"".$video."\",";
		$salida.="\"categoria\": \"".$categoria."\",";
		$salida.="\"dietnombre\": \"".$dietnombre."\",";
		$salida.="\"dietapellidos\": \"".$dietapellidos."\"";
		
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$conn->close();
?>