<?php
	session_start();
	include("config.inc.php");
	include("funciones.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	
	$fechahoy = date('Y-m-j');
	
	
	
	$nuevafecha=sumaDias($fechahoy);
	$dia=date('l',strtotime($nuevafecha));
	
	$lista="[";
	for($i=0;$i<=1;$i++)
	{
		if($dia!="Sunday")
		{
			$lista.=escribeCitas($nuevafecha);
		}
		else
		{
			$nuevafecha=sumaDias($nuevafecha);
			$lista.=escribeCitas($nuevafecha);
		}
		$nuevafecha=sumaDias($nuevafecha);
	}
	$lista=substr($lista,0,-1);
	$lista.="]";
	echo $lista;
?>