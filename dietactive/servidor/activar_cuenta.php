<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Activación de cuenta - DietActive</title>
<link rel="shortcut icon" href="../cliente/images/fav.png">
<link rel="stylesheet" type="text/css" href="../styles.css">

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../cliente/estilos.css">
<script src="../cliente/funciones.js"></script>
<script src="../functions.js"></script>
<script>
window.onload=function(){
	ocultaLoading();
}
</script>
</head>

<body>
<div id="loading"></div>
        <div id="imgLoading">
            <img src="../cliente/images/loading.gif" alt="loading" title="loading" />
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
                    <a style="cursor:pointer;" href="../index.html" class="navbar-brand" data-toggle="tooltip" data-placement="top" ><img id="logo" src="../cliente/images/cab.png" class="img-responsive" width="240px" alt="Logo DietActive" /></a>
                  </div>
                 
                  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
                       otro elemento que se pueda ocultar al minimizar la barra -->
                  <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                      <li><a style="cursor:pointer;" class="navegacion" onClick="principal('../index.html#quienessomos')">Quiénes Somos</a></li>
                      <li><a style="cursor:pointer;" class="navegacion" onClick="principal('../index.html#servicios')">Servicios</a></li>
                      <li><a href="../consejos.html">Consejos</a></li>
                      <li><a href="../cliente/clientelogin.php" class="navegacion">Área cliente</a></li>
                      <li><a href="../cliente/dietistalogin.php" class="navegacion">Área dietista</a></li>
                    </ul>
                  </div>
                </nav>
</header>
    
    <div id="separador"></div>
    
    <div class="container-fluid">
        <div class="row cabecera">
        	<div class="col-md-12">
                <p align="center" style="margin-bottom:0px;"><img src="../cliente/images/cab.png" class="img-responsive" width="580px" alt="DietActive" /></p>
                <p align="center" class="slogan">Tu Dieta Equilibrada Personalizada</p>
            </div>
        </div>
        <div class="row cabecera">
        	<div class="col-md-12">
                <h1 id="ancla">Área Cliente</h1>
            </div>
        </div>
        <div class="row cuerpo">
        	<div class="col-md-4">
            </div>
            <div class="col-md-4">
            	<h3 class="datospers">Activación de cuenta</h3><!-- CONTENIDO DE LA WEB <a href="#" class="actualizar">[Actualizar]</a> -->
                <p id="contenidos">
<?php
include("config.inc.php");
include("funciones.inc.php");
if (isset($_GET['id']))
{
	$c = new MySQLi($servidor,$usuario,$password,$bbdd);
	$c->set_charset("utf8");
	$id=$_GET['id'];
	$codigo=$_GET['codigo'];  ;
	
    $preparada = $c->prepare("update cliente set activado='s' where id=? and codigo_activacion=?");
	$preparada->bind_param("is",$id,$codigo);
	if($preparada->execute())
	{
		echo "Activado correctamente.";
	}
	else
	{
		echo "No se ha podido activar tu cuenta.";
	}
}
?>
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
                    <p class="pietexto"><a class="pieenlace" target="_blank" href="../cliente/avisolegal.html"><span>Políticas</span></a></p>
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
