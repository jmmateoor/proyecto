<?php
	session_start();
	
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
		$_SESSION["logeado"]=true;
		
		while($consulta->fetch())
		{
			$_SESSION["id"]=$id;
			$_SESSION["nombre"]=$nombre;
			$_SESSION["apellidos"]=$apellidos;
			$_SESSION["email"]=$email;
			$_SESSION["peso"]=$peso;
			$_SESSION["pesodeseable"]=$pesodeseable;
			$_SESSION["sexo"]=$sexo;
			$_SESSION["fechanac"]=$fechanac;
			$_SESSION["altura"]=$altura;
			$_SESSION["dieta"]=$dieta;
			
		}
		$salida="s";
	}
	else
	{
		$salida="n";
	}
	echo $salida;
?>