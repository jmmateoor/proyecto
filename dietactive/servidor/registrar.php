<?php

	include("config.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	$codigo=genera_random(20);
	$activado="n";
	$password=$_POST['password'];
	$nombre=$_POST['nombre'];
	$apellidos=$_POST['apellidos'];
	$telefono=$_POST['telefono'];
	$email=$_POST['email'];
	$sexo=$_POST['sexo'];
	$peso=$_POST['peso'];
	$altura=$_POST['altura'];
	$fechanac=$_POST['fechanac'];
	$actividadf=$_POST['actividadf'];
	
	//calcular
	$pesodeseable=55;
	
	$fechaingreso=date("Y-m-d");
	
	$preparada = $c->prepare("insert into cliente(codigo_activacion, activado, password, nombre, apellidos, telefono, email, sexo, peso, altura, fechanac, idactividad, pesodeseable, fechaingreso) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	
	$preparada->bind_param("ssssssssdisids",$codigo,$activado, $password,$nombre, $apellidos, $telefono, $email, $sexo, $peso, $altura, $fechanac, $actividadf, $pesodeseable, $fechaingreso);
	
	if($preparada->execute())
	{
		
		
		$consulta = $c->prepare("select id from cliente where email = ?");
		$consulta->bind_param("s",$email);
		$consulta->execute();
		$consulta->bind_result($idcliente);
		while($consulta->fetch())
		{
			$id=$idcliente;
		}
		
		$path="http://localhost:8080/daw/proyecto/dietactive/servidor/activar_cuenta.php";
		$link=$path."?id=".$id."&codigo=".$codigo."";
		
		
		$mensaje='Gracias por registrate en DietActive,
Utiliza el siguiente enlace para activar tu cuenta
'.$link;
		$asunto="Activación de cuenta en DietActive";
		if(mail($email,$asunto,$mensaje))
		{
			echo "Se ha enviado un e-mail a tu correo electrónico para activar la cuenta. Verifica tu bandeja de entrada y tu carpeta de spam.";
		}
	}
	else
	{
		echo "Ha ocurrido un error durante el registro. Intentalo de nuevo más tarde.";
	}
	$c->close();
?>