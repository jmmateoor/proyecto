<?php
include("config.inc.php");
$c = new MySQLi($servidor,$usuario,$password,$bbdd);
$c->set_charset("utf8");

$idcliente=$_POST['idcliente'];
$preparada = $c->prepare("select idgrupo, valor from tablaintercambio where idcliente = ?");
$preparada->bind_param("i",$idcliente);
$preparada->execute();
$preparada->bind_result($idgrupo,$valor);
$salida="[";
while($preparada->fetch())
{
	$salida.="{";
	$salida.="\"idgrupo\": \"".$idgrupo."\",";
	$salida.="\"valor\": \"".$valor."\"";
	$salida.="},";
}
$salida=substr($salida,0,-1);
$salida.="]";
echo $salida;
$c->close();
?>