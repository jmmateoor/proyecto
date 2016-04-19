<?php
	session_start();

	$_SESSION["email"]=$_POST['email'];
	include("../servidor/config.inc.php");
	include("../servidor/funciones.php");
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	
	$password=md5($_POST['password']);
	$email=$_POST['email'];
		
	$consulta = $c->prepare("select id, nombre, apellidos, telefono, email, peso, pesodeseable, dieta from cliente where email = ?");
	$consulta->bind_param("s",$email);
	$consulta->execute();
	$consulta->bind_result($id, $nombre, $apellidos, $telefono, $email, $peso, $pesodeseable, $dieta);
	while($consulta->fetch())
	{
		$_SESSION["id"]=$id;
		$_SESSION["nombre"]=$nombre;
		$_SESSION["apellidos"]=$apellidos;
		$_SESSION["telefono"]=$telefono;
		$_SESSION["email"]=$email;
		$_SESSION["peso"]=$peso;
		$_SESSION["pesodeseable"]=$pesodeseable;
		$_SESSION["dieta"]=$dieta;
	}
	$c->close();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Plantilla</title>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="estilos.css">

<script src="funciones.js"></script>
<script>
window.onload=function(){
	$("#panel1").hide();
	$("#panel2").hide();
	var oculto1=true;
	datosEmpresa();
	$("#flip1").click(function(){
        $("#panel1").slideToggle(function(){
				$("#iconoflip1").toggleClass("glyphicon-menu-up","glyphicon-menu-down");
			}
		);
    });
	$("#flip2").click(function(){
        $("#panel2").slideToggle(function(){
				$("#iconoflip2").toggleClass("glyphicon-menu-up","glyphicon-menu-down");
			}
		);
    });
}
</script>
</head>

<body>
    <div class="container-fluid">
    	<div class="row barrasuperior">
            	<div class="col-md-6">
                	
                </div>
                <div class="col-md-4">
                	<span class="glyphicon glyphicon-user"></span> <span id="email"><?php echo $_SESSION["email"] ?></span>
                </div>
                <div class="col-md-2">
                	<a class="cerrarsesion" href="#"><span class="glyphicon glyphicon-off"></span> Cerrar sesión</a>
                </div>
            </div>
        <div class="row cabecera">
            <div class="col-md-12">
                <h1>Zona Cliente</h1>
            </div>
        </div>
        <div class="row cabecera">
            <div class="col-md-12">
                <div class="row inicio">
                    <div class="col-md-1">
                        <h2><a href="#" class="enlaceinicio">Inicio</a></h2>
                    </div>
                    <div class="col-md-1">
                        <h2><a href="#" class="menu"><span class="glyphicon glyphicon-calendar"></span> Citas</h2></h2>
                    </div>
                    <div class="col-md-2">
                        <h2><a href="#" class="menu seleccionado"><span class="glyphicon glyphicon-book"></span> Diario dietético</a></h2>
                    </div>
                    <div class="col-md-1">
                        <h2><a href="#" class="menu"><span class="glyphicon glyphicon-heart"></span> Dieta</a></h2>
                    </div>
                    <div class="col-md-5">
                        <h2><a href="#" class="menu"><span class="glyphicon glyphicon-list"></span> Grupos de alimentos por intercambio</a></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row cuerpo">
        	<div class="col-md-3">
            	<div class="row">
                	<h3 class="datospers">Tus intercambios</h3>
                    <p id="intercambios"><br/><br/><br/><br/></p>
                </div>
                <div class="row">
            		<h3 id="flip1" class="datospers"><span id="iconoflip1" class="glyphicon glyphicon-menu-down"></span> Datos Personales <a href="#" class="enlacenormal">[Actualizar]</a></h3>
                    <div id="panel1">
                        <p><b>Nombre</b></p>
                        <p id="nombre"><?php echo $_SESSION["nombre"] ?></p>
                        <p><b>Apellidos</b></p>
                        <p id="apellidos"><?php echo $_SESSION["apellidos"] ?></p>
                        <p><b>Tu peso</b></p>
                        <p id="peso"><?php echo $_SESSION["peso"] ?></p>
                        <p><b>Tu peso deseable</b></p>
                        <p id="pesodeseable"><?php echo $_SESSION["pesodeseable"] ?></p>
                    </div>
                </div>
                <div class="row">
                	<h3 id="flip2" class="datospers"><span id="iconoflip2" class="glyphicon glyphicon-menu-down"></span> Tu historial de peso</h3>
                    <div id="panel2">
                    	<p>91</p>
                        <p>89</p>
                        <p>84</p>
                        <p>81</p>
                        <p>78</p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
            	<h3 class="datospers">Contenidos</h3><!-- CONTENIDO DE LA WEB -->
                <p id="contenidos"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></p>
            </div>
        </div>
        <footer>
            <div class="row pie">
                <div class="col-md-3">
                    <h4>Teléfonos</h4>
                    <p class="pietexto"><a id="dietfijo1" class="pieenlace" href=""><span id="dietfijo2"></span></a></p>
                    <p class="pietexto"><a id="dietmovil1" class="pieenlace" href=""><span id="dietmovil2"></span></a></p>
                </div>
                <div class="col-md-3">
                    <h4>Dirección</h4>
                    <p id="dietdireccion" class="pietexto"></p>
                    <p id="dietdirecciondatos" class="pietexto"></p>
                </div>
                <div class="col-md-3">
                    <h4>Correo electrónico</h4>
                    <p id="dietemail" class="pietexto"></p>
                </div>
                <div class="col-md-3">
                    <h4>Aviso Legal</h4>
                </div>
            </div>
        </footer>
        <div class="row">
        	<h5 id="dietnombre" class="desarrollo"></h5>
            <h5 class="desarrollo">Desarrollado por <span id="dietdesarrollado"></span></h5>
        </div>
    </div>
</body>
</html>