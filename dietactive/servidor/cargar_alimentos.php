<?php
	include("config.inc.php");
	include("funciones.inc.php");
	$conn = new MySQLi($servidor,$usuario,$password,$bbdd);
	$conn->set_charset("utf8");
	$idcliente=$_POST["idcliente"];
	$preparada = $conn->prepare("select testdias.idalimento, alimento.alimento, testdias.cantidad, testdias.momento, alimento.comestible, alimento.energia, alimento.proteinas, alimento.lipidos, alimento.ags, alimento.agm, alimento.agp, alimento.colesterol, alimento.glucidos, alimento.fibra, alimento.sodio, alimento.potasio, alimento.calcio, alimento.magnesio, alimento.fosforo, alimento.hierro, alimento.zinc, alimento.yodo, alimento.b1, alimento.b2, alimento.b6, alimento.b12, alimento.b9, alimento.b3, alimento.c, alimento.a, alimento.d, alimento.e from testdias join alimento on testdias.idalimento = alimento.id where testdias.idcliente=?");
	$preparada->bind_param("i",$idcliente);
	$preparada->execute();
	$preparada->bind_result($idalimento,$alimento,$cantidad,$momento,$comestible,$energia,$proteinas,$lipidos,$ags,$agm,$agp,$colesterol,$glucidos,$fibra,$sodio,$potasio,$calcio,$magnesio,$fosforo,$hierro,$zinc,$yodo,$b1,$b2,$b6,$b12,$b9,$b3,$c,$a,$d,$e);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"idalimento\": \"".$idalimento."\",";
		$salida.="\"alimento\": \"".$alimento."\",";
		$salida.="\"cantidad\": \"".$cantidad."\",";
		$salida.="\"momento\": \"".$momento."\",";
		$salida.="\"comestible\": \"".$comestible."\",";
		$salida.="\"energia\": \"".$energia."\",";
		$salida.="\"proteinas\": \"".$proteinas."\",";
		$salida.="\"lipidos\": \"".$lipidos."\",";
		$salida.="\"ags\": \"".$ags."\",";
		$salida.="\"agm\": \"".$agm."\",";
		$salida.="\"agp\": \"".$agp."\",";
		$salida.="\"colesterol\": \"".$colesterol."\",";
		$salida.="\"glucidos\": \"".$glucidos."\",";
		$salida.="\"fibra\": \"".$fibra."\",";
		$salida.="\"sodio\": \"".$sodio."\",";
		$salida.="\"potasio\": \"".$potasio."\",";
		$salida.="\"calcio\": \"".$calcio."\",";
		$salida.="\"magnesio\": \"".$magnesio."\",";
		$salida.="\"fosforo\": \"".$fosforo."\",";
		$salida.="\"hierro\": \"".$hierro."\",";
		$salida.="\"zinc\": \"".$zinc."\",";
		$salida.="\"yodo\": \"".$yodo."\",";
		$salida.="\"b1\": \"".$b1."\",";
		$salida.="\"b2\": \"".$b2."\",";
		$salida.="\"b6\": \"".$b6."\",";
		$salida.="\"b12\": \"".$b12."\",";
		$salida.="\"b9\": \"".$b9."\",";
		$salida.="\"b3\": \"".$b3."\",";
		$salida.="\"c\": \"".$c."\",";
		$salida.="\"a\": \"".$a."\",";
		$salida.="\"d\": \"".$d."\",";
		$salida.="\"e\": \"".$e."\"";
		$salida.="},";
	}
	$salida=substr($salida,0,-1);
	$salida.="]";
	echo $salida;
	$conn->close();
?>