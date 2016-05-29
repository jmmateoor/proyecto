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
<title>Inicio - DietActive</title>
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
                      <li class="dropdown">
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
            	<h2 class="datospers">Bienvenido a DietActive</h2><!-- CONTENIDO DE LA WEB -->
                <div id="contenidos">
                	<p>Esta es <b>tu área de cliente</b>, en ella puedes actualizar/consultar tus datos, pedir cita, ver tus intercambios y dietas…</p>
                    <h3>Pero, ¿Cómo funciona?</h3>
					<p>Esta es <b>tu página personal</b>, solo tú y el dietista tiene acceso a tus datos.</p> 
					<p>Para poder moverte y acceder a todas las ventajas con facilidad vamos a hablarte un poco de cada una de las secciones.
					<p>Empecemos por esta página en la que estás:</p>
                    <h3>Página de inicio:</h3>
                    <p>En todas las pestañas (Inicio, Citas, Tu dieta, etc) puedes ver a la derecha (o abajo si estas desde el móvil) una serie de cuadros con distinta información que te explicamos a continuación:</p>
                    <ul>
                        <li><h4>Primer cuadro: Tus intercambios.</h4></li>
                        <p>Aquí están ordenados por momento del día y tipo de alimento, los intercambios que debes tomar al día. Para más información lee la explicación sobre los intercambios pinchando <a href="cliente_alimentos_intercambio.php">este enlace.</a></p>
                        <p>Estos intercambios están calculados <b>expresamente para ti</b> con tus datos personales que has proporcionado (altura, edad, peso…). Estos intercambios son solo para ti y <b>te servirán de guía para poco a poco llegar a tu peso ideal</b>. Si cambias de peso o altura debes actualizar tus datos para que tus intercambios sean lo más exactos posibles (la edad se actualiza sola).</p>
                        <p>Para actualizar tus datos debes ir al tercer cuadro: Perfil, el cual explicamos más adelante.</p>
                        <li><h4>Segundo cuadro: Tu historial de peso.</h4></li>
                        <p>En este cuadro se irá formando una gráfica de evolución de tu peso según vayas actualizándolo en Perfil.</p>
                        <p>Se mostraran los últimos 5 pesos añadidos (pueden actualizarse siempre que se desee pero se recomienda hacerlo una vez a la semana o cada dos semanas).</p>

                        <li><h4>Tercer cuadro: Perfil.</h4></li>
                        <p>Aquí se muestran todos tus datos:</p>
                        
                        <p><b>Datos aportados por ti no actualizables:</b> Nombre, sexo y edad (se actualiza sola)</p>
                        <p><b>Datos aportados por ti actualizables:</b> Teléfono, Código postal, Altura (cm), Tu peso y Tu actividad física. Para actualizarlos solo haga click en el icono Actualizar que se encuentra a la derecha de cada dato.</p>
                        <p><b>Datos calculados por nosotros:</b> Tu peso deseable (peso al que pretendemos llegar con la dieta equilibrada y personalizada que te proporcionará el dietista) y Tu consumo ideal de Kcal/día (son las kilocalorías totales que debes consumir al día. Este dato es solo informativo ya que estas kilocalorías deben tomarse siguiendo la guía de los intercambios y no de la manera que queramos).</p>
                        
                        <li><h4>Cuarto cuadro: Patologías / Situación fisiológica.</h4></li>
                        <p>Aquí se muestran las patologías (o si estás embarazada) que has anotado.</p>
                        <p><b>Estos datos son necesarios tenerlos lo más actualizado posible sobre todo las alergias/intolerancias alimentarias</b> para la sugerencia de una dieta adecuada para ti.</p>
                        <p>Para actualizarlos solo haz click en el icono actualizar que se encuentra a la derecha de “Patologías / Situación fisiológica”.</p>
                    </ul>
                    <h3>Página de citas:</h3>
                    <p>Para acceder a ella pulsamos el botón Citas del menú de navegación.</p>
                    <p>En esta pestaña, aparte de los ya conocidos cuatro cuadros con nuestra información personal a la derecha (o abajo en los móviles), tenemos las distintas opciones para pedir cita con uno de nuestros dietistas.</p>
                    <h3>Página Tu dieta:</h3>
                    <p>Ésta página <b>permanecerá en blanco hasta que acudas a una cita con un dietista</b> por primera vez.</p>
                    <p>Una vez tenga lugar la cita con tu dietista, <b>tendrás escrita una dieta equilibrada y personalizada, con tus gustos e intentando respetar tus hábitos alimenticios lo máximo posible</b> para que el cambio a una dieta sana adecuada para ti sea lo menos brusca y aburrida posible.</p>
                    <h3>Página Diario dietético:</h3>
                    <p>En esta pestaña es donde podremos realizar el diario dietético durante tres días <b>antes de acudir a la cita</b> con el dietista para que pueda hacer una evaluación sobre nuestros gustos y costumbres y además pueda detectar tanto posibles carencias nutricionales como excesos no recomendados.</p>
                    <p>Para más información y saber cómo funciona pulsa <a href="cliente_que_es.php">este enlace</a>, o en el desplegable Diario dietético pulse en ¿Qué es?</p>
                    <h3>Página Alimentos por intercambio:</h3>
                    <p>En esta pestaña tenemos la explicación de qué son y cómo se utilizan los intercambios.</p>
                    <p>También están aquí las tablas de los alimentos que utilizaremos para modificar la dieta aportada por el dietista* para hacerla más variada. Los alimentos están separados por tipos de intercambios igual que en la tabla del primer cuadro (está a la derecha de la página, abajo en móviles). Para más información sobre los intercambios pulsa <a href="cliente_alimentos_intercambio.php">este enlace</a>.</p>
                    <p><b>*Tienes que tener en cuenta que las modificaciones que hagas serán evaluadas por tu dietista gracias al Diario dietético el cual tienes que actualizar antes de cada cita.</b></p>
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
