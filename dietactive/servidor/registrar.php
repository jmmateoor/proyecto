<?php
	/*include("conexion.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");*/
	
	
	if(mail("josem.mateo.ortega@gmail.com","asuntillo","Este es el cuerpo del mensaje"))
	{
		echo "Si";
	}
	else
	{
		echo "No";
	}
	
	
	/*$nombre_origen    = "Tuboolar Web"; 
	$email_origen     = "prueba@aa.com"; 
	$email_copia      = "prueba@aa.com"; 
	$email_ocultos    = "prueba@aa.com"; 
	$email_destino    = "josem.mateo.ortega@gmail.com";
	$asunto="Datos de registro";
	$mensaje="Este es el cuerpo del mensaje.";
	$formato="html";
	//Cabaceras
	$headers  = "From: $nombre_origen <$email_origen> \r\n"; 
	$headers .= "Return-Path: <$email_origen> \r\n"; 
	$headers .= "Reply-To: $email_origen \r\n"; 
	
	
	$headers .= "X-Sender: $email_origen \r\n"; 
	
	$headers .= "X-Priority: 3 \r\n"; 
	$headers .= "MIME-Version: 1.0 \r\n"; 
	$headers .= "Content-Transfer-Encoding: 7bit \r\n";
	if($formato == "html") 
 	{
		$headers .= "Content-Type: text/html; charset=iso-8859-1 \r\n";
	} 
   	else 
    {
		$headers .= "Content-Type: text/plain; charset=iso-8859-1 \r\n";
	} 

	@mail($email_destino, $asunto, $mensaje, $headers);*/
?>