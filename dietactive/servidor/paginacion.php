<?php
include("config.inc.php");
include("funciones.inc.php");

//

$paginaActual=$_POST['partida'];

$connex = new MySQLi($servidor,$usuario,$password,$bbdd);
$connex->set_charset("utf8");

$consulta="SELECT * FROM entrada";

$result=mysqli_query($connex,$consulta);

$nroProductos = mysqli_num_rows($result);
$nroPaginas=ceil($nroProductos/$paginacion);
$lista = '';
$tabla = '';

if($paginaActual > 1)
{
	$lista=$lista."<li><a href='javascript:pagination(".($paginaActual-1).");' >Anterior</a></li>";
}
for($i=1; $i<=$nroPaginas;$i++)
{
	if($i==$paginaActual)
	{
		$lista=$lista."<li class='active'><a href='javascript:pagination(".$i.");'>".$i."</a></li>";
	}
	else
	{
		$lista=$lista."<li><a href='javascript:pagination(".$i.");'>".$i."</a></li>";
	}
}

if($paginaActual < $nroPaginas)
{
        $lista = $lista."<li><a href='javascript:pagination(".($paginaActual+1).");' >Siguiente</a></li>";
}

if($paginaActual <= 1)
{
  	$limit = 0;
		
}
else
{
	$limit = $paginacion*($paginaActual-1);
}

$salida="";


$registro = mysqli_query($connex,"select entrada.fecha, entrada.titulo, entrada.texto, entrada.imagen, entrada.video, categoria.nombre, dietista.nombre, dietista.apellidos from entrada join categoria on entrada.idcategoria = categoria.id join dietista on entrada.iddietista = dietista.id order by 2 desc LIMIT $limit, $paginacion");

while($registro2 = mysqli_fetch_array($registro,MYSQLI_NUM))
{
	$salida.="<div class='articulo'><div class='row'><div class='col-lg-12'><h3>".$registro2[1]."</h3></div></div>";
	$salida.="<hr />";
	$salida.="<div class='row'><div class='col-md-12'><b>Autor:</b> ".$registro2[6]." ".$registro2[7]."</div></div>";
	$salida.="<div class='row'><div class='col-md-6'><b>Categoría: </b>".$registro2[5]."</div><div class='col-md-6'><b>Fecha publicación: </b>".$registro2[0]."</div></div><br/>";
	$salida.="<hr />";
	$salida.="<div class='row'><div class='col-md-6'><img src='cliente/images/".$registro2[3]."' class='img-responsive imagenentrada' /></div><div class='col-md-6'>".$registro2[2]."</div></div>";
	if($registro2[4]!="")
	{
		$salida.="<hr />";
		$salida.="<div class='row'><div class='col-md-12'><iframe id='videoyoutube' width='100%' height='315' class='embed-responsive-16by9' src='https://www.youtube.com/embed/".$registro2[4]."?rel=0&wmode=transparent&showinfo=0' scrolling='no'  allowtransparency='true' allowfullscreen='true' frameborder='0' ></iframe></div></div>";
	}
	$salida.="</div>";
}



$datos="[{\"salida\":\"".$salida."\"},{\"lista\":\"".$lista."\"}]";

echo $datos;
//$array = array(0 => $salida, 1 => $lista);

//echo json_encode($array);

?>