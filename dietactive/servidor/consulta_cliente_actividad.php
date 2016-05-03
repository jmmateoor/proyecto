<?php
session_start();
include("config.inc.php");
include("funciones.inc.php");
$c = new MySQLi($servidor,$usuario,$password,$bbdd);
$c->set_charset("utf8");



$preparada = $c->prepare("select cliente.idactividad, actividadfisica.nombre from cliente join actividadfisica on cliente.idactividad = actividadfisica.id where cliente.id = ?");
$preparada->bind_param("i",$_SESSION["id"]);
$preparada->execute();
$preparada->bind_result($fecha,$peso);
$salida="[";
while($preparada->fetch())
{
	$salida.="{";
	$salida.="\"fecha\" : \"".$fecha."\",";
	$salida.="\"peso\" : \"".$peso."\"";
	$salida.="},";
}
$salida=substr($salida,0,-1);
$salida.="]";
echo $salida;
$c->close();
?>