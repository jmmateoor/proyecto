<?php
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$preparada = $c->prepare("select nombre, provincia, localidad, codigopostal, direccion, telefono1, telefono2, email, desarrollado from datosempresa");
	$preparada->execute();
	$preparada->bind_result($nombre, $provincia, $localidad, $codigopostal, $direccion, $telefono1, $telefono2, $email, $desarrollado);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"nombre\" : \"".$nombre."\",";
		$salida.="\"provincia\" : \"".$provincia."\",";
		$salida.="\"localidad\" : \"".$localidad."\",";
		$salida.="\"codigopostal\" : \"".$codigopostal."\",";
		$salida.="\"direccion\" : \"".$direccion."\",";
		$salida.="\"telefono1\" : \"".$telefono1."\",";
		$salida.="\"telefono2\" : \"".$telefono2."\",";
		$salida.="\"email\" : \"".$email."\",";
		$salida.="\"desarrollado\" : \"".$desarrollado."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>