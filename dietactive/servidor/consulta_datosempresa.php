<?php
	include("config.php");
	include("funciones.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$preparada = $c->prepare("select nombre, provincia, localidad, codigopostal, direccion, telefono1, telefono2, email from datosempresa");
	$preparada->execute();
	$preparada->bind_result($nombre, $provincia, $localidad, $codigopostal, $direccion, $telefono1, $telefono2, $email);
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
		$salida.="\"email\" : \"".$email."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>