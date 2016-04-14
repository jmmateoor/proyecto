<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Activación de cuenta - DietActive</title>
</head>

<body>
<?php
include("config.php");
if (isset($_GET['id']))
{
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$id=$_GET['id'];
	$codigo=$_GET['codigo'];  ;
	
    $preparada = $c->prepare("update cliente set activado='s' where id=? and codigo_activacion=?");
	$preparada->bind_param("is",$id,$codigo);
	if($preparada->execute())
	{
		echo "Activado correctamente";
	}
	else
	{
		echo "Error";
	}
}
?>
</body>
</html>