<?php
session_start();
include("config.inc.php");
$c = new MySQLi($servidor,$usuario,$password,$bbdd);
$c->set_charset("utf8");

$patologias=$_POST["patologias"];

$deletepatologias = $c->prepare("delete from patologiacliente where idcliente = ?");
$deletepatologias->bind_param("i",$_SESSION["id"]);
$deletepatologias->execute();

if($patologias!="ninguna")
{
	$patologias=explode(",",$patologias);
	$insertpatologias = $c->prepare("insert into patologiacliente(idcliente, idpatologia) values (?, ?)");
	$insertpatologias->bind_param("ii",$_SESSION["id"],$patologia);
	
	for($i=0;$i<count($patologias);$i++)
	{
		$patologia=$patologias[$i];
		$insertpatologias->execute();
	}
	echo "s";
}
else
{
	echo "s";
}

$c->close();
?>