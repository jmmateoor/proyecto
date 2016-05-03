<?php
include("config.inc.php");
$nombre=$_POST['nombre'];
$apellidos=$_POST['apellidos'];
$email=$_POST['email'];
$mensaje=$_POST['mensaje'];

$mensajecompleto='Cliente: '.$nombre.' '.$apellidos.' <'.$email.'>
Consulta: 

'.$mensaje;

$asunto="Consulta de ".$nombre." ".$apellidos;

if(mail($emailempresa,$asunto,$mensajecompleto))
{
	echo "s";
}
?>