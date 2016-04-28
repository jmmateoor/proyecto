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
            <div class="col-md-2">
                <p align="center"><img src="images/cab.png" class="img-responsive" width="100px" /></p>
            </div>
            <div class="col-md-10">
                <h1>Zona Cliente</h1>
            </div>
        </div>
        <div class="row cabecera">
            <div class="col-md-12">
                <div class="row inicio">
                    <ul id="menu">
                    	<li>
                            <a href="#" class="menu">
                                <div class="col-sm-1 colmenu seleccionado">
                                    <h2><span class="glyphicon glyphicon-home"></span> Inicio</h2>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu">
                                <div class="col-sm-1 colmenu">
                                    <h2><span class="glyphicon glyphicon-calendar"></span> Citas</h2>
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
                                <div class="col-sm-1 colmenu">
                                    <h2><span class="glyphicon glyphicon-heart"></span> Dieta</h2>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu">
                                <div class="col-sm-3 colmenu">
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
                    	<h3 class="datospers">Tu historial de peso</h3>
                        <div id="caja">
                            <div id="grafica"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-md-12">
                        <h3 class="datospers"><span id="flip1" style="cursor: pointer;"><span id="iconoflip1" class="glyphicon glyphicon-menu-down"></span> Datos Personales </span></h3>
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
                                    <p><b>Teléfono</b></p>
                                    <p><span id="telefono"><?php echo $_SESSION["telefono"] ?></span> <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalTelefono"><span class="glyphicon glyphicon-edit"></span></button></p>
                                </div>
                                <div class="col-sm-3">
                                    <p><b>Altura</b></p>
                                    <p><span id="altura" ng-model="angaltura"><?php echo $_SESSION["altura"] ?></span> cm. <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalAltura"><span class="glyphicon glyphicon-edit"></span></button></p>
                                </div>
                                <div class="col-sm-3">
                                    <p><b>Tu peso actual</b></p>
                                    <p><span id="peso"><?php echo $_SESSION["peso"] ?></span> Kg. <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalPeso"><span class="glyphicon glyphicon-edit"></span></button></p>
                                </div>
                                
                            </div>
                            <div class="row">
                            	<div class="col-sm-3">
                                	<p><b>Tu gasto energético total</b></p>
                                    <p><span id="geet"><?php echo $_SESSION["geet"] ?></span> Kcal/día</p>
                                </div>
                                <div class="col-sm-3">
                                    <p><b>Tu peso deseable</b></p>
                                    <p><span id="pesodeseable"><?php echo $_SESSION["pesodeseable"] ?></span> Kg.</p>
                                </div>
                            </div>
                        </div>
                	</div>
                </div>
                <div class="row">
                	<div class="col-md-12">
                        <h3 class="datospers"><span id="flip2" style="cursor: pointer;"> <span id="iconoflip2" class="glyphicon glyphicon-menu-down"></span> Tus patologías o situación fisiológica</span> <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalPatologias"><span class="glyphicon glyphicon-edit"></span></button></h3>
                        <div id="panel2">
                        	<p id="patologias"></p>
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
                <button type="submit" id="buttomactpeso" class="btn btn-success" data-dismiss="modal" disabled="true" onClick="actualizarPeso();"><span class="glyphicon glyphicon-check"></span> Aceptar</button>
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
    
    
    <script>
	cargaPatologiasCliente(<?php echo $_SESSION["id"] ?>);
	graficaPeso(<?php echo $_SESSION["id"] ?>);
	cargarIntercambios(<?php echo $_SESSION["id"] ?>);
	datosEmpresa();
	muestraTodasPatologiasAct("<?php echo $_SESSION["sexo"] ?>");
	</script>
</body>
</html>
