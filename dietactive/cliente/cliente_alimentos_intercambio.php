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
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
                      <li  class="active"><a href="cliente_alimentos_intercambio.php"><span class="glyphicon glyphicon-list"></span> Alimentos por intercambio</a></li>
                    </ul>
                  </div>
                </nav>
                
            
                
                
                
            </div>
        </div>
        <div class="row cuerpo">
        
        
        
                
                
                
        	<div class="col-md-7">
            	<h2 class="datospers">Alimentos por Intercambio</h2><!-- CONTENIDO DE LA WEB -->
                <div id="contenidos">
                	<p>Tenemos que remontarnos unas décadas para hablar del origen de este tipo de dieta. Las doctoras Clotilde Vázquez y Ana I. de Cos desarrollaron este método para ayudar a personas diabéticas en entornos hospitalarios a adquirir hábitos de alimentación adecuados.</p>
					<p>Por su eficacia decidieron diseñar planes basados en dieta equilibrada para tratar la obesidad y el sobrepeso sin hacer uso de medicamentos ni nada artificial. Después de probarlo con varias personas observaron que consiguieron perder grasa realizando un cambio de hábitos de alimentación que pueden mantener en el tiempo.</p>
					<p>Esto es debido a que la Dieta por Intercambios consiste en un sistema abierto y flexible que permite a las personas elegir los que comen según sus gustos y sin menús cerrados. Así pues no hay planes rígidos, nada de aburrirse con la comida, por lo que no perdemos la motivación y disminuye las posibilidades de fracaso ante el plan de adelgazamiento.</p>

					<h3>Entonces, ¿Qué es un Intercambio?</h3>
					<p>En términos técnicos, un intercambio equivale a 10g de nutriente (proteína, grasa o carbohidrato). Es muy útil saber esto cuando se toman alimentos preparados y se observa su etiqueta nutricional.</p>
					<p>Sin embargo es también valido hablar de intercambio como las cantidades visuales de un determinado tipo de alimento, que cualquier persona puede identificar sin necesidad de pesar la comida. Por ejemplo, un vaso de leche es un Intercambio de Lácteos.</p>
					<p>Tenemos seis grupos de alimentos que serían:</p>
                    <ul>
                        <li><b>Lácteos:</b> Leche y sus derivados.</li>
                        <li><b>Proteínas:</b> Carnes, aves,  huevos, pescados, mariscos y todos sus derivados.</li>
                        <li><b>Verduras:</b> Todas las verduras y hortalizas.</li>
                        <li><b>Hidratos de carbono:</b> Pan, pasta, galletas, azúcar y todos los derivados de los cereales.</li>
                        <li><b>Frutas:</b> Todos los tipos de fruta.</li>
                        <li><b>Grasas:</b> Todos los tipos de aceites y mantequillas.</li>
                    </ul>
					<h3>¿Cómo se usa?</h3>
					<p>Una vez realizado el diario dietético y acudido a una cita con el dietista, éste te preparará una dieta con tus Intercambios indicando cantidades y equivalencias de un menú tipo totalmente modificable por ti, siguiendo las normas de los intercambios y con sus debidas revisiones por parte del dietista.</p>
					<p>Ejemplo:</p>
					<p>En el menú sugerido por el dietista tenemos lo siguiente:</p>
					<p><b>Desayuno:</b></p>
					<p><b>Lácteos:</b> 1,5 Intercambios: 1 Vaso de leche y 1 yogur.</p>
					<p><b>Proteínas:</b> 0,5 Intercambios: 1 loncha de jamón cocido.</p>
					<p><b>Hidratos de carbono:</b> 2 Intercambios: 4 dedos de pan de barra.</p>
					<p><b>Frutas:</b> 1,5 Intercambios: 1 vaso de zumo de naranja y 1 melocotón.</p>
					<p><b>Grasas:</b> 0,5 Intercambios: Media cucharada de aceite en la tostada.</p>
					<br/>
					<p>Utilizando las tablas de intercambios, las cuales están referías a 1 intercambio podemos modificar el menú. </p>
					<p>Lácteos: 1,5 Intercambios: 1 Vaso de leche y 1 Actimel.</p>
					<p>Proteínas: 0,5 Intercambios: Los tomo en el almuerzo.</p>
					<p>Hidratos de carbono: 2 Intercambios: 1 taza de cereales sin azúcar.</p>
					<p>Frutas: 1,5 Intercambios: 1 plátano y medio vaso de zumo de melocotón.</p>
					<p>Grasas: 0,5 Intercambios: Los tomo en el almuerzo.</p>
					<p>Los intercambios pueden cambiarse de momento del día (si son solo 0,5) y lo tomamos en la toma consecutiva a la cual los quitamos. Así podemos adaptar una comida algo mayor de lo normal en el almuerzo bajando lo consumido en el desayuno, aunque solo en el caso de que sea medio intercambio, no más. En el ejemplo dejamos 0,5 de proteínas y 0,5 de grasas para el almuerzo donde debemos sumarlos a los que ya tenemos sugeridos para esa ingesta.</p>

					<p>Ventajas de la dieta por intercambio:</p>
					<ul>
                        <li>Permiten comer todo tipo de alimentos, sin las habituales prohibiciones de que suelen establecer otras dietas.</li>
                        <li>Está pensada para llevar una dieta sana y equilibrada, totalmente personalizada a las necesidades fisiológicas y energéticas de cada persona.</li>
                        <li>Basada en nutrición, no utiliza pastillas o suplementos de ningún tipo.</li>
                        <li>Es una dieta flexible y personalizada con tus gustos.</li>
                        <li>Pérdida de peso real y sostenible, no se producen efecto rebote.</li>
                        <li>Aprenderás a comer sano, está basada en Dieta Mediterránea.</li>
					</ul>
                    
                    <div id="lacteos"><h3 style="display:inline;;">Lácteos</h3> <a style="cursor: pointer;" onClick="ir_a('#ancla');"> <span class="glyphicon glyphicon-menu-up"></span> Ir arriba</a></div>
                    <p><div class='table-responsive fondotabla'>
                    <table class='table table-condensed'>
                    <thead><tr><th>Alimento</th><th>Cantidad</th><th>Peso (crudo)</th></tr></thead>
                    <tbody>
                    <tr><td>Leche semidesnatada o desnatada, entera, sin Lactosa, de soja o de avena</td><td>1 Vaso</td><td>220ml</td></tr>
                    <tr><td>Yogures naturales o desnatados (incluidos de sabores)</td><td>2 unidades</td><td></td></tr>
                    <tr><td>Activia desnatados o Densia</td><td>2 unidades</td><td></td></tr>
                    <tr><td>Yogur azucarado o de sabores</td><td>1 unidades</td><td></td></tr>
                    <tr><td>Actimel o Danacol desnatados o sabores</td><td>2unidades</td><td></td></tr>
                    <tr><td>Queso de burgos</td><td>Tarrina pequeña</td><td>75g</td></tr>
                    <tr><td>Helado</td><td>2 bolas</td><td>80g</td></tr>
                    </tbody>
                    </table>
                    </div>
                    </p>
                    
                    <div id="proteinas"><h3 style="display:inline;;">Proteínas</h3> <a style="cursor: pointer;" onClick="ir_a('#ancla');"> <span class="glyphicon glyphicon-menu-up"></span> Ir arriba</a></div>
                    <p>Carnes y embutidos:</p>
                    <p><div class='table-responsive fondotabla'>
                    <table class='table table-condensed'>
                    <thead><tr><th>Alimento</th><th>Cantidad</th><th>Peso (crudo)</th></tr></thead>
                    <tbody>
                    <tr><td>Jamón cocido o pavo</td><td>2 Lonchas</td><td>60g</td></tr>
                    <tr><td>Jamón serrano o ibérico </td><td>1 loncha mediana</td><td>30g</td></tr>
                    <tr><td>Huevo</td><td>1 entero o 2 claras de huevo</td><td>60g</td></tr>
                    <tr><td>Bacón, lomo, lacón, chorizo</td><td>1 loncha</td><td>20g</td></tr>
                    <tr><td>Pollo, pavo, ternera, buey, conejo</td><td>Medo filete pequeño</td><td>50g</td></tr>
                    <tr><td>Cinta de lomo</td><td>1 pequeñas</td><td>50g</td></tr>
                    </tbody>
                    </table>
                    </div>
                    </p>
                    

					<p>Pescados y mariscos:</p>
                    <p><div class='table-responsive fondotabla'>
                    <table class='table table-condensed'>
                    <thead><tr><th>Alimento</th><th>Cantidad</th><th>Peso (crudo)</th></tr></thead>
                    <tbody>
                    <tr><td>Gambas o langostinos, palitos de cangrejo</td><td>3-5 unidades</td><td>50g</td></tr>
                    <tr><td>Almejas o berberechos </td><td>1 cuenco</td><td>100g</td></tr>
                    <tr><td>Mejillones</td><td>5 unidades</td><td>100g</td></tr>
                    <tr><td>Atún</td><td>Lata pequeña</td><td>60g</td></tr>
                    <tr><td>Pescado blanco merluza, pescadilla, gallo, bacalao, lubina, dorada, lenguado, mero, gulas</td><td>Media rodaja mediana</td><td>75g</td></tr>
                    <tr><td>Pulpo, sepia, calamares, cangrejo</td><td>Media ración</td><td>  </td></tr>
                    </tbody>
                    </table>
                    </div>
                    </p>
                    
                    <p>Otros:</p>
                    <p><div class='table-responsive fondotabla'>
                    <table class='table table-condensed'>
                    <thead><tr><th>Alimento</th><th>Cantidad</th><th>Peso (crudo)</th></tr></thead>
                    <tbody>
                    <tr><td>Tofu o seitan</td><td>1 Ración pequeña</td><td>75g</td></tr>
                    <tr><td>Nueces</td><td>8 unidades</td><td>30g</td></tr>
                    <tr><td>Almendras</td><td>15 unidades</td><td>30g</td></tr>
                    </tbody>
                    </table>
                    </div>
                    </p>
                    
                    
                    <div id="verduras"><h3 style="display:inline;;">Verduras</h3> <a style="cursor: pointer;" onClick="ir_a('#ancla');"> <span class="glyphicon glyphicon-menu-up"></span> Ir arriba</a></div>
                    <p><div class='table-responsive fondotabla'>
                    <table class='table table-condensed'>
                    <thead><tr><th>Alimento</th><th>Cantidad</th><th>Peso (crudo)</th></tr></thead>
                    <tbody>
                    <tr><td>Acelgas, apio, berenjena,champiñones, col, coliflor, espinacas, grelos, lechuga, setas, tomates, brócoli, calabacín, canónigos,endivias, escarola, espárragos, pepinos, pimiento verde o rábano.</td><td>1 Plato hondo lleno</td><td>300g</td></tr>
                    <tr><td>Berros, cardos, judías verdes, lombarda, nabos, pimiento rojo o puerros.</td><td>1 Plato hondo lleno</td><td>200g</td></tr>
                    <tr><td>2 alcachofas, 5 coles de bruselas, 3 zanahorias, 1 cebolla, 1 cebolleta, 1 remolacha, 1/4 calabaza.
</td><td>1 Plato hondo lleno</td><td>100g</td></tr>
                    </tbody>
                    </table>
                    </div>
                    </p>

                	
                    <div id="hidratoscarbono"><h3 style="display:inline;;">Hidratos de Carbono</h3> <a style="cursor: pointer;" onClick="ir_a('#ancla');"> <span class="glyphicon glyphicon-menu-up"></span> Ir arriba</a></div>
                    <p>Pan y productos de trigo y maíz:</p>
                    <p><div class='table-responsive fondotabla'>
                    <table class='table table-condensed'>
                    <thead><tr><th>Alimento</th><th>Cantidad</th><th>Peso (crudo)</th></tr></thead>
                    <tbody>
                    <tr><td>Bollo sencillo</td><td>1 pequeño </td><td>30g</td></tr>
                    <tr><td>Bollo para hamburguesa</td><td>1/2 pieza</td><td>35g</td></tr>
                    <tr><td>Medianoche</td><td>1/2 pieza</td><td>30g</td></tr>
                    <tr><td>Pan</td><td>2 dedos</td><td></td></tr>
                    <tr><td>Tostada de pan de molde pequeña</td><td>1 pieza</td><td>20g</td></tr>
                    <tr><td>Picos</td><td>2 piezas</td><td>25g</td></tr>
                    <tr><td>Cereal con fibra (all bran, bran flakes,etc)</td><td>3/4 taza</td><td>30g</td></tr>
                    <tr><td>Cereal para el desayuno sin azúcar</td><td>1/2 taza</td><td>30g</td></tr>
                    <tr><td>Cereal para el desayuno azucarado</td><td>3/4 taza</td><td>25g</td></tr>
                    <tr><td>Galletas tipo "María"</td><td>2 piezas</td><td>15g</td></tr>
                    <tr><td>Tortas de arroz o de maíz</td><td>2 piezas</td><td>15g</td></tr>
                    </tbody>
                    </table>
                    </div>
                    </p>
                    <p>Arroz, maíz, pastas, patatas, legumbres (cocidos):</p>
                    <p><div class='table-responsive fondotabla'>
                    <table class='table table-condensed'>
                    <thead><tr><th>Alimento</th><th>Cantidad</th><th>Peso (crudo)</th></tr></thead>
                    <tbody>
                    <tr><td>Arroz</td><td>1/2 taza</td><td>90g</td></tr>
                    <tr><td>Palomitas de maíz (sin grasa)</td><td>3 tazas</td><td>20g</td></tr>
                    <tr><td>Pasta cocida (espagueti, fideo, etc.)</td><td>1/2 taza</td><td>50g</td></tr>
                    <tr><td>Pastas rellenas (ravioles)</td><td>6 piezas</td><td>25g</td></tr>
                    <tr><td>Papa horneadao hervida</td><td>1 pieza chica</td><td>100g</td></tr>
                    <tr><td>Puré de papa</td><td>1/2 taza</td><td>100g</td></tr>
                    <tr><td>Alubias, garbanzo, haba, lenteja, soja</td><td>1/2 taza</td><td>35g</td></tr>
                    </tbody>
                    </table>
                    </div>
                    </p>
                    
                    <p>Ocasionales:</p>
                    <p><div class='table-responsive fondotabla'>
                    <table class='table table-condensed'>
                    <thead><tr><th>Alimento</th><th>Cantidad</th></tr></thead>
                    <tbody>
                    <tr><td>Azúcar, mermelada o miel</td><td>1 cucharada</td></tr>
                    <tr><td>Chocolate</td><td>2 onzas</td></tr>
                    <tr><td>Magdalena</td><td>1/2 pieza</td></tr>
                    <tr><td>Croissant</td><td>3/4 pieza</td></tr>
                    </tbody>
                    </table>
                    </div>
                    </p>
                    
                    
                    
                    <div id="frutas"><h3 style="display:inline;;">Frutas</h3> <a style="cursor: pointer;" onClick="ir_a('#ancla');"> <span class="glyphicon glyphicon-menu-up"></span> Ir arriba</a></div>
                    <p><div class='table-responsive fondotabla'>
                    <table class='table table-condensed'>
                    <thead><tr><th>Alimento</th><th>Cantidad</th><th>Peso (crudo)</th></tr></thead>
                    <tbody>
                    <tr><td>Arándanos, frambuesas, grosellas, mora</td><td>1 Bol</td><td>150g</td></tr>
                    <tr><td>Aguacate</td><td>Media pieza</td><td>75g</td></tr>
                    <tr><td>Guayaba, lima, pomelo</td><td>1 Pieza grande</td><td>150g</td></tr>
                    <tr><td>Melón, sandía</td><td>1 Rodaja grande</td><td>150g</td></tr>
                    <tr><td>Fresas</td><td>6-8 unidades</td><td>100g</td></tr>
                    <tr><td>Fresones</td><td>3-4 unidades</td><td>100g</td></tr>
                    <tr><td>Albaricoques, ciruelas, mandarinas</td><td>2 Piezas</td><td>100g</td></tr>
                    <tr><td>Piña</td><td>2 Rodajas</td><td>100g</td></tr>
                    <tr><td>Manzana, pera, melocotón, naranja, papaya, kiwi, nectarina, granada, limón, maracuyá, membrillo</td><td>1 Pieza</td><td>100g</td></tr>
                    <tr><td>Zumo</td><td>Medio vaso </td><td>100ml</td></tr>
                    <tr><td>Higo, níspero</td><td>1 Pieza pequeña</td><td>50g</td></tr>
                    <tr><td>Plátano, chirimoya, caqui, tamarindo</td><td>Media pieza</td><td>50g</td></tr>
                    <tr><td>Mango</td><td>Un cuarto de  pieza</td><td>50g</td></tr>
                    <tr><td>Cerezas</td><td>6 unidades</td><td>50g</td></tr>
                    <tr><td>Uvas</td><td>8 unidades</td><td>50g</td></tr>
                    </tbody>
                    </table>
                    </div>
                    </p>
                    
                    
                    
                    <div id="grasas"><h3 style="display:inline;;">Grasas</h3> <a style="cursor: pointer;" onClick="ir_a('#ancla');"> <span class="glyphicon glyphicon-menu-up"></span> Ir arriba</a></div>
                    <p></p>
                    <p><div class='table-responsive fondotabla'>
                    <table class='table table-condensed'>
                    <thead><tr><th>Alimento</th><th>Cantidad</th><th>Peso (crudo)</th></tr></thead>
                    <tbody>
                    <tr><td>Aceite de oliva</td><td>1 Cucharada sopera</td><td>14g</td></tr>
                    <tr><td>Aceite de girasol</td><td>1 Cucharada sopera</td><td>14g</td></tr>
                    <tr><td>Aceitunas</td><td>Un puñado</td><td>40g</td></tr>
                    <tr><td>Mantequilla o margarina</td><td>1 Cucharada sopera</td><td>10g</td></tr>
                    <tr><td>Mayonesa</td><td>1 Cucharada sopera</td><td>110g</td></tr>
                    </tbody>
                    </table>
                    </div>
                    </p>
                    
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
