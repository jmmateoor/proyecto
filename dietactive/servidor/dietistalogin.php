<?php
	session_start();
	
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	$password=md5($_POST['password']);
	$email=$_POST['email'];
	$activado="s";
	$consulta = $c->prepare("select id, nombre, apellidos, dni, email from dietista where email = ? and password = ?");
	$consulta->bind_param("ss",$email, $password);
	$consulta->execute();
	$consulta->bind_result($id,$nombre, $apellidos, $dni, $email);
	$consulta->store_result();
	if($consulta->num_rows>0)
	{
		$_SESSION["logeadodietista"]=true;
		
		while($consulta->fetch())
		{
			$_SESSION["id"]=$id;
			$_SESSION["nombre"]=$nombre;
			$_SESSION["apellidos"]=$apellidos;
			$_SESSION["dni"]=$dni;
			$_SESSION["email"]=$email;
		}
		$salida="s";
	}
	else
	{
		$salida="n";
	}
	echo $salida;
?>