<?php

	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	$codigo=genera_random(20);
	$activado="n";
	$password=md5($_POST['password']);
	$nombre=$_POST['nombre'];
	$apellidos=$_POST['apellidos'];
	$telefono=$_POST['telefono'];
	$cp=$_POST['cp'];
	$email=$_POST['email'];
	$sexo=$_POST['sexo'];
	$peso=$_POST['peso'];
	$altura=$_POST['altura'];
	$fechanac=$_POST['fechanac'];
	$actividadf=$_POST['actividadf'];
	$patologias=$_POST['patologias'];
	//calcula peso deseable
	$pesodeseable=pesoDeseable($altura,$sexo);
	
	$fechaingreso=date("Y-m-d");
	
	$preparada = $c->prepare("insert into cliente(codigo_activacion, activado, password, nombre, apellidos, telefono, email, sexo, peso, altura, fechanac, idactividad, pesodeseable, fechaingreso, cp) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	
	$preparada->bind_param("ssssssssdisidss",$codigo,$activado, $password,$nombre, $apellidos, $telefono, $email, $sexo, $peso, $altura, $fechanac, $actividadf, $pesodeseable, $fechaingreso, $cp);
	
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
		
		if($patologias!="ninguna")
		{
			$patologias=explode(",",$patologias);
			$insertpatologias = $c->prepare("insert into patologiacliente(idcliente, idpatologia) values (?, ?)");
			$insertpatologias->bind_param("ii",$idcliente,$patologia);
			
			for($i=0;$i<count($patologias);$i++)
			{
				$patologia=$patologias[$i];
				$insertpatologias->execute();
			}
		}
		
		crearIntercambios($idcliente);
		pesoHistorico($idcliente);
		
		$link=$path."?id=".$id."&codigo=".$codigo."";
		
		
		$mensaje='Gracias por registrate en DietActive,
Utiliza el siguiente enlace para activar tu cuenta
'.$link;
		$asunto="Activación de cuenta en DietActive";
		if(mail($email,$asunto,$mensaje))
		{
			echo "s";
		}
	}
	else
	{
		echo "n";
	}
	$c->close();
?>