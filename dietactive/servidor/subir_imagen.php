<?php
if (isset($_FILES["file"]))
{
    $file = $_FILES["file"];
    $nombre = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
    $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $carpeta = "imagenes/";
    if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif')
    {
      $error= "Error, el archivo no es una imagen";
	  $salida="[";
		$ok=0;
		$salida.="{";
		$salida.="\"ok\": \"".$ok."\",";
		$salida.="\"error\": \"".$error."\"";
		$salida.="},";
		$salida=substr($salida,0,-1);
		$salida.="]";
		
		echo $salida;
    }
    else if ($size > 1024*1024*5)
    {
      $error= "Error, el tamaño máximo permitido son 5MB";
	  $salida="[";
		$ok=0;
		$salida.="{";
		$salida.="\"ok\": \"".$ok."\",";
		$salida.="\"error\": \"".$error."\"";
		$salida.="},";
		$salida=substr($salida,0,-1);
		$salida.="]";
		
		echo $salida;
    }
    else if ($width > 4000 || $height > 4000)
    {
        $error= "Error la anchura y la altura maxima permitida es 500px";
		$salida="[";
		$ok=0;
		$salida.="{";
		$salida.="\"ok\": \"".$ok."\",";
		$salida.="\"error\": \"".$error."\"";
		$salida.="},";
		$salida=substr($salida,0,-1);
		$salida.="]";
		
		echo $salida;
    }
    else if($width < 60 || $height < 60)
    {
        $error= "Error la anchura y la altura mínima permitida es 60px";
		$salida="[";
		$ok=0;
		$salida.="{";
		$salida.="\"ok\": \"".$ok."\",";
		$salida.="\"error\": \"".$error."\"";
		$salida.="},";
		$salida=substr($salida,0,-1);
		$salida.="]";
		
		echo $salida;
    }
    else
    {
		$date = date("d-m-Y-H:i:s");
        $nombreruta=rand(0,99999999).$nombre;
        $src = $carpeta.$nombreruta;
        move_uploaded_file($ruta_provisional, $src);
		
		$salida="[";
		$ok=1;
		$salida.="{";
		$salida.="\"ok\": \"".$ok."\",";
		$salida.="\"nombre\": \"".$nombre."\",";
		$salida.="\"ruta\": \"".$nombreruta."\"";
		$salida.="},";
		$salida=substr($salida,0,-1);
		$salida.="]";
		
		echo $salida;
		
    }
}
?>