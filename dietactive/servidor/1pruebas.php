<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<?php
	include("funciones.php");
	
	if(md5("1234")=="81dc9bdb52d04dc20036dbd8313ed055")
	{
		echo "Si";
	}
	else
	{
		echo "No";
	}

?>

</body>
</html>