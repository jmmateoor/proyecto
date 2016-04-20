<?php
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	
	$password=md5($_POST['password']);
	$email=$_POST['email'];
	$activado="s";
	$consulta = $c->prepare("select id, nombre, apellidos, email, peso, pesodeseable, sexo, fechanac, altura, dieta from cliente where email = ? and password = ? and activado = ?");
	$consulta->bind_param("sss",$email, $password, $activado);
	$consulta->execute();
	$consulta->bind_result($id,$nombre, $apellidos, $email, $peso, $pesodeseable, $sexo, $fechanac, $altura, $dieta);
	$consulta->store_result();
	if($consulta->num_rows>0)
	{
		$salida="[";
		while($consulta->fetch())
		{
			$salida.="{";
			$salida.="\"id\" : \"".$id."\",";
			$salida.="\"nombre\" : \"".$nombre."\",";
			$salida.="\"apellidos\" : \"".$apellidos."\",";
			$salida.="\"email\" : \"".$email."\",";
			$salida.="\"peso\" : \"".$peso."\",";
			$salida.="\"pesodeseable\" : \"".$pesodeseable."\",";
			$salida.="\"sexo\" : \"".$sexo."\",";
			$salida.="\"fechanac\" : \"".$fechanac."\",";
			$salida.="\"altura\" : \"".$altura."\",";
			$salida.="\"dieta\" : \"".$dieta."\"";
			$salida.="},";
		}
		$salida=substr($salida,0,-1);
		$salida.="]";

	}
	else
	{
		$salida="n";
	}
	echo $salida;
?>