<?php
//Funciones

function escribeCitas($fecha,$id)
{
	include("config.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$cadena="";
	
	
	$horario = $c->prepare("select inicio1, fin1 from datosempresa");
	$horario->execute();
	$horario->bind_result($horainicio,$horafin);
	$horario->fetch();
	
	$horainicio=explode(":",$horainicio);
	$inicio=$horainicio[0];
	
	$horafin=explode(":",$horafin);
	$fin=$horafin[0];
	//$sql="SELECT * FROM citas WHERE CITA='$fechahora'";
	
	$fechaactual=date("Y-m-d");
	
	$c->close();
	
	$con = new MySQLi($servidor,$usuario,$password,$bbdd);
	$con->set_charset("utf8");
	
	$fechahora=date("Y-m-d");
	
	$citas = $con->prepare("select cita, iddietista from cita where cita = ? and cita >= ? and iddietista = ?");
	$citas->bind_param("ssi",$fechahora, $fechaactual,$id);
	
	for($i=$inicio;$i<$fin;$i++)
	{
		$fechahora="";
		$fechahora=$fecha." ".$i.":00";
		
		//$sql="SELECT * FROM cita WHERE CITA='$fechahora' AND CITA>=$fechaactual";
		
		$citas->execute();
		
		$citas->store_result();
		
		if ($citas->num_rows == 0) {
			$cadena.="{";
			$cadena.="\"id\": \"".$id."\",";
			$cadena.="\"fechahora\": \"".$fechahora."\"";
			$cadena.="},";
		}
		
	}
	$con->close();
	return $cadena;
}

function sumaDias($fecha)
{
	$nuevafecha = strtotime ( '+1 day' , strtotime($fecha));
	$nuevafecha = date ( 'Y-m-j' , $nuevafecha);
	return $nuevafecha;
}



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

function borrarIntercambios($idcliente)
{
	include("config.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	$insertar = $c->prepare("delete from tablaintercambio where idcliente = ?");
	$insertar->bind_param("i",$idcliente);
	$insertar->execute();
	$c->close();
}

function crearIntercambios($idcliente)
{
	include("config.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	$consulta = $c->prepare("select sexo, peso, altura, fechanac, idactividad, pesodeseable from cliente where id = ?");
	$consulta->bind_param("i",$idcliente);
	$consulta->execute();
	$consulta->bind_result($sexoq, $pesoq, $alturaq, $fechanacq, $actividadfq, $pesodeseableq);
	while($consulta->fetch())
	{
		$sexo=$sexoq;
		$peso=$pesoq;
		$altura=$alturaq;
		$fechanac=$fechanacq;
		$actividadf=$actividadfq;
		$pesodeseable=$pesodeseableq;
	}
	
	$edad=edad($fechanac);
	
	$consultaembarazo = $c->prepare("select idpatologia from patologiacliente where idcliente = ? and idpatologia = 1");
	$consultaembarazo->bind_param("i",$idcliente);
	$consultaembarazo->execute();
	$consultaembarazo->store_result();
	if($consultaembarazo->num_rows>0)
	{
		$embarazo=true;
	}
	else
	{
		$embarazo=false;
	}
	
	
	//Cálculo de la Tasa Metabólica Basal, tmb
	if($sexo=="h")
	{
		$tmb=66.47+(13.75*$peso)+(5*$altura)-(6.75*$edad);
	}
	else
	{
		$tmb=655+(9.56*$peso)+(1.85*$altura)-(4.7*$edad);
	}
	
	//Cálculo de la Tasa Metabólica Basal Real, tmbr
	if($edad<40)
	{
		$tmbr=$tmb;
		if($sexo=="m" && $embarazo)
		{
			$tmbr=$tmbr+200;
		}
		
	}
	else if($edad>=40 && $edad<50)
	{
		$tmbr=$tmb*0.95;
		if($sexo=="m" && $embarazo)
		{
			$tmbr=$tmbr+200;
		}
	}
	else if($edad>=50 && $edad<60)
	{
		$tmbr=$tmb*0.90;
		if($sexo=="m" && $embarazo)
		{
			$tmbr=$tmbr+200;
		}
	}
	else if($edad>=60 && $edad<70)
	{
		$tmbr=$tmb*0.80;
		if($sexo=="m" && $embarazo)
		{
			$tmbr=$tmbr+200;
		}
	}
	else if($edad>=70)
	{
		$tmbr=$tmb*0.70;
		if($sexo=="m" && $embarazo)
		{
			$tmbr=$tmbr+200;
		}
	}
	
	//Cálculo del Gasto de Actividad, ga
	include("coefactividad.inc.php");
	switch ($actividadf)
	{
		//TERMINAR
		case 1: $ga=$tmbr*$tipo1; break;
		case 2: $ga=$tmbr*$tipo2; break;
		case 3: $ga=$tmbr*$tipo3; break;
		case 4: $ga=$tmbr*$tipo4; break;
	}
	
	//Cálculo de la Energía Térmica de los Alimentos, eta
	$eta=($tmbr+$ga)*0.1;
	
	//Cálculo del Gasto Energético Total, geet
	
	$geet=($tmbr+$ga+$eta);
	
	if($peso>$pesodeseable)
	{
		//Se le resta 640 para que se pueda adelgazar
		$geet=$geet-640; //Kcal/dia
	}
	else
	{
		//Se le suma 640 para que se pueda conseguir peso
		$geet=$geet+640; //Kcal/dia
	}
	
	$insertar = $c->prepare("update cliente set geet = ? where id = ?");
	$insertar->bind_param("di",$geet,$idcliente);
	$insertar->execute();
	
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
	$hidratos=($hdcg/10)*0.61;
	$grasas=($lig/10)*0.66;
	$proteinas=($prg/10)*0.75;
	
	$fruta=redondeo($fruta);
	$verdura=redondeo($verdura);
	$lacteos=redondeo($lacteos);
	$hidratos=redondeo($hidratos);
	$grasas=redondeo($grasas);
	$proteinas=redondeo($proteinas);
	
	
	$preparada = $c->prepare("insert into tablaintercambio(idcliente, idgrupo, valor) values (?, ?, ?)");
	$preparada->bind_param("iid",$idcliente,$idgrupo,$valor);
	
	$idgrupo=1;
	$valor=$lacteos;
	$preparada->execute();
	
	$idgrupo=2;
	$valor=$proteinas;
	$preparada->execute();
	
	$idgrupo=3;
	$valor=$verdura;
	$preparada->execute();
	
	$idgrupo=4;
	$valor=$hidratos;
	$preparada->execute();
	
	$idgrupo=5;
	$valor=$fruta;
	$preparada->execute();
	
	$idgrupo=6;
	$valor=$grasas;
	$preparada->execute();
	
	$c->close();
}

function pesoHistorico($idcliente)
{
	include("config.inc.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	$consulta = $c->prepare("select peso from cliente where id = ?");
	$consulta->bind_param("i",$idcliente);
	$consulta->execute();
	$consulta->bind_result($pesoq);
	while($consulta->fetch())
	{
		$peso=$pesoq;
	}
	
	$fecha=date("Y-m-d H:i:s");
	
	$preparada = $c->prepare("insert into historicopeso(fecha, idcliente, peso) values (?, ?, ?)");
	$preparada->bind_param("sid",$fecha,$idcliente,$peso);
	$preparada->execute();
	
	$c->close();
}

function reparteIntercambios($id)
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

function redondeo($alimento)
{
	if($alimento-(floor($alimento))<0.25)
	{
		$alimento=floor($alimento);
	}
	else
	{
		if($alimento-(floor($alimento))>=0.25 && $alimento-(floor($alimento))<0.75)
		{
			$alimento=floor($alimento)+0.5;
		}
		else
		{
			if($alimento-(floor($alimento))>=0.75)
			{
				$alimento=floor($alimento)+1;
			}
		}
	}
	return $alimento;
}
//Fin Funciones
?>