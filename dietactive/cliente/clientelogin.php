<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Inicio de sesión - DietActive</title>


<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="estilos.css">
<script src="funciones.js"></script>
<script>
window.onload=function(){
	datosEmpresa();
}


</script>
</head>

<body>
    <div class="container-fluid">
        <div class="row cabecera">
            <div class="col-md-12">
                <h1>Zona Cliente</h1>
            </div>
        </div>
        <div class="row cuerpo">
        	<div class="col-md-4">
            </div>
            <div class="col-md-4">
            	<h3 class="datospers">Inicio de sesión</h3><!-- CONTENIDO DE LA WEB <a href="#" class="actualizar">[Actualizar]</a> -->
                <p id="contenidos">
                <form action="configuradaplantilla.php" method="post" onSubmit="return(clienteLogin())">
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required maxlength="100" />
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required maxlength="30" onKeyUp="validaPassword();" />
                </div>
                <input type="submit" value="Iniciar sesión" class="btn btn-default" /> o <a class="enlacenormal" href="registro.html">Registrar</a>
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
</body>
</html>