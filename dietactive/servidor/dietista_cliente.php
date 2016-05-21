<?php
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$idcliente=$_POST["idcliente"];
	$preparada = $c->prepare("select cliente.id, cliente.nombre, cliente.apellidos, cliente.telefono, cliente.email, cliente.sexo, cliente.peso, cliente.altura, cliente.fechanac, cliente.pesodeseable, cliente.dieta, cliente.geet, cliente.cp, actividadfisica.nombre, actividadfisica.descripcion from cliente join actividadfisica on cliente.idactividad = actividadfisica.id where cliente.id=?");
	$preparada->bind_param("i",$idcliente);
	$preparada->execute();
	$preparada->bind_result($id,$nombre,$apellidos,$telefono,$email,$sexo,$peso,$altura,$fechanac,$pesodeseable,$dieta,$geet,$cp,$actividadfisica,$descripcionactividad);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"id\": \"".$id."\",";
		$salida.="\"nombre\": \"".$nombre."\",";
		$salida.="\"apellidos\": \"".$apellidos."\",";
		$salida.="\"telefono\": \"".$telefono."\",";
		$salida.="\"email\": \"".$email."\",";
		$salida.="\"sexo\": \"".$sexo."\",";
		$salida.="\"peso\": \"".$peso."\",";
		$salida.="\"altura\": \"".$altura."\",";
		$edad=edad($fechanac);
		$salida.="\"fechanac\": \"".$edad."\",";
		$salida.="\"pesodeseable\": \"".$pesodeseable."\",";
		$salida.="\"dieta\": \"".$dieta."\",";
		$salida.="\"geet\": \"".$geet."\",";
		$salida.="\"cp\": \"".$cp."\",";
		$salida.="\"actividadfisica\": \"".$actividadfisica."\",";
		$salida.="\"descripcionactividad\": \"".$descripcionactividad."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$c->close();
?>