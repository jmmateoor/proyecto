<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	$iddietista=$_POST["iddietista"];
	
	$fechahoy = date('Y-m-j');
	
	
	
	$nuevafecha=sumaDias($fechahoy);
	$dia=date('l',strtotime($nuevafecha));
	
	
	
	$lista="[";
	for($i=0;$i<=7;$i++)
	{
		$dia=date('l',strtotime($nuevafecha));
		if($dia!="Sunday" && $dia!="Saturday")
		{
			$lista.=escribeCitas($nuevafecha,$iddietista);
		}
		else
		{
			$nuevafecha=sumaDias($nuevafecha);
			$dia=date('l',strtotime($nuevafecha));
			if($dia!="Sunday" && $dia!="Saturday")
			{
				$lista.=escribeCitas($nuevafecha,$iddietista);
			}
			else
			{
				$nuevafecha=sumaDias($nuevafecha);
				$dia=date('l',strtotime($nuevafecha));
				
				
				$lista.=escribeCitas($nuevafecha,$iddietista);
			}
		}
		$nuevafecha=sumaDias($nuevafecha);
	}
	$lista=substr($lista,0,-1);
	$lista.="]";
	$lista = preg_replace('/\x{feff}$/u', '', $lista);
	echo $lista;
?>