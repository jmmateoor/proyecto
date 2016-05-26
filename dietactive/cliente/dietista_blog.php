<?php
	session_start();
	if($_SESSION["logeadodietista"]!=true)
	{
		header("location: dietistalogin.php");
	}
	include("../servidor/funciones.inc.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Clientes - DietActive</title>
<link rel="shortcut icon" href="images/fav.png">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="estilos.css">

<script src="funciones.js"></script>

<script src="funciones-dietista.js"></script>

<script>
var estadofichero=false;
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

$(function(){
        $("input[name='file']").on("change", function(){
			
            var formData = new FormData($("#formInsertarEntrada")[0]);
            var ruta = "../servidor/subir_imagen.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data)
                {
					datos=JSON.parse(data);
					if(datos[0].ok==1)
					{
						$("#respuesta1").html(datos[0].nombre);
						$("#respuesta2").html("<img width='230px' src='../servidor/imagenes/"+datos[0].ruta+"' />");
						estadofichero=true;
						//alert(nombrearchivo[nombrearchivo.length-1]);
					}
					else
					{
						$("#respuesta2").html(datos[0].error);
						estadofichero=false;
					}
                }
            });
        });
     });

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
                  
                  <li role="presentation"></li>
                  <li class="divider"></li>
                  <li role="presentation"><a role="menuitem" href="cerrar_sesion_dietista.php" style="cursor: pointer;"><span class="glyphicon glyphicon-off"></span> Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
        <div class="row cabeceradiet">
            <div class="col-md-12">
                <p align="center" style="margin-bottom:0px;"><img src="images/cab.png" class="img-responsive" width="580px" alt="DietActive" /></p>
                <p align="center" class="slogan">Tu Dieta Equilibrada Personalizada</p>
            </div>
        </div>
        <div class="row cabeceradiet">
        	<div class="col-md-12">
                <h1>Área Dietista</h1>
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
                    <a href="#" class="navbar-brand" data-toggle="tooltip" data-placement="top" title="Ir a Inicio"><img src="images/logomenu.png" class="img-responsive" width="50px" alt="Ir a Inicio" /></a>
                  </div>
                 
                  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
                       otro elemento que se pueda ocultar al minimizar la barra -->
                  <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                      <li><a href="dietista_citas.php"><span class="glyphicon glyphicon-calendar"></span> Citas</a></li>
                      <li><a href="dietista_clientes.php"><span class="glyphicon glyphicon-filter"></span> Clientes</a></li>
                      <li><a href="dietista_alimentos.php"><span class="glyphicon glyphicon-list"></span> Alimentos</a></li>
                      <li  class="active"><a href="dietista_blog.php"><span class="glyphicon glyphicon-cloud"></span> Blog</a></li>
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
        
        
        
                
                
                
        	<div class="col-md-5">
            	<h2 class="datospers">Entradas al blog</h2><!-- CONTENIDO DE LA WEB -->
                <h3>Buscar entrada:</h3>
                <div class="inner-addon left-addon"><i class="glyphicon glyphicon-search"></i> <input class="form-control " type="text" id=" " onKeyUp=" " /></div>
                <div id="buscador" class="dietistacuerpo listado"></div>
            </div>
            
            <div class="col-md-7">
            	<h2 class="datospers">Insertar entrada</h2>
            	<form role='form' name='formInsertarEntrada' id="formInsertarEntrada" method='post' enctype="multipart/form-data">
                <div class="form-group"><label for="titulo">Título:</label><input type="text" id="titulo" name="titulo" class="form-control" required maxlength="100" /><span id="titulo2" class="error"></span></div>
                
                <span id="listacategorias"></span>
                
                <div class="form-group">
                <label class="btn btn-default btn-file">Seleccionar archivo
                <input type="file" id="archivo" name="file" style="display: none;">
                </label>
                <div id="respuesta1"></div>
  				<div class="cuadroimagen" id="respuesta2"></div>
                </div>
                <div class="form-group"><label for="textoentrada">Texto:</label><textarea type="text" id="textoentrada" name="textoentrada" class="form-control" required maxlength="250" rows="10" cols="50" onKeyUp="cuentaCaracteres();" onChange="cuentaCaracteres();" onMouseUp="cuentaCaracteres();" onBlur="cuentaCaracteres();"></textarea><span id="textoentrada2">0</span>/250</div>
                
                <div class="form-group"><label for="enlace">Enlace vídeo de youtube:</label><input type="text" id="enlace" name="enlace" class="form-control" required maxlength="200" /><span id="titulo2" class="error"></span></div>
                
                
                <div class='row'><button type='button' id='buttomInsertarEntrada' class='btn btn-success' onClick='publicarEntrada();'><span class='glyphicon glyphicon-check'></span> Publicar</button> <button type='reset' class='btn btn-default'><span class='glyphicon glyphicon-erase'></span> Limpiar</button></div>
                </form>
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
                <button type="submit" id="buttomPass" class="btn btn-success" data-dismiss="modal" disabled="true" onClick="actualizaPasswordDietista();"><span class="glyphicon glyphicon-check"></span> Aceptar</button>
                <button type="button" id="buttomCancelarPass"  onClick="borrarPass();" class="btn btn-danger btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              </form>
          </div>
        </div>
    
      </div>
    </div>
    <!-- Fin Modal Actualizar Password -->
    <div id="modalAlimentos"></div>
    <script>
	muestraCategorias()
	datosEmpresa();
	function getTextAreaSelection(textarea) {
    var start = textarea.selectionStart, end = textarea.selectionEnd;
    return {
        start: start,
        end: end,
        length: end - start,
        text: textarea.value.slice(start, end)
    };
}

function detectPaste(textarea, callback) {
    textarea.onpaste = function() {
        var sel = getTextAreaSelection(textarea);
        var initialLength = textarea.value.length;
        window.setTimeout(function() {
            var val = textarea.value;
            var pastedTextLength = val.length - (initialLength - sel.length);
            var end = sel.start + pastedTextLength;
            callback({
                start: sel.start,
                end: end,
                length: pastedTextLength,
                text: val.slice(sel.start, end)
            });
        }, 1);
    };
}

var textarea = document.getElementById("textoentrada");
detectPaste(textarea, function(pasteInfo) {
    cuentaCaracteres()
    // pasteInfo also has properties for the start and end character
    // index and length of the pasted text
});


	$('[data-toggle="tooltip"]').tooltip();
	
	
	
	</script>
</body>
</html>