// JavaScript Document

//Registro

	function validaEmail()
	{
		var er_email =/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/;
		var texto=$("#email").val();
		if(er_email.test(texto))
		{
			$("#email2").html("");
			return true;
		}
		else
		{
			$("#email2").html("Correo electrónico no válido");
			return false;
		}
	}
	
	function compruebaEmail()
	{
		var email=$("#email").val();
		
		$.get("../servidor/comprueba_email.php?email="+email, function(data, status){
				if(data=="s")
				{
					$("#email2").html("Ese correo electrónico ya existe.");
					return false;
				}
				else
				{
					//$("#email2").html("");
					return true;
				}
				
			});
		//$("#email2").load("../servidor/comprueba_email.php?email="+email);
	}
	
	function validaPassword()
	{
		if($("#password").val()==$("#password2").val())
		{
			$("#compruebapassword").html("");
			return true;
		}
		else
		{
			$("#compruebapassword").html("Las contraseñas deben ser iguales");
			return false;
		}
	}
	
	function compruebaTodo()
	{
		if($("#email2").html()!="")
		{
			return false;
		}
		if(!validaPassword())
		{
			return false;
		}
	}
	
	function validaTelefono(e)
	{
		tecla = (document.all) ? e.keyCode : e.which; 
		if (tecla==8) return true;
		patron = /\d/;
		te = String.fromCharCode(tecla);
		return patron.test(te);
	}
	
	
	
	//Isnertar en la BBDD
	
	function insertarCliente()
	{
		if($("#nombre").val()=="")
		{
			$("#nombre").focus();
			$("#nombre2").html("Requerido");
			return false;
			
		}
		else
		{
			$("#nombre2").html("");
		}
		
		if($("#apellidos").val()=="")
		{
			$("#apellidos").focus();
			$("#apellidos2").html("Requerido");
			return false;
			
		}
		else
		{
			$("#apellidos2").html("");
		}
		
		if($("#telefono").val()=="")
		{
			$("#telefono").focus();
			$("#telefono2").html("Requerido");
			return false;
			
		}
		else
		{
			$("#telefono2").html("");
		}
		
		
		if($("#email").val()=="")
		{
			$("#email").focus();
			$("#email2").html("Requerido");
			return false;
			
		}
		else
		{
			$("#email2").html("");
		}
		
		if($("#email2").html()!="")
		{
			$("#email").focus();
			return false;
		}
		
		if($("#password").val()=="")
		{
			$("#password").focus();
			$("#errorpassword1").html("Requerido");
			return false;
			
		}
		else
		{
			$("#errorpassword1").html("");
		}
		
		if($("#password2").val()=="")
		{
			$("#password2").focus();
			$("#errorpassword2").html("Requerido");
			return false;
			
		}
		else
		{
			$("#errorpassword2").html("");
		}
		
		if(!validaPassword())
		{
			$("#password2").focus();
			return false;
		}
		
		if( !$("input[name='sexo']:radio").is(':checked'))
		{
			location.href = "#sexo";
			$("#sexo2").html("Requerido");
			return false;
		}
		else
		{
			$("#sexo2").html("");
		}
		
		
		if($("#peso").val()=="")
		{
			$("#peso").focus();
			$("#peso2").html("Requerido");
			return false;
			
		}
		else
		{
			$("#peso2").html("");
		}
		
		if($("#altura").val()=="")
		{
			$("#altura").focus();
			$("#altura2").html("Requerido");
			return false;
			
		}
		else
		{
			$("#altura2").html("");
		}
		
		if($("#fechanac").val()=="")
		{
			$("#fechanc").focus();
			$("#fechanac2").html("Requerido");
			return false;
			
		}
		else
		{
			$("#fechanac2").html("");
		}
		
		var checkbox="";
		$("input:checkbox:checked").each(function(){
		//cada elemento seleccionado
		checkbox+=$(this).val()+",";
	});
	checkbox=checkbox.substring(0,checkbox.length-1);
	
		if(checkbox=="")
		{
			checkbox=="ninguna";
		}
		
		$.post("../servidor/registrar.php",{
			password: $("#password").val(),
			nombre: $("#nombre").val(), 
			apellidos: $("#apellidos").val(),
			telefono: $("#telefono").val(),
			email: $("#email").val(),
			sexo: $("input:radio[name=sexo]:checked").val(),
			peso: $("#peso").val(),
			altura: $("#altura").val(),
			fechanac: $("#fechanac").val(),
			actividadf: $("#actividadf").val(),
			patologias: checkbox
							},
							function(datos, estado)
							{
								if(datos=='s')
								{
									$("#contenido").html("Se ha enviado un e-mail a tu correo electrónico para activar la cuenta. Verifica tu bandeja de entrada y tu carpeta de spam.");
									
								}
								else
								{
									$("#contenido").html("Ha ocurrido un error durante el registro. Intentalo de nuevo más tarde.");
								}
							});
	}
	
	
	
	function controlaSexoEmbarazo()
	{
		if($("input:radio[name=sexo]:checked").val()=="m")
		{
			$("#embarazo").attr("disabled",false);
		}
		else
		{
			$("#embarazo").attr("checked",false);
			$("#embarazo").attr("disabled",true);
		}
	}
	
	function cargarActividadFisica()
	{
    	$.get("../servidor/consulta_actividadf.php", function(data, status){
				var objeto = JSON.parse(data);
				var texto="<select class='form-control' name='actividadf' id='actividadf'>";
				for(var i=0;i<objeto.length;i++)
				{
					texto+="<option value='"+objeto[i].id+"'>"+objeto[i].nombre+"</option>";
				}
				texto+="</select>";
				$("#opciones").html(texto);
			});
	}
	function cargarPatologias()
	{
		$.get("../servidor/consulta_patologia.php", function(data, status){
				var objeto = JSON.parse(data);
				var texto="<div class='table-responsive'><table class='table'><tbody><tr>";
				for(var i=1;i<objeto.length;i++)
				{
					texto+="<td><label><input type='checkbox' name='"+objeto[i].nombre+"' value='"+objeto[i].id+"' /> "+objeto[i].nombre+"</label></td>";
					if(i%3==0)
					{
						texto+="</tr><tr>";
					}
				}
				texto+="</tr></tbdody></table></div>";
				$("#patologias").html(texto);
			});
	}
	
	//Calendario de edad
	function cargarCalendario()
	{
		$(function () {
			var ano = (new Date).getFullYear();
			$.datepicker.setDefaults($.datepicker.regional["es"]);
			$(".fechanac").datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: "1900:"+ano
			});
		});
		
		$.datepicker.regional['es'] = {
			closeText: 'Cerrar',
			prevText: '<Ant',
			nextText: 'Sig>',
			currentText: 'Hoy',
			monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			monthNamesShort: ['Enero','Febrero','Marzo','Abril', 'Mayo','Junio','Julio','Agosto','Septiembre', 'Octubre','Noviembre','Diciembre'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
			dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
			weekHeader: 'Sm',
			dateFormat: 'yy/mm/dd',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: ''
		};
		
		$.datepicker.setDefaults($.datepicker.regional['es']);
		
		$(function () {
			$(".fechanac").datepicker();
		});
	}
	//FIN Calendario de edad
//Fin Registro

//Login
function clienteLogin()
{
	var email=$("#email").val();
	var password=$("#password").val();
	
	$.post("../servidor/clientelogin.php",{
			password: $("#password").val(),
			email: $("#email").val()
							},
							function(datos, estado)
							{
								if(datos=="s")
								{
									return true;
								}
								else
								{
									$("#fallologin").html("El correo electrónico y/o contraseña son incorrectos.");
									return false;
								}
							});
}
//Fin Login

//Plantilla
function datosEmpresa()
{
	$.get("../servidor/consulta_datosempresa.php", function(data, status){
				var objeto = JSON.parse(data);
				$("#dietnombre").html(objeto[0].nombre);
				
				$("#dietfijo1").attr("href","tel:"+objeto[0].telefono1);
				$("#dietfijo2").html(objeto[0].telefono1);
				
				$("#dietmovil1").attr("href","tel:"+objeto[0].telefono2);
				$("#dietmovil2").html(objeto[0].telefono2);
				
				$("#dietdireccion").html(objeto[0].direccion);
				$("#dietdirecciondatos").html(objeto[0].provincia+", "+objeto[0].localidad+" "+objeto[0].codigopostal);
				$("#dietemail").html(objeto[0].email);
				$("#dietdesarrollado").html(objeto[0].desarrollado);
			});
}

//FIN Plantilla