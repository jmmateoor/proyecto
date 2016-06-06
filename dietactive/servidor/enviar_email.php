<?php
include("config.inc.php");
$nombre=$_POST['nombre'];
$apellidos=$_POST['apellidos'];
$email=$_POST['email'];
$mensaje=$_POST['mensaje'];

//cabecera
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=utf-8\r\n"; 
		//dirección del remitente 
		$headers .= "From: DietActive < consulta >\r\n";


$mensajecompleto='Cliente: '.$nombre.' '.$apellidos.' <'.$email.'>
Consulta: 

'.$mensaje;

$asunto="Consulta de ".$nombre." ".$apellidos;

if(mail($emailempresa,$asunto,$mensajecompleto,$headers))
{
	echo "s";
}
?>