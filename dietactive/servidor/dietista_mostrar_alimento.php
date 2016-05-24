<?php
	session_start();
	include("config.inc.php");
	$conn = new MySQLi($servidor,$usuario,$password,$bbdd);
	$conn->set_charset("utf8");
	$idalimento=$_POST['idalimento'];
	$preparada = $conn->prepare("select id, alimento, idtipoalimento, comestible, energia, proteinas, lipidos, ags, agm, agp, colesterol, glucidos, fibra, sodio, potasio, calcio, magnesio, fosforo, hierro, zinc, yodo, b1, b2, b6, b12, b9, b3, c, a, d, e from alimento where id = ?");
	$preparada->bind_param("i",$idalimento);
	$preparada->execute();
	$preparada->bind_result($id,$alimento,$idtipoalimento, $comestible, $energia, $proteinas, $lipidos, $ags, $agm, $agp, $colesterol, $glucidos, $fibra, $sodio, $potasio, $calcio, $magnesio, $fosforo, $hierro, $zinc, $yodo, $b1, $b2, $b6, $b12, $b9, $b3, $c, $a, $d, $e);
	$salida="[";
	while($preparada->fetch())
	{
		$salida.="{";
		$salida.="\"id\": \"".$id."\",";
		$salida.="\"alimento\": \"".$alimento."\",";
		$salida.="\"idtipoalimento\": \"".$idtipoalimento."\",";
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