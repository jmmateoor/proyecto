// JavaScript Document
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
		if($("#email2").html()!="")
		{
			$("#email").focus();
			return false;
		}
		if(!validaPassword())
		{
			$("#password2").focus();
			return false;
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
				var texto="<table class='table'><tbody><tr>";
				for(var i=1;i<objeto.length;i++)
				{
					texto+="<td><label><input type='checkbox' name='"+objeto[i].nombre+"' value='"+objeto[i].id+"' /> "+objeto[i].nombre+"</label></td>";
					if(i%3==0)
					{
						texto+="</tr><tr>";
					}
				}
				texto+="</tr></table>";
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