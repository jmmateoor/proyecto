<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Inicio de sesión - DietActive</title>
<link rel="shortcut icon" href="images/fav.png">
<link rel="stylesheet" type="text/css" href="../styles.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="estilos.css">
<script src="funciones.js"></script>
<script src="../functions.js"></script>
<script>
window.onload=function(){
	ocultaLoading();
}

function pulsarEnter(e) {
  		tecla =e.keyCode;
  		if (tecla==13)
		{ 
			clienteLogin();
		}
}

function clienteLogin()
{
	var email=$("#email").val();
	var password=$("#password").val();
	
	$.post("../servidor/clientelogin.php",{
			password: $("#password").val(),
			email: $("#email").val()
							},
							function(data, estado)
							{
								if(data=="s")
								{
									location.href="cliente_inicio.php";
									
								}
								else
								{
									$("#password").val("");
									$("#fallologin").html("El correo electrónico y/o contraseña son incorrectos o tu cuenta no está activada.");
								}
							});
}

</script>
</head>

<body>
	<div id="loading"></div>
    <div id="imgLoading">
        <img src="images/loading.gif" alt="loading" title="loading" />
    </div>
	<script>muestraLoading();</script>
    
    <header>
    <nav class="navbar navbar-inverse menuinicio2 navbar-fixed-top" role="navigation">
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
                    <a style="cursor:pointer;" href="../index.html" class="navbar-brand" data-toggle="tooltip" data-placement="top" ><img id="logo" src="images/cab.png" class="img-responsive" width="240px" alt="Logo DietActive" /></a>
                  </div>
                 
                  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
                       otro elemento que se pueda ocultar al minimizar la barra -->
                  <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                      <li><a style="cursor:pointer;" class="navegacion" onClick="principal('../index.html#quienessomos')">Quiénes Somos</a></li>
                      <li><a style="cursor:pointer;" class="navegacion" onClick="principal('../index.html#servicios')">Servicios</a></li>
                      <li><a style="cursor:pointer;" class="navegacion" onClick="principal('../index.html#consejos')">Consejos</a></li>
                      <li><a href="clientelogin.php" class="navegacion">Área cliente</a></li>
                      <li><a href="dietistalogin.php" class="navegacion">Área dietista</a></li>
                    </ul>
                  </div>
                </nav>
</header>
    
    <div id="separador"></div>

    <div class="container-fluid">
        <div class="row cabecera">
            <div class="col-md-12">
                <p align="center" style="margin-bottom:0px;"><img src="images/cab.png" class="img-responsive" width="800px" alt="DietActive" /></p>
                <p align="center" class="slogan">Tu Dieta Equilibrada Personalizada</p>
            </div>
            
            
        </div>
        <div class="row cabecera">
        	<div class="col-md-10 areacliente">
                <h1 id="ancla">Área Cliente</h1>
                
            </div>
            <div class="col-md-2">
            	<h4 class="textocab">Contacto</h4>
                <span class="textocab"><a id="dietfijo11" class="cabenlace" href=""><span id="dietfijo12"></span></a> / </span>
                <span class="textocab"><a id="dietmovil11" class="cabenlace" href=""><span id="dietmovil12"></span></a></span>
            </div>
        </div>
        <div class="row cuerpo">
        
        	<div class="col-md-4">
            </div>
            <div class="col-md-4">
            	<h3 class="datospers">Inicio de sesión</h3><!-- CONTENIDO DE LA WEB <a href="#" class="actualizar">[Actualizar]</a> -->
                <p id="contenidos">
                <form action="" method="post" >
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" onKeyPress="pulsarEnter(event);" required maxlength="100" />
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required maxlength="30" onKeyPress="pulsarEnter(event);" onKeyUp="validaPassword();" />
                </div>
                <input type="button" value="Iniciar sesión" class="btn btn-default" onClick="clienteLogin();" /> o <a class="enlacenormal" href="registro.html">registrarse</a>
                </form>
                <span id="fallologin"></span>
                </p>
            </div>
            <div class="col-md-4">
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
    <script>
	datosEmpresa();
	</script>
</body>
</html>
