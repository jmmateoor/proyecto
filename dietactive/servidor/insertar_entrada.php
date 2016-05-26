<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$cita=$_POST["cita"];
	$iddietista=$_POST["dietista"];
	$tipo=$_POST["tipo"];
	$preparada = $c->prepare("insert into entrada(fecha, titulo, texto, imagen, video, idcategoria) values (?, ?, ?, ?)");
	$preparada->bind_param("siis",$cita,$iddietista,$_SESSION["id"],$tipo);
	if($preparada->execute())
	{
		$date=date_create($cita);
		
		
		//Titulo
		$titulo = "Cita en DietActive";
		//cabecera
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=utf-8\r\n"; 
		//dirección del remitente 
		$headers .= "From: DietActive < citas >\r\n";
		//Enviamos el mensaje a tu_dirección_email 
		$mensaje='Tu cita es para el día '.date_format($date,"d/m/Y").' a las '.date_format($date,"H:i").'. Para que tengas un mejor seguimiento, te recomendamos encarecidamente que realices el diario dietético para poder atenderte mejor.';
		$bool = mail($_SESSION["email"],$titulo,$mensaje,$headers);
		
		
		if($bool)
		{
			echo "s";
		}
	}
	$c->close();
?>