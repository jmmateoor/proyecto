<?php
	session_start();
	if($_SESSION["logeado"]!=true)
	{
		header("location: clientelogin.php");
	}
	include("../servidor/funciones.inc.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Plantilla</title>
<link rel="shortcut icon" href="images/fav.png">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="estilos.css">

<script src="funciones.js"></script>
<script>
window.onload=function(){
	var si=true;
	$("#flip2").click(function(){
	$("#panel2").slideToggle(function(){
				//$("#iconoflip2").toggleClass("glyphicon-menu-down");
				if(si)
				{
					$("#iconoflip2").removeClass("glyphicon-menu-up");
					$("#iconoflip2").addClass("glyphicon-menu-down");
					si=false;
				}
				else
				{
					$("#iconoflip2").removeClass("glyphicon-menu-down");
					$("#iconoflip2").addClass("glyphicon-menu-up");
					si=true;
				}
			}
		);
	});
	$("#flip1").click(function(){
	$("#panel1").slideToggle(function(){
				$("#iconoflip1").toggleClass("glyphicon-menu-up");
			}
		);
	});
	
	$("#panel1").hide();
	graficaPeso(<?php echo $_SESSION["id"] ?>);
	cargarIntercambios(<?php echo $_SESSION["id"] ?>);
	datosEmpresa();
	ocultaLoading();
}
</script>
</head>

<body>
<div id="loading"></div>
        <div id="imgLoading">
            <img src="images/loading.gif" alt="loading" title="loading" />
        </div>
	<script>muestraLoading();</script>
    <div class="container-fluid">
    	<div class="row barrasuperior">
            	<div class="col-md-6">
                	
                </div>
                <div class="col-md-4">
                	<span class="glyphicon glyphicon-user"></span> <span id="email"><?php echo $_SESSION['email'] ?></span>
                </div>
                <div class="col-md-2">
                	<a class="cerrarsesion" href="cerrar_sesion_cliente.php"><span class="glyphicon glyphicon-off"></span> Cerrar sesión</a>
                </div>
            </div>
        <div class="row cabecera">
            <div class="col-md-1">
                <p align="center"><img src="images/cab.png" class="img-responsive" width="100px" /></p>
            </div>
            <div class="col-md-11">
                <h1>Zona Cliente</h1>
            </div>
        </div>
        <div class="row cabecera">
            <div class="col-md-12">
                <div class="row inicio">
                    <ul id="menu">
                    	<li>
                            <a href="#" class="menu">
                                <div class="col-md-2 colmenu">
                                    <h2><span class="glyphicon glyphicon-home"></span> Inicio</h2>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu">
                                <div class="col-md-2 colmenu">
                                    <h2><span class="glyphicon glyphicon-calendar"></span> Citas</h2>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu">
                                <div class="col-md-2 colmenu seleccionado">
                                    <h2><span class="glyphicon glyphicon-book"></span> Diario dietético</h2>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu">
                                <div class="col-md-2 colmenu">
                                    <h2><span class="glyphicon glyphicon-heart"></span> Dieta</h2>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu">
                                <div class="col-md-4 colmenu">
                                    <h2><span class="glyphicon glyphicon-list"></span> Alimentos por intercambio</h2>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row cuerpo">
        	<div class="col-md-7">
            	<h3 class="datospers">Contenidos</h3><!-- CONTENIDO DE LA WEB -->
                <p id="contenidos"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></p>
            </div>
            
            <div class="col-md-5">
            	<div class="row">
                	<div class="col-md-12">
                        <h3 class="datospers">Tus intercambios</h3>
                        <p id="intercambios"></p>
                    </div>
                </div>
                
                <div class="row">
                	<div class="col-md-12">
                        <h3 class="datospers"><span id="flip1" style="cursor: pointer;"><span id="iconoflip1" class="glyphicon glyphicon-menu-down"></span> Datos Personales </span><a href="#" class="enlacenormal">[Actualizar]</a></h3>
                        <div id="panel1">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p><b>Nombre completo</b></p>
                                    <p id="nombre"><?php echo $_SESSION["nombre"]." ".$_SESSION["apellidos"] ?></p>
                                </div>
                                <div class="col-sm-3">
                                    <p><b>Sexo</b></p>
                                    <p id="sexo"><?php if($_SESSION["sexo"]=="h"){echo "Hombre";} else {echo "Mujer";} ?></p>
                                </div>
                                <div class="col-sm-3">
                                    <p><b>Tu edad</b></p>
                                    <p id="edad"><?php echo edad($_SESSION["fechanac"]) ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p><b>Altura</b></p>
                                    <p><span id="altura"><?php echo $_SESSION["altura"] ?></span> cm.</p>
                                </div>
                                <div class="col-sm-3">
                                    <p><b>Tu peso deseable</b></p>
                                    <p><span id="pesodeseable"><?php echo $_SESSION["pesodeseable"] ?></span> Kg.</p>
                                </div>
                                <div class="col-sm-3">
                                    <p><b>Tu peso actual</b></p>
                                    <p><span id="peso"><?php echo $_SESSION["peso"] ?></span> Kg.</p>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-sm-9">
                                	<p><b>Tu gasto energético total</b></p>
                                    <p><span id="geet"><?php echo $_SESSION["geet"] ?></span> Kcal/día</p>
                                </div>
                            </div>
                        </div>
                	</div>
                </div>
                <div class="row">
                	<div class="col-md-12">
                        <h3 class="datospers"><span id="flip2" style="cursor: pointer;"> <span id="iconoflip2" class="glyphicon glyphicon-menu-up"></span> Tu historial de peso</span></h3>
                        <div id="panel2">
                        	<div id="caja">
                            	<div id="grafica"></div>
                            </div>
                        </div>
                    </div>
                </div>
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
