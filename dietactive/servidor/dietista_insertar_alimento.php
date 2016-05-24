<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$connex = new MySQLi($servidor,$usuario,$password,$bbdd);
	$connex->set_charset("utf8");
	
	$insertar = $connex->prepare("insert into alimento (idtipoalimento, alimento, comestible, energia, proteinas, lipidos, ags, agp, agm, colesterol, glucidos, fibra, sodio, potasio, calcio, magnesio, fosforo, hierro, zinc, yodo, b1, b2,  b6,  b12,  b9,  b3,  c,  a,  d,  e) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$insertar->bind_param("isiidddddddddddddddddddddddddd",$_POST["idtipoalimento"],$_POST["alimento"], $_POST["comestible"], $_POST["energia"], $_POST["proteinas"], $_POST["lipidos"], $_POST["ags"], $_POST["agp"], $_POST["agm"], $_POST["colesterol"], $_POST["glucidos"], $_POST["fibra"], $_POST["sodio"], $_POST["potasio"], $_POST["calcio"], $_POST["magnesio"], $_POST["fosforo"], $_POST["hierro"], $_POST["zinc"], $_POST["yodo"], $_POST["b1"], $_POST["b2"], $_POST["b6"], $_POST["b12"], $_POST["b9"], $_POST["b3"], $_POST["c"], $_POST["a"], $_POST["d"], $_POST["e"]);
	if($insertar->execute())
	{
		echo "s";
	}
	$connex->close();
?>