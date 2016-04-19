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
								if(data=="n")
								{
									$("#fallologin").html("El correo electrónico y/o contraseña son incorrectos.");
								}
								else
								{
									datos=JSON.parse(data);
									
									document.cookie="id="+datos[0].id;
									document.cookie="nombre="+datos[0].nombre;
									document.cookie="apellidos="+datos[0].apellidos;
									document.cookie="email="+datos[0].email;
									document.cookie="peso="+datos[0].peso;
									document.cookie="pesodeseable="+datos[0].pesodeseable;
									document.cookie="sexo="+datos[0].sexo;
									document.cookie="fechanac="+datos[0].fechanac;
									document.cookie="altura="+datos[0].altura;
									document.cookie="dieta="+datos[0].dieta;
									
									
									<?php /*?><?php $_SESSION["id"]=$_COOKIE["id"];
									 $_SESSION["nombre"]=$_COOKIE["nombre"];
									 $_SESSION["apellidos"]=$_COOKIE["apellidos"];
									 $_SESSION["email"]=$_COOKIE["email"];
									 $_SESSION["peso"]=$_COOKIE["peso"];
									 $_SESSION["pesodeseable"]=$_COOKIE["pesodeseable"];
									 $_SESSION["sexo"]=$_COOKIE["sexo"];
									 $_SESSION["fechanac"]=$_COOKIE["fechanac"];
									 $_SESSION["altura"]=$_COOKIE["altura"];
									 $_SESSION["dieta"]=$_COOKIE["dieta"];
									 ?><?php */?>
									
									location.href="configuradaplantilla.php";
								}
							});
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
                <form action="" method="post" >
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required maxlength="100" />
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required maxlength="30" onKeyUp="validaPassword();" />
                </div>
                <input type="button" value="Iniciar sesión" class="btn btn-default" onClick="clienteLogin();" /> o <a class="enlacenormal" href="registro.html">Registrar</a>
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
