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
<title>Qué es el Diario dietético - DietActive</title>
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
	/*$("#flip2").click(function(){
	$("#panel2").slideToggle(function(){
				$("#iconoflip2").toggleClass("glyphicon-menu-up");
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
	$("#panel2").hide();*/
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
                      <li class="dropdown active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <span class="glyphicon glyphicon-book"></span> Diario dietético <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="cliente_que_es.php">Qué es</a></li>
                          <li class="divider"></li>
                          <li><a href="cliente_diario_dia_1.php">Día 1</a></li>
                          <li class="divider"></li>
                          <li><a href="cliente_diario_dia_2.php">Día 2</a></li>
                          <li class="divider"></li>
                          <li><a href="cliente_diario_dia_3.php">Día 3</a></li>
                        </ul>
                      </li>
                      <li><a href="cliente_alimentos_intercambio.php"><span class="glyphicon glyphicon-list"></span> Alimentos por intercambio</a></li>
                    </ul>
                  </div>
                </nav>
                
            
                
                
                
                
                
            </div>
        </div>
        <div class="row cuerpo">
        
        
        
                
                
                
        	<div class="col-md-7">
            	<h2 class="datospers">Diario dietético, qué es</h2><!-- CONTENIDO DE LA WEB -->
                <div id="contenidos">
                    <p>El Diario dietético es un test que todos los usuarios deben realizar antes de acudir a la cita con el dietista.</p>
					<p>Con este diario de tres días usted puede anotar cada alimento consumido y el peso de cada uno por separado cómodamente utilizando los desplegables.</p>
					<p>Cada día y momento del día están separados para ser rellenados según se consumen los alimentos para evitar olvidos.</p>

					<h3>¿Cómo se realiza?</h3>
					<p>Para poder realizar el test con facilidad siga estos pasos:</p>
					<h4>1. Cuando esté cocinando los alimentos pese o estime el peso  de cada uno sin olvidar anotarlos en una hoja de papel.</h4>
                    <br/>

					<p><b>Ejemplo:</b> Preparamos 2 filetes de pollo a la plancha y una ensalada. Para beber tomo una lata de cerveza de 330 ml.</p>
					<p>Pesamos los dos filetes antes de cocinarlos y anotamos el peso en gramos.</p>
					<p>Estimamos o pesamos el aceite usado (Recordar: 1 cucharada son 14 gramos de aceite).</p>
					<p>Enjuagamos y cortamos la lechuga para pesarla (Consejo: tarar el bol de ensalada antes de añadir la lechuga deseada) y anotamos el peso.</p>
					<p>Cortamos el tomate y pesamos (Consejo: tarar de nuevo el bol con la lechuga para pesar el tomate)</p>
					<p><b>¡No olvidemos el aceite añadido a la ensalada! (1 cucharada= 14 gramos).</b></p>

					<h4>2. Consuma los alimentos completamente o estime la cantidad final ingerida.</h4>
					<p><b>Ejemplo:</b> Consumimos un filete de pollo, un tercio de la ensalada y la lata de cerveza entera.</p>
					<p>Los dos filetes pesaban 180 gramos, como me comí uno anoto 90 gramos.</p>
					<p>La lechuga pesaba 150 gramos, como me comí solo un tercio anoto 50 gramos.</p>
					<p>De tomate llevaba 100 gramos, anoto 33 gramos que es un tercio.</p>
					<p>El aceite consumido por parte de los filetes sería la mitad, como añadí una cucharada la mitad es 7 gramos.</p>
					<p>El aceite añadido a la ensalada fueron dos cucharadas, es decir 28 gramos de los cuales he consumido un tercio: 9 gramos.</p>
					<p>La lata de cerveza la tomamos entera por lo que anotamos 330 gramos.</p>
					<p><b>Consejo: Intente hacer los cálculos de memoria para ejercitar la mente, en caso de ser muchos puede ayudarse de una calculadora.</b></p>

					<h4>3. Inicie sesión en nuestra web y acceda al día y momento del día deseado y rellene los datos.</h4>
					<p><b>Ejemplo:</b> En nuestro caso hemos tomado el pollo con ensalada en el almuerzo.</p>
					<p>Entonces:</p>
                    <ul>
                        <li>Inicio sesión y pincho sobre Diario dietético.</li>
                        <li>Como estoy rellenando el primer día, seleccione Día 1.</li>
                        <li>Este ha sido mi almuerzo asique voy a Almuerzo y hago click en Empezar.</li>
                        <li>Aparece un cuadro de dialogo que me informa de que los datos anteriores guardados en Almuerzo del Día 1 serán borrados. Como no tengo nada o lo que tengo quiero actualizarlo, le doy a Aceptar.</li>
                        <li>Comenzamos el test añadiendo un campo para un alimento pulsando en el botón Agregar alimento.</li>
                        <li>Aparecen 2 desplegables y un recuadro para escribir, que usaremos de la siguiente forma:</li>
                            <p>- Hacemos click sobre el primer desplegable y se nos muestra una lista con los Grupos de alimentos que podemos elegir. En nuestro caso para añadir el pollo, seleccionamos Aves y huevos.</p>
                            <p>- Luego hacemos click sobre el segundo desplegable que muestra una lista con los Alimentos que pertenecen al grupo de Aves y huevos. En nuestro ejemplo seleccionamos Pechuga de pollo.</p>
                            <p>- Por ultimo en el recuadro para escribir, tenemos que poner en gramos el peso del alimento que hemos comido. ¡Recuerda! El peso de lo que hemos comido no lo que cocinamos. En el ejemplo comimos 90 gramos de pollo, por lo que escribimos 90.</p>
                            <p>- Para continuar con el resto de alimentos vamos añadiendo con el botón Agregar alimentos y vamos procediendo igual que con el pollo. </p>
                            <p>Para la ensalada seria: pulsamos en Agregar alimentos.</p>
                            <p>Desplegable 1=> Verduras y hortalizas</p>
                            <p>Desplegable 2=> Lechuga</p>
                            <p>Recuadro para escribir => 50.</p>
                            <p>Para el tomate: pulsamos en Agregar alimentos.</p>
                            <p>Desplegable 1=> Verduras y hortalizas</p>
                            <p>Desplegable 2=> Tomate crudo</p>
                            <p>Recuadro para escribir => 33.</p>
                            <p>Para el aceite de oliva podemos añadir todo junto: 7 gramos del filete + 9 gramos de la ensalada, o añadir dos campos y seleccionar dos veces el aceite y añadir en uno 7 y en otro 9: pulsamos en Agregar alimentos.</p>
                            <p>Desplegable 1=> Aceites y grasas</p>
                            <p>Desplegable 2=> Aceite de oliva</p>
                            <p>Recuadro para escribir => 16.</p>
                            <p>Para la cerveza: pulsamos en Agregar alimentos.</p>
                            <p>Desplegable 1=> Bebidas</p>
                            <p>Desplegable 2=> Cerveza</p>
                            <p>Recuadro para escribir => 330.</p>

						<li>Cuando terminamos de añadir todos los alimentos pulsamos en Aceptar para guardar nuestro test y en Cancelar para borrarlo.</li>

           			</ul>         
                    
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
                        <div class="muestraDatosPers">
                            <h2 class="datospers">Perfil</h2>
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
                            <h2 class="datospers">Patologías / Situación fisiológica <span data-toggle="tooltip" data-placement="top" title="Actualizar"><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalPatologias"><span class="glyphicon glyphicon-edit"></span></button></span></h2>
                            <div id="panel2">
                                <p id="patologias"></p>
                            </div>
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
                    <p class="pietexto"><a class="pieenlace" target="_blank" href="avisolegal.html"><span>Políticas</span></a></p>
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
	cargaPatologiasCliente(<?php echo $_SESSION["id"] ?>);
	cargarActividadFisica();
	cargaActividadCliente();
	
	graficaPeso(<?php echo $_SESSION["id"] ?>);
	cargarIntercambios(<?php echo $_SESSION["id"] ?>);
	datosEmpresa();
	
	muestraTodasPatologiasAct("<?php echo $_SESSION["sexo"] ?>");
	$('[data-toggle="tooltip"]').tooltip();
	</script>
</body>
</html>
