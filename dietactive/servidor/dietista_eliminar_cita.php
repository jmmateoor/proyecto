<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$cita=$_POST["cita"];
	$idcliente=$_POST["idcliente"];
	$email=$_POST["email"];
	$preparada = $c->prepare("delete from cita where idcliente = ? and cita = ? and iddietista = ?");
	$preparada->bind_param("isi",$idcliente,$cita,$_SESSION["id"]);
	if($preparada->execute())
	{
		//Titulo
		$titulo = "Cancelación de cita - DietActive";
		//cabecera
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
		//dirección del remitente 
		$headers .= "From: DietActive < info >\r\n";
		//Enviamos el mensaje a tu_dirección_email 
		$mensaje='Tu cita ha sido cancelada. Por favor, coge una nueva cita.';
		$bool = mail($email,$titulo,$mensaje,$headers);
		
		if($bool)
		{
			echo "s";
		}
	}
	$c->close();
?>