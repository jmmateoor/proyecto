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
<title>Alimentos por intercambio - DietActive</title>
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
				$("#iconoflip2").toggleClass("glyphicon-menu-up");
				/*if(si)
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
				}*/
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
	$("#panel2").hide();
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
            <div class="dropdown">
                <button class="botondesplegable cerrarsesion dropdown-toggle" style="cursor: pointer;" id="menucuenta" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <span id="email"><?php echo $_SESSION['email'] ?></span>
                <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="menucuenta">
                  <li role="presentation"><button class="botondesplegablesub botondesplegable" role="menuitem" data-toggle="modal" data-target="#modalPass" style="cursor: pointer;"><span class="glyphicon glyphicon-refresh"></span> Cambiar contraseña</button></li>
                  <li role="presentation"><button class="botondesplegablesub botondesplegable" role="menuitem" data-toggle="modal" data-target="#modalEmail" style="cursor: pointer;"><span class="glyphicon glyphicon-comment"></span> Enviar consulta</button></li>
                  <li role="presentation"></li>
                  <li class="divider"></li>
                  <li role="presentation"><a role="menuitem" href="cerrar_sesion_cliente.php" style="cursor: pointer;"><span class="glyphicon glyphicon-off"></span> Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
        <div class="row cabecera">
            <div class="col-md-10">
                <p align="center" style="margin-bottom:0px;"><img src="images/cab.png" class="img-responsive" width="510px" alt="DietActive" /></p>
                <p align="center" class="slogan">Tu Dieta Equilibrada Personalizada</p>
            </div>
        </div>
        <div class="row cabecera">
        	<div class="col-md-10 areacliente">
                <h1>Área Cliente</h1>
            </div>
        </div>
        <div class="row inicio">
            <div class="col-md-12">
            	
            
            <nav class="navbar navbar-inverse menuinicio" role="navigation">
                  <!-- El logotipo y el icono que despliega el menú se agrupan
                       para mostrarlos mejor en los dispositivos móviles -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-ex1-collapse">
                      <span class="sr-only">Desplegar navegación</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a href="cliente_inicio.php" class="navbar-brand" data-toggle="tooltip" data-placement="top" title="Ir a Inicio"><img src="images/logomenu.png" class="img-responsive" width="50px" alt="Ir a Inicio" /></a>
                  </div>
                 
                  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
                       otro elemento que se pueda ocultar al minimizar la barra -->
                  <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                      <li><a href="cliente_citas.php"><span class="glyphicon glyphicon-calendar"></span> Citas</a></li>
                      <li><a href="cliente_dieta.php"><span class="glyphicon glyphicon-heart"></span> Tu Dieta</a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <span class="glyphicon glyphicon-book"></span> Diario dietético <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="cliente_diario_dia_1.php">Día 1</a></li>
                          <li class="divider"></li>
                          <li><a href="cliente_diario_dia_2.php">Día 2</a></li>
                          <li class="divider"></li>
                          <li><a href="cliente_diario_dia_3.php">Día 3</a></li>
                        </ul>
                      </li>
                      <li  class="active"><a href="cliente_alimentos_intercambio.php"><span class="glyphicon glyphicon-list"></span> Alimentos por intercambio</a></li>
                    </ul>
                  </div>
                </nav>
                
            
                <!--<div class="row inicio">
                    <ul id="menu">
                    	<li>
                            <a href="#" class="menu">
                                <div class="col-sm-2 colmenu seleccionado">
                                    <h2><span class="glyphicon glyphicon-home"></span> Inicio</h2>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu">
                                <div class="col-sm-2 colmenu">
                                	
                                    	<h2><span class="glyphicon glyphicon-calendar"></span> Coger cita</h2>
                                    
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu">
                                <div class="col-sm-2 colmenu">
                                    <h2><span class="glyphicon glyphicon-book"></span> Diario dietético</h2>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu">
                                <div class="col-sm-2 colmenu">
                                    <h2><span class="glyphicon glyphicon-heart"></span> Tu Dieta</h2>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu">
                                <div class="col-sm-4 colmenu">
                                    <h2><span class="glyphicon glyphicon-list"></span> Alimentos por intercambio</h2>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>-->
                
                
                
                
                
            </div>
        </div>
        <div class="row cuerpo">
        
        
        
                
                
                
        	<div class="col-md-7">
            	<h2 class="datospers">Alimentos por Intercambio</h2><!-- CONTENIDO DE LA WEB -->
                <div id="contenidos">
                	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum pretium neque odio, non consequat libero eleifend in. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent purus justo, eleifend vel turpis vitae, viverra posuere nisi. Pellentesque vel magna posuere, faucibus ante in, pharetra enim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc vulputate augue eros. Sed feugiat maximus est, id blandit libero ultrices non. Nulla facilisi.</p>
                    <p>Vestibulum mollis velit non ipsum rhoncus porttitor. Praesent vel urna nec urna commodo mattis convallis ac metus. Etiam eget enim ut velit commodo gravida eget non neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed interdum, ex ac egestas elementum, lacus orci aliquam ante, quis porta nunc purus at lorem. Donec ullamcorper finibus suscipit. Aliquam et libero eros. Sed condimentum ligula eu nunc condimentum efficitur. Donec luctus, dolor vitae interdum cursus, tortor metus tincidunt diam, ac euismod eros nulla eu nibh.</p>
                	<a name="lacteos"></a><h3>Lácteos</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum pretium neque odio, non consequat libero eleifend in. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent purus justo, eleifend vel turpis vitae, viverra posuere nisi. Pellentesque vel magna posuere, faucibus ante in, pharetra enim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc vulputate augue eros. Sed feugiat maximus est, id blandit libero ultrices non. Nulla facilisi.</p>
                    <p>Vestibulum mollis velit non ipsum rhoncus porttitor. Praesent vel urna nec urna commodo mattis convallis ac metus. Etiam eget enim ut velit commodo gravida eget non neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed interdum, ex ac egestas elementum, lacus orci aliquam ante, quis porta nunc purus at lorem. Donec ullamcorper finibus suscipit. Aliquam et libero eros. Sed condimentum ligula eu nunc condimentum efficitur. Donec luctus, dolor vitae interdum cursus, tortor metus tincidunt diam, ac euismod eros nulla eu nibh.</p>
                    <p>Donec accumsan sem dapibus ligula sodales, non sagittis nulla rutrum. Vivamus quis porta odio. Fusce convallis libero leo. Vivamus pretium, ex non tempus tempus, orci metus vulputate purus, ut volutpat ante orci quis ex. Praesent erat arcu, ultrices vitae scelerisque id, scelerisque vitae felis. Fusce bibendum nisi et justo pellentesque, sed rutrum elit laoreet. Morbi vestibulum quam efficitur, varius quam vel, euismod ex. Donec imperdiet blandit mi, sed congue nibh rutrum et. Pellentesque imperdiet in leo sed tempus.</p>
                    <p>Aliquam sit amet metus ut sem sodales viverra. Integer hendrerit in risus a venenatis. Sed rutrum malesuada sagittis. Donec sapien odio, imperdiet vel placerat eu, porta posuere turpis. Vivamus libero sem, luctus at nisi sed, finibus mollis nibh. Etiam auctor tortor sed nisl sodales, ut scelerisque erat commodo. Quisque a neque ac mauris tincidunt tincidunt. Curabitur convallis neque nec eros convallis, ac placerat sapien faucibus. Donec in felis tellus. Integer lacinia faucibus ipsum, id hendrerit arcu feugiat quis. Proin ut tortor feugiat, porttitor est nec, porta leo.</p>
                    <p>Nunc luctus velit felis, et iaculis dui egestas non. Suspendisse id pretium tortor, quis luctus erat. Fusce non enim non erat semper tincidunt. Donec eu tellus eu ex imperdiet aliquet. Ut libero leo, tristique non auctor at, luctus sit amet risus. Duis dictum, erat ut semper convallis, justo tortor mattis quam, eu finibus augue risus quis neque. Aenean condimentum placerat leo vel faucibus. Vivamus tincidunt at urna quis tempus. Sed nec sem iaculis, euismod tellus non, mollis enim. Integer varius lorem id mollis volutpat. In laoreet eleifend odio, sed congue nisl.</p>
                    <a name="proteinas"></a><h3>Proteínas</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum pretium neque odio, non consequat libero eleifend in. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent purus justo, eleifend vel turpis vitae, viverra posuere nisi. Pellentesque vel magna posuere, faucibus ante in, pharetra enim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc vulputate augue eros. Sed feugiat maximus est, id blandit libero ultrices non. Nulla facilisi.</p>
                    <p>Vestibulum mollis velit non ipsum rhoncus porttitor. Praesent vel urna nec urna commodo mattis convallis ac metus. Etiam eget enim ut velit commodo gravida eget non neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed interdum, ex ac egestas elementum, lacus orci aliquam ante, quis porta nunc purus at lorem. Donec ullamcorper finibus suscipit. Aliquam et libero eros. Sed condimentum ligula eu nunc condimentum efficitur. Donec luctus, dolor vitae interdum cursus, tortor metus tincidunt diam, ac euismod eros nulla eu nibh.</p>
                    <p>Donec accumsan sem dapibus ligula sodales, non sagittis nulla rutrum. Vivamus quis porta odio. Fusce convallis libero leo. Vivamus pretium, ex non tempus tempus, orci metus vulputate purus, ut volutpat ante orci quis ex. Praesent erat arcu, ultrices vitae scelerisque id, scelerisque vitae felis. Fusce bibendum nisi et justo pellentesque, sed rutrum elit laoreet. Morbi vestibulum quam efficitur, varius quam vel, euismod ex. Donec imperdiet blandit mi, sed congue nibh rutrum et. Pellentesque imperdiet in leo sed tempus.</p>
                    <a name="verduras"></a><h3>Verduras</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum pretium neque odio, non consequat libero eleifend in. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent purus justo, eleifend vel turpis vitae, viverra posuere nisi. Pellentesque vel magna posuere, faucibus ante in, pharetra enim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc vulputate augue eros. Sed feugiat maximus est, id blandit libero ultrices non. Nulla facilisi.</p>
                    <p>Vestibulum mollis velit non ipsum rhoncus porttitor. Praesent vel urna nec urna commodo mattis convallis ac metus. Etiam eget enim ut velit commodo gravida eget non neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed interdum, ex ac egestas elementum, lacus orci aliquam ante, quis porta nunc purus at lorem. Donec ullamcorper finibus suscipit. Aliquam et libero eros. Sed condimentum ligula eu nunc condimentum efficitur. Donec luctus, dolor vitae interdum cursus, tortor metus tincidunt diam, ac euismod eros nulla eu nibh.</p>
                    <p>Donec accumsan sem dapibus ligula sodales, non sagittis nulla rutrum. Vivamus quis porta odio. Fusce convallis libero leo. Vivamus pretium, ex non tempus tempus, orci metus vulputate purus, ut volutpat ante orci quis ex. Praesent erat arcu, ultrices vitae scelerisque id, scelerisque vitae felis. Fusce bibendum nisi et justo pellentesque, sed rutrum elit laoreet. Morbi vestibulum quam efficitur, varius quam vel, euismod ex. Donec imperdiet blandit mi, sed congue nibh rutrum et. Pellentesque imperdiet in leo sed tempus.</p>
                    <a name="hidratoscarbono"></a><h3>Hidratos de Carbono</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum pretium neque odio, non consequat libero eleifend in. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent purus justo, eleifend vel turpis vitae, viverra posuere nisi. Pellentesque vel magna posuere, faucibus ante in, pharetra enim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc vulputate augue eros. Sed feugiat maximus est, id blandit libero ultrices non. Nulla facilisi.</p>
                    <p>Vestibulum mollis velit non ipsum rhoncus porttitor. Praesent vel urna nec urna commodo mattis convallis ac metus. Etiam eget enim ut velit commodo gravida eget non neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed interdum, ex ac egestas elementum, lacus orci aliquam ante, quis porta nunc purus at lorem. Donec ullamcorper finibus suscipit. Aliquam et libero eros. Sed condimentum ligula eu nunc condimentum efficitur. Donec luctus, dolor vitae interdum cursus, tortor metus tincidunt diam, ac euismod eros nulla eu nibh.</p>
                    <p>Donec accumsan sem dapibus ligula sodales, non sagittis nulla rutrum. Vivamus quis porta odio. Fusce convallis libero leo. Vivamus pretium, ex non tempus tempus, orci metus vulputate purus, ut volutpat ante orci quis ex. Praesent erat arcu, ultrices vitae scelerisque id, scelerisque vitae felis. Fusce bibendum nisi et justo pellentesque, sed rutrum elit laoreet. Morbi vestibulum quam efficitur, varius quam vel, euismod ex. Donec imperdiet blandit mi, sed congue nibh rutrum et. Pellentesque imperdiet in leo sed tempus.</p>
                    <a name="frutas"></a><h3>Frutas</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum pretium neque odio, non consequat libero eleifend in. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent purus justo, eleifend vel turpis vitae, viverra posuere nisi. Pellentesque vel magna posuere, faucibus ante in, pharetra enim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc vulputate augue eros. Sed feugiat maximus est, id blandit libero ultrices non. Nulla facilisi.</p>
                    <p>Vestibulum mollis velit non ipsum rhoncus porttitor. Praesent vel urna nec urna commodo mattis convallis ac metus. Etiam eget enim ut velit commodo gravida eget non neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed interdum, ex ac egestas elementum, lacus orci aliquam ante, quis porta nunc purus at lorem. Donec ullamcorper finibus suscipit. Aliquam et libero eros. Sed condimentum ligula eu nunc condimentum efficitur. Donec luctus, dolor vitae interdum cursus, tortor metus tincidunt diam, ac euismod eros nulla eu nibh.</p>
                    <p>Donec accumsan sem dapibus ligula sodales, non sagittis nulla rutrum. Vivamus quis porta odio. Fusce convallis libero leo. Vivamus pretium, ex non tempus tempus, orci metus vulputate purus, ut volutpat ante orci quis ex. Praesent erat arcu, ultrices vitae scelerisque id, scelerisque vitae felis. Fusce bibendum nisi et justo pellentesque, sed rutrum elit laoreet. Morbi vestibulum quam efficitur, varius quam vel, euismod ex. Donec imperdiet blandit mi, sed congue nibh rutrum et. Pellentesque imperdiet in leo sed tempus.</p>
                    <a name="grasas"></a><h3>Grasas</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum pretium neque odio, non consequat libero eleifend in. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent purus justo, eleifend vel turpis vitae, viverra posuere nisi. Pellentesque vel magna posuere, faucibus ante in, pharetra enim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc vulputate augue eros. Sed feugiat maximus est, id blandit libero ultrices non. Nulla facilisi.</p>
                    <p>Vestibulum mollis velit non ipsum rhoncus porttitor. Praesent vel urna nec urna commodo mattis convallis ac metus. Etiam eget enim ut velit commodo gravida eget non neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed interdum, ex ac egestas elementum, lacus orci aliquam ante, quis porta nunc purus at lorem. Donec ullamcorper finibus suscipit. Aliquam et libero eros. Sed condimentum ligula eu nunc condimentum efficitur. Donec luctus, dolor vitae interdum cursus, tortor metus tincidunt diam, ac euismod eros nulla eu nibh.</p>
                    <p>Donec accumsan sem dapibus ligula sodales, non sagittis nulla rutrum. Vivamus quis porta odio. Fusce convallis libero leo. Vivamus pretium, ex non tempus tempus, orci metus vulputate purus, ut volutpat ante orci quis ex. Praesent erat arcu, ultrices vitae scelerisque id, scelerisque vitae felis. Fusce bibendum nisi et justo pellentesque, sed rutrum elit laoreet. Morbi vestibulum quam efficitur, varius quam vel, euismod ex. Donec imperdiet blandit mi, sed congue nibh rutrum et. Pellentesque imperdiet in leo sed tempus.</p>
                </div>
            </div>
            
            <div class="col-md-5">
            	<div class="row">
                	<div class="col-md-12">
                    	<div class="muestraIntercambios">
                            <h2 class="datospers">Tus intercambios</h2>
                            <p id="intercambios"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="muestraHistorial">
                            <h2 class="datospers">Tu historial de peso</h2>
                            <div id="caja">
                                <div id="grafica"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-md-12">
                        <div class="muestraDatosPers">
                            <h2 class="datospers"><button class="botondesplegable" data-toggle="tooltip" data-placement="top" title="Mostrar / Ocultar" id="flip1" style="cursor: pointer;"><span id="iconoflip1" class="glyphicon glyphicon-menu-down"></span> Perfil </button></h2>
                            <div id="panel1">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p><b>Nombre completo</b></p>
                                        <p id="nombre"><?php echo $_SESSION["nombre"]." ".$_SESSION["apellidos"] ?></p>
                                    </div>
                                    <div class="col-sm-4">
                                    	<p><b>Teléfono</b> <span data-toggle="tooltip" data-placement="top" title="Actualizar"><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalTelefono"><span class="glyphicon glyphicon-edit"></span></button></span></p>
                                        <p><span id="telefono"><?php echo $_SESSION["telefono"] ?></span></p>
                                        
                                    </div>
                                    <div class="col-sm-4">
                                    	<p><b>Código Postal</b> <span data-toggle="tooltip" data-placement="top" title="Actualizar"><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalCp"><span class="glyphicon glyphicon-edit"></span></button></span></p>
                                        <p><span id="cp"><?php echo $_SESSION["cp"] ?></span></p>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p><b>Sexo</b></p>
                                        <p id="sexo"><?php if($_SESSION["sexo"]=="h"){echo "Hombre";} else {echo "Mujer";} ?></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p><b>Tu edad</b></p>
                                        <p id="edad"><?php echo edad($_SESSION["fechanac"]) ?></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p><b>Altura</b> <span data-toggle="tooltip" data-placement="top" title="Actualizar"><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalAltura"><span class="glyphicon glyphicon-edit"></span></button></span></p>
                                        <p><span id="altura" ng-model="angaltura"><?php echo $_SESSION["altura"] ?></span> cm.</p>
                                    </div>    
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p><b>Tu peso</b> <span data-toggle="tooltip" data-placement="top" title="Actualizar"><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalPeso"><span class="glyphicon glyphicon-edit"></span></button></span></p>
                                        <p><span id="peso"><?php echo $_SESSION["peso"] ?></span> Kg.</p>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><b>Tu peso deseable</b></p>
                                        <p><span id="pesodeseable"><?php echo $_SESSION["pesodeseable"] ?></span> Kg.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p><b>Tu actividad física</b> <span data-toggle="tooltip" data-placement="top" title="Actualizar"><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalActividad"><span class="glyphicon glyphicon-edit"></span></button></span></p>
                                        <p><span id="actf"></span> (<span id="descactf"></span>)</p>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p><b>Consumo ideal de calorías</b></p>
                                        <p><span id="geet"><?php echo $_SESSION["geet"] ?></span> Kcal/día</p>
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                	</div>
                </div>
                <div class="row">
                	<div class="col-md-12">
                        <div class="muestraPatologias">
                            <h2 class="datospers"><button class="botondesplegable" data-toggle="tooltip" data-placement="top" title="Mostrar / Ocultar" id="flip2" style="cursor: pointer;"> <span id="iconoflip2" class="glyphicon glyphicon-menu-down"></span> Patologías / Situación fisiológica</button> <span data-toggle="tooltip" data-placement="top" title="Actualizar"><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalPatologias"><span class="glyphicon glyphicon-edit"></span></button></span></h2>
                            <div id="panel2">
                                <p id="patologias"></p>
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
    
    <!-- Modals de actualizar datos -->
    
    <!-- Modal Actualizar Altura -->
    <div id="modalAltura" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Actualiza tu altura</h4>
          </div>
          <div class="modal-body">
              <form role="form" name="formactaltura" method="post">
              	<label for="actaltura">Nueva altura en centímetros</label>
                <input type="number" class="form-control" id="actaltura" name="actaltura" required min="0" max="500" onKeyUp="actCompruebaAltura();" onChange="actCompruebaAltura();" onpaste="return false;" />
                <span class="error" id="actaltura2"></span>
              </div>
              <div class="modal-footer">
                <button type="submit" id="buttomactaltura" class="btn btn-success" data-dismiss="modal" disabled="true" onClick="actualizarAltura(<?php echo $_SESSION["id"] ?>);"><span class="glyphicon glyphicon-check"></span> Aceptar</button>
                <button type="button" class="btn btn-danger btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              </form>
          </div>
        </div>
    
      </div>
    </div>
    <!-- Fin Modal Actualizar Altura -->
    
    <!-- Modal Actualizar Peso -->
    <div id="modalPeso" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Actualiza tu peso</h4>
          </div>
          <div class="modal-body">
              <form role="form" name="formactpeso" method="post">
                <label for="actpeso">Nuevo peso en Kg.</label>
                <input type="number" class="form-control" id="actpeso" name="actpeso" min="0" max="500" step="0.01" onKeyUp="actCompruebaPeso();" onChange="actCompruebaPeso();" required onpaste="return false;" />
                <span class="error" id="actpeso2"></span>
              </div>
              <div class="modal-footer">
                <button type="submit" id="buttomactpeso" class="btn btn-success" data-dismiss="modal" disabled="true" onClick="actualizarPeso(<?php echo $_SESSION["id"] ?>);"><span class="glyphicon glyphicon-check"></span> Aceptar</button>
                <button type="button" class="btn btn-danger btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              </form>
          </div>
        </div>
    
      </div>
    </div>
    <!-- Fin Modal Actualizar Peso -->
    
    <!-- Modal Actualizar Telefono -->
    <div id="modalTelefono" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Actualiza tu teléfono</h4>
          </div>
          <div class="modal-body">
              <form role="form" name="formacttelefono" method="post">
                <label for="acttelefono">Nuevo teléfono</label>
                <input type="tel" class="form-control" id="acttelefono" name="acttelefono" onKeyPress="return validaTelefono(event);" required maxlength="9" onpaste="return false;" onKeyUp="actCompruebaTelefono();" onChange="actCompruebaTelefono();" />
                <span class="error" id="acttelefono2"></span>
              </div>
              <div class="modal-footer">
                <button type="submit" id="buttomacttelefono" class="btn btn-success" data-dismiss="modal" disabled="true" onClick="actualizarTelefono();"><span class="glyphicon glyphicon-check"></span> Aceptar</button>
                <button type="button" class="btn btn-danger btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              </form>
          </div>
        </div>
    
      </div>
    </div>
    <!-- Fin Modal Actualizar Teléfono -->
    
    <!-- Modal Actualizar Patologías -->
    <div id="modalPatologias" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Actualiza tus patologías o situación fisiológica</h4>
          </div>
          <div class="modal-body">
              <form role="form" name="formactpatologias" method="post">
                <span id="patologias2"></span>
              </div>
              <div class="modal-footer">
                <button type="submit" id="buttomacttelefono" class="btn btn-success" data-dismiss="modal" onClick="actualizarPatologias(<?php echo $_SESSION["id"] ?>);"><span class="glyphicon glyphicon-check"></span> Aceptar</button>
                <button type="button" class="btn btn-danger btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              </form>
          </div>
        </div>
    
      </div>
    </div>
    <!-- Fin Modal Actualizar Patologías -->
    
    <!-- Modal Enviar Email -->
    <div id="modalEmail" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Enviar consulta</h4>
          </div>
          <div class="modal-body">
              <form role="form" name="formEnviarEmail" method="post">
              Escribe tu consulta. Se te enviará una contestación a tu correo electrónico en la máxima brevedad posible.
              <textarea id="mensajeEmail" class="form-control" rows="4" cols="50" onKeyUp="compruebaMensajeEmail();" onChange="compruebaMensajeEmail();"></textarea>
              <span id="mensajeEmail2"></span>
              </div>
              <div class="modal-footer">
                <button type="submit" id="buttommensajeEmail" class="btn btn-success" data-dismiss="modal" disabled="true" onClick="enviarEmail('<?php echo $_SESSION["nombre"] ?>','<?php echo $_SESSION["apellidos"] ?>','<?php echo $_SESSION["email"] ?>');"><span class="glyphicon glyphicon-check"></span> Enviar</button>
                <button type="button" class="btn btn-danger btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              </form>
          </div>
        </div>
    
      </div>
    </div>
    <!-- Fin Modal Enviar Email -->
    
    <!-- Modal Actualizar Actividad -->
    <div id="modalActividad" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Actualiza tu actividad física</h4>
          </div>
          <div class="modal-body">
              <form role="form" name="formActividad" method="post">
              <span id="opciones"></span>
              <span id="descopciones"></span>
              </div>
              <div class="modal-footer">
                <button type="submit" id="buttomActividad" class="btn btn-success" data-dismiss="modal" onClick="actualizaActividad(<?php echo $_SESSION["id"] ?>)"><span class="glyphicon glyphicon-check"></span> Aceptar</button>
                <button type="button" class="btn btn-danger btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              </form>
          </div>
        </div>
    
      </div>
    </div>
    <!-- Fin Modal Actualizar Actividad -->
    
    <!-- Modal Actualizar Password -->
    <div id="modalPass" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Cambiar contraseña</h4>
          </div>
          <div class="modal-body">
              <form role="form" name="formPass" method="post">
              		<div class="form-group">
                        <label for="password">Contraseña (requerido)</label>
                        <input type="password" class="form-control" id="password" name="password" required maxlength="30" onKeyUp="validaPassword(); activaBotonPass();" />
                        <span class="error" id="errorpassword1"></span>
                    </div>
                    <div class="form-group">
                        <label for="password2">Repite contraseña</label>
                        <input type="password" class="form-control" id="password2" name="password2" required maxlength="30" onKeyUp="validaPassword(); activaBotonPass();" />
                        <span class="error" id="compruebapassword"></span>
                        <span class="error" id="errorpassword2"></span>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="submit" id="buttomPass" class="btn btn-success" data-dismiss="modal" disabled="true" onClick="actualizaPassword();"><span class="glyphicon glyphicon-check"></span> Aceptar</button>
                <button type="button" id="buttomCancelarPass"  onClick="borrarPass();" class="btn btn-danger btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              </form>
          </div>
        </div>
    
      </div>
    </div>
    <!-- Fin Modal Actualizar Password -->
    
    <!-- Modal Actualizar Código Postal -->
    <div id="modalCp" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Actualiza tu código postal</h4>
          </div>
          <div class="modal-body">
              <form role="form" name="formactcp" method="post">
                <label for="actcp">Nuevo código postal</label>
                <input type="tel" class="form-control" id="actcp" name="actcp" onKeyPress="return validaTelefono(event);" required maxlength="5" onpaste="return false;" onKeyUp="actCompruebaCp();" onChange="actCompruebaCp();" />
                <span class="error" id="actcp2"></span>
              </div>
              <div class="modal-footer">
                <button type="submit" id="buttomactcp" class="btn btn-success" data-dismiss="modal" disabled="true" onClick="actualizarCp();"><span class="glyphicon glyphicon-check"></span> Aceptar</button>
                <button type="button" class="btn btn-danger btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              </form>
          </div>
        </div>
    
      </div>
    </div>
    <!-- Fin Modal Actualizar Código Postal -->
    
    <script>
	cargarActividadFisica();
	cargaActividadCliente();
	cargaPatologiasCliente(<?php echo $_SESSION["id"] ?>);
	graficaPeso(<?php echo $_SESSION["id"] ?>);
	cargarIntercambios(<?php echo $_SESSION["id"] ?>);
	datosEmpresa();
	muestraTodasPatologiasAct("<?php echo $_SESSION["sexo"] ?>");
	$('[data-toggle="tooltip"]').tooltip();
	</script>
</body>
</html>
