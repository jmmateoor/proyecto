<?php
//Base de Datos
$servidor="localhost";
$usuario="root";
$password="1234";
$bbdd="dietactive";
//$c = new MySQLi($servidor,$usuario,$password,$bbdd);
//$c->set_charset("utf8");
//Fin Base de Datos

//Funciones
function genera_random($longitud)
{  
    $exp_reg="[^A-Z0-9]";  
    return substr(preg_replace($exp_reg, "", md5(rand())) .  
       preg_replace($exp_reg, "", md5(rand())) .  
       preg_replace($exp_reg, "", md5(rand())),  
       0, $longitud);  
}

function edad($fecha_de_nacimiento)
{
	if (is_string($fecha_de_nacimiento)) {
		$fecha_de_nacimiento = strtotime($fecha_de_nacimiento);
	}
	$diferencia_de_fechas = time() - $fecha_de_nacimiento;
	return floor(($diferencia_de_fechas / (60 * 60 * 24 * 365)));
}

function pesoDeseable($altura,$sexo)
{
	if($sexo=="h")
	{
		$pesodeseable=($altura-100)-(($altura-150)/4);
	}
	else
	{
		$pesodeseable=($altura-100)-(($altura-150)/2);
	}
	return $pesodeseable;
}

function crearIntercambios($sexo,$fechanac,$altura,$peso,$actividadf)
{
	$edad=edad($fechanac);
	$pesodeseable=pesoDeseable($altura,$sexo);
	
	//Cálculo de la Tasa Metabólica Basal, tmb
	if($sexo=="h")
	{
		$tmb=66.47+(13.65*$pesodeseable)+(5*$altura)-(6.75*$edad);
	}
	else
	{
		$tmb=665+(9.56*$pesodeseable)+(1.85*$altura)-(4.7*$edad);
	}
	
	//Cálculo de la Tasa Metabólica Basal Real, tmbr
	if($edad<40)
	{
		$tmbr=$tmb;
	}
	else if($edad>=40 && $edad<50)
	{
		$tmbr=$tmb*0.95;
	}
	else if($edad>=50 && $edad<60)
	{
		$tmbr=$tmb*0.90;
	}
	else if($edad>=60 && $edad<70)
	{
		$tmbr=$tmb*0.80;
	}
	else if($edad>=70)
	{
		$tmbr=$tmb*0.70;
	}
	
	//Cálculo del Gasto de Actividad, ga
	
	switch ($actividadf)
	{
		//TERMINAR
		case 1: $ga=$tmbr*1; break;
		case 2: $ga=$tmbr*1; break;
		case 3: $ga=$tmbr*1; break;
		case 4: $ga=$tmbr*1; break;
	}
	
	//Cálculo de la Energía Términa de los Alimentos, eta
	$eta=($tmbr+$ga)+0.1;
	
	//Cálculo del Gasto Energético Total, geet
	$geet=$tmbr+$ga+$eta; //Kcal/dia
	
	//Reparto de principios inmediatos
	
	//Hidratos de Carbono, hdc
	$hdc=$geet*0.55;
	//Lípidos, li
	$li=$geet*0.3;
	//Proteinas, pr
	$pr=$geet*0.15;
	
	//Cambio a gramos, hdc -> hdcg, li -> lig, pr -> prg
	$hdcg=$hdc/4;
	$lig=$li/9;
	$prg=$pr/4;
	
	//Intercambios
	$fruta=($hdcg/10)*0.22;
	$verdura=($hdcg/10)*0.07;
	$lacteos=($hdcg/10)*0.1;
	$farinaceos=($hdcg/10)*0.61;
	$grasas=($lig/10)*0.66;
	$proteinas=($prg/10)*0.75;
	
}

function reparteIntercambios()
{
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$consulta = $c->prepare("select id from cliente where email = ?");
	$consulta->bind_param("s",$email);
	$consulta->execute();
	$consulta->bind_result($idcliente);
	while($consulta->fetch())
	{
		$id=$idcliente;
	}
}
//Fin Funciones
?>