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
				var texto="<div class='row'>";
				for(var i=1;i<objeto.length;i++)
				{
					texto+="<div class='col-sm-3'><label><input type='checkbox' name='"+objeto[i].nombre+"' value='"+objeto[i].id+"' /> "+objeto[i].nombre+"</label></div>";
					if(i%3==0)
					{
						texto+="</div><div class='row'>";
					}
				}
				texto+="</div>";
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

//Fin Login

function cargarIntercambios(idcliente)
{
	$.post("../servidor/consulta_intercambios.php",{
			idcliente: idcliente
							},
							function(data, estado)
							{
								if(data!="")
								{
									var datos=JSON.parse(data);
									
									
									//grupo 1 = lacteos
									var lacteodesayuno;
									var lacteomerienda;
									
									//grupo 2 = proteinas
									var proteinadesayuno;
									var proteinaalmuerzo;
									var proteinamerienda;
									var proteinacena;
									
									//grupo 3 = verduras
									var verduraalmuerzo;
									var verduracena;
									
									//grupo 4 = hidratos de carbono
									var hdcdesayuno;
									var hdcalmuerzo;
									var hdcmerienda;
									var hdccena;
									
									//grupo 5 = frutas
									var frutadesayuno;
									var frutaalmuerzo;
									var frutacena;
									
									//grupo 6 = grasas
									var grasasdesayuno;
									var grasasalmuerzo;
									var grasasmerienda;
									var grasascena;
									
									for(var i=0;i<datos.length;i++)
									{
										var valor=parseFloat(datos[i].valor);
										//alert(valor*0.5);
										switch(parseInt(datos[i].idgrupo))
										{
											case 1:
											{
												lacteodesayuno=redondeo(valor*0.50);
												lacteomerienda=redondeo(valor*0.50);
												break;
											}
											
											case 2:
											{
												proteinadesayuno=redondeo(valor*0.15);
												proteinaalmuerzo=redondeo(valor*0.40);
												proteinamerienda=redondeo(valor*0.15);
												proteinacena=redondeo(valor*0.30);
												break;
											}
											
											case 3:
											{
												verduraalmuerzo=redondeo(valor*0.50);
												verduracena=redondeo(valor*0.50);
												break;
											}
											
											case 4:
											{
												hdcdesayuno=redondeo(valor*0.15);
												hdcalmuerzo=redondeo(valor*0.35);
												hdcmerienda=redondeo(valor*0.15);
												hdccena=redondeo(valor*0.35);
												break;
											}
											
											case 5:
											{
												frutadesayuno=redondeo(valor*0.33);
												frutaalmuerzo=redondeo(valor*0.33);
												frutacena=redondeo(valor*0.33);
												break;
											}
											
											case 6:
											{
												grasasdesayuno=redondeo(valor*0.10);
												grasasalmuerzo=redondeo(valor*0.40);
												grasasmerienda=redondeo(valor*0.10);
												grasascena=redondeo(valor*0.40);
												break;
											}
											
										}
									}
									var tabla="<div class='table-responsive'><table class='table table-condensed'>";
									tabla+="<tr><thead><td></td><th>Lácteos</th><th>Proteínas</th><th>Verduras</th><th>Hidratos de Carbono</th><th>Frutas</th><th>Grasas</th></thead></tr><tbody>";
									tabla+="<tr class='tablanum'><td class='titulo'><b>Desayuno</b></td><td>"+lacteodesayuno+"</td><td>"+proteinadesayuno+"</td><td> </td><td>"+hdcdesayuno+"</td><td>"+frutadesayuno+"</td><td>"+grasasdesayuno+"</td></tr>";
									tabla+="<tr class='tablanum'><td class='titulo'><b>Almuerzo</b></td><td> </td><td>"+proteinaalmuerzo+"</td><td>"+verduraalmuerzo+"</td><td>"+hdcalmuerzo+"</td><td>"+frutaalmuerzo+"</td><td>"+grasasalmuerzo+"</td></tr>";
									tabla+="<tr class='tablanum'><td class='titulo'><b>Merienda</b></td><td>"+lacteomerienda+" </td><td> "+proteinamerienda+" </td><td> </td><td>"+hdcmerienda+"</td><td>  </td><td>"+grasasmerienda+"</td></tr>";
									tabla+="<tr class='tablanum'><td class='titulo'><b>Cena</b></td><td> </td><td>"+proteinacena+" </td><td>"+verduracena+" </td><td>"+hdccena+"</td><td>"+frutacena+"</td><td>"+grasascena+"</td></tr>";
									tabla+="</tbody></table></div>";
									$("#intercambios").html(tabla);
								}
								else
								{
									$("#contenido").html("No se han podido cargar tus intercambios.");
								}
							});
}

function redondeo(alimento)
{
	if(alimento-Math.floor(alimento)<0.25)
	{
		alimento=Math.floor(alimento);
	}
	else
	{
		if(alimento-Math.floor(alimento)>=0.25 && alimento-Math.floor(alimento)<0.75)
		{
			alimento=Math.floor(alimento)+0.5;
		}
		else
		{
			if(alimento-Math.floor(alimento)>=0.75)
			{
				alimento=Math.floor(alimento)+1;
			}
		}
	}
	return alimento;
}

function poneFecha(cadena)
{
	var fecha = new Date(cadena);
	return fecha.toLocaleDateString();
}

function graficaPeso(idcliente)
{
	var fechas=[];
	var pesos=[];
	$.post("../servidor/consulta_peso.php",{
			idcliente: idcliente
							},
							function(data, estado)
							{
								
								datos=JSON.parse(data);
								for(var i=0;i<datos.length;i++)
								{
									var fechahora=(datos[i].fecha).split(" ");
																		
									fechas.push(poneFecha(fechahora[0]));
									
									pesos.push(parseFloat(datos[i].peso));
								}
								fechas.reverse();
								pesos.reverse();
								$("#grafica").highcharts(
								{
									chart: {
										type: 'line',
										backgroundColor: '#d3d1ce'
									},
									title: {
										text: 'Historial'
									},
									xAxis: {
										categories: fechas
									},
									yAxis: {
										gridLineColor: '#777674',
										title: {
											text: 'Peso (Kg.)'
										}
									},
									plotOptions: {
										line: {
											dataLabels: {
												enabled: true
											},
											enableMouseTracking: false
										}
									},
									series: [{
										name: 'Peso',
										data: pesos
									}]
								});
						});
};


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