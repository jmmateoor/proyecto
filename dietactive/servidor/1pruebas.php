<?php
session_start();

$_SESSION["nombre"]="Jose";
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>


<?php
	
$_SESSION["nombre"]="<script>document.write('Laura');</script>";
?>

<a href="2pruebas.php">Ir a</a>

</body>
</html>