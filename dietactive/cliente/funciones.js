// JavaScript Document

//Citas
function eliminarCita(iddietista)
{
	if(confirm("¿Deseas borrar tu cita?"))
	{
		diaarray=$("#dia").html().split("/");
		dia=diaarray[2]+"-"+diaarray[1]+"-"+diaarray[0];
		var codigocita= dia+" "+$("#hora").html();
		$.post("../servidor/borrar_cita.php",{
							cita: codigocita,
							dietista: iddietista
									},
									function(data, estado)
									{
										if(data=="s")
										{
											consultaCitaAsignada();
										}
										else
										{
											alert("Ha ocurrido un error. Intentalo de nuevo más tarde.");
										}
									});
	}
}

function poneFechaBonita(f)
{
	
	var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
	var f=new Date(f);
	salida=diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
	
	return salida;
}

function consultaCitaAsignada()
{
	
	$.post("../servidor/consulta_cita_asignada.php",
							function(data, estado)
							{
								if(data==']')
								{
									consultaDietistas();
									//mostrarConsultasDisponibles();
									
								}
								else
								{
									datos=JSON.parse(data);
									
									var dia=poneFecha((datos[0].cita.split(" "))[0]);
									
									var hora=(datos[0].cita.split(" "))[1];
									var iddietista=datos[0].iddietista;
									var tipocita=datos[0].tipocita;
									var dietista=datos[0].nombredietista + " " + datos[0].apellidosdietista;
									
									
									var texto="<div class='panel panel-primary'><div class='panel-heading'>Tu Cita</div><div class='panel-body'><b>Fecha:</b> <span id='dia'>"+dia+"</span><br/><hr/><b>Hora:</b> <span id='hora'>"+hora+"</span><br/><hr/><b>Tipo de cita:</b> "+tipocita+"<br/><hr/><b>Especialista:</b> "+ dietista+"</div><div class='panel-footer'><p align='right'><button class='btn btn-danger' onClick='eliminarCita("+iddietista+");'><span class='glyphicon glyphicon-remove'></span> Eliminar cita</button></p></div></div></div>";
									$("#contenidocitas").html(texto);
								}
							});
}

var citasdisponibles;

function mostrarConsultasDisponibles()
{
	$.get("../servidor/consultar_citas_disponibles.php",function(data, status)
		{		
			if(status=="success")
			{
				citasdisponibles=JSON.parse(data);
			}
		});
}

var dietistas=[];

function cargarDias(iddietista)
{
	if(iddietista==0)
	{
		$('#dia')
			.find('option')
			.remove()
			.end();
		var selectdia=document.getElementById("dia");
		var option=document.createElement("option"); 
			option.value=0;
			option.text="-- Selecciona --";
			selectdia.appendChild(option);
		$('#hora')
			.find('option')
			.remove()
			.end();
		var selectdia=document.getElementById("hora");
		var option=document.createElement("option"); 
			option.value=0;
			option.text="-- Selecciona --";
			selectdia.appendChild(option);
	}
	else
	{
		$.post("../servidor/consulta_dias.php",{
			iddietista: iddietista
					},
					function(data, estado)
					{
						
						data = data.replace(/\\n/g, "\\n")  
								   .replace(/\\'/g, "\\'")
								   .replace(/\\"/g, '\\"')
								   .replace(/\\&/g, "\\&")
								   .replace(/\\r/g, "\\r")
								   .replace(/\\t/g, "\\t")
								   .replace(/\\b/g, "\\b")
								   .replace(/\\f/g, "\\f");
						// remove non-printable and other non-valid JSON chars
						data = data.replace(/[\u0000-\u0019]+/g,"");
						data=data.replace(/[\u200B-\u200D\uFEFF]/g, '');
						datos=JSON.parse((data.toString()));
						
						$('#hora')
							.find('option')
							.remove()
							.end();
						var selectdia=document.getElementById("hora");
						var option=document.createElement("option"); 
							option.value=0;
							option.text="-- Selecciona --";
							selectdia.appendChild(option);
						
						var diaaux=poneFecha((datos[0].fechahora.split(" "))[0]);
						
						$('#dia')
							.find('option')
							.remove()
							.end();
						var selectdia=document.getElementById("dia");
						var option=document.createElement("option"); 
							option.value=0;
							option.text="-- Selecciona --";
							selectdia.appendChild(option);
							
						var option=document.createElement("option"); 
							option.value=(datos[0].fechahora.split(" "))[0];
							option.text=poneFechaBonita((datos[0].fechahora.split(" "))[0]);
							selectdia.appendChild(option);
							
							
						
						for(var i=0;i<datos.length;i++)
						{
							if(datos[i].id==iddietista)
							{
								var dia=poneFecha((datos[i].fechahora.split(" "))[0]);
								var hora=(datos[i].fechahora.split(" "))[1];
								
								
								if(dia!=diaaux)
								{
									diaaux=dia;
									var option=document.createElement("option"); 
									option.value=(datos[i].fechahora.split(" "))[0];
									option.text=poneFechaBonita((datos[i].fechahora.split(" "))[0]); 
									selectdia.appendChild(option);
								}
								
								
								//salida+="<option value='"+datos[i].id+"'>"+datos[i].alimento+"</option>";
							
							}
						}
						$("#dia").attr("onChange","cargarHoras("+iddietista+",this.value);");
					});
	}
}

function cargarHoras(iddietista,diaseleccionado)
{
	if(iddietista==0 || diaseleccionado==0)
	{
		$('#hora')
			.find('option')
			.remove()
			.end();
		var selectdia=document.getElementById("hora");
		var option=document.createElement("option"); 
			option.value=0;
			option.text="-- Selecciona --";
			selectdia.appendChild(option);
	}
	else
	{
		$.post("../servidor/consulta_dias.php",{
			iddietista: iddietista
					},
					function(data, estado)
					{
						data = data.replace(/\\n/g, "\\n")  
								   .replace(/\\'/g, "\\'")
								   .replace(/\\"/g, '\\"')
								   .replace(/\\&/g, "\\&")
								   .replace(/\\r/g, "\\r")
								   .replace(/\\t/g, "\\t")
								   .replace(/\\b/g, "\\b")
								   .replace(/\\f/g, "\\f");
						// remove non-printable and other non-valid JSON chars
						data = data.replace(/[\u0000-\u0019]+/g,"");
						data=data.replace(/[\u200B-\u200D\uFEFF]/g, '');
						datos=JSON.parse(data);
						$('#hora')
							.find('option')
							.remove()
							.end();
						var selectdia=document.getElementById("hora");
						var option=document.createElement("option"); 
							option.value=0;
							option.text="-- Selecciona --";
							selectdia.appendChild(option);
							
							
						
						for(var i=0;i<datos.length;i++)
						{
							var dia=(datos[i].fechahora.split(" "))[0];
							var hora=(datos[i].fechahora.split(" "))[1];
							
							
							if(datos[i].id==iddietista && dia==diaseleccionado)
							{
									
									var option=document.createElement("option"); 
									option.value=hora;
									option.text=hora; 
									selectdia.appendChild(option);
								
								
								//salida+="<option value='"+datos[i].id+"'>"+datos[i].alimento+"</option>";
							
							}
						}
						//$("#dia").attr("onChange","cargarHoras("+iddietista+",this.value);");
					});
	}
}

function consultaDietistas()
{
	
	$.get("../servidor/consulta_dietistas.php",function(data, status)
		{		
			if(status=="success")
			{
				dietistas=JSON.parse(data);
				
				var salida="<h3>Solicita tu cita</h3><div class='form-group'><label for='dietista'>Especialista</label><select class='form-control' id='dietista' name='dietista' onChange='cargarDias(this.value)'><option value='0'>-- Selecciona --</option>";
				
				for(var i=0;i<dietistas.length;i++)
				{
					salida+="<option value='"+dietistas[i].id+"'>"+dietistas[i].nombre+"</option>";
				}
				salida+="</select></div><div class='form-group'><label for='dia'>Día</label><select class='form-control' id='dia' name='dia' ><option value='0'>-- Selecciona --</option></select></div><div class='form-group'><label for='hora'>Hora</label><select class='form-control' id='hora' name='hora' ><option value='0'>-- Selecciona --</option></select></div><div class='form-group'><label for='tipo'>Tipo de cita</label><select class='form-control' id='tipo' name='tipo' ><option value='Presencial'>Presencial</option><option value='Skype'>Skype</option></select></div><button class='btn btn-success' onClick='asignarCita();'>Aceptar</button>";
				$("#contenidocitas").html(salida);
			}
		});
}

function asignarCita()
{
	if($("#dietista").val()!=0)
	{
		if($("#dia").val()!=0)
		{
			if($("#hora").val()!=0)
			{
				$.post("../servidor/asignar_cita.php",{
						cita: $("#dia").val()+" "+$("#hora").val(),
						dietista: $("#dietista").val(),
						tipo: $("#tipo").val()
								},
								function(data, estado)
								{
									if(data=="s")
									{
										consultaCitaAsignada();
									}
									else
									{
										alert("Ha ocurrido un error. Intentalo de nuevo más tarde.");
									}
								});
			}
			else
			{
				alert("Por favor, elige una hora.");
			}
		}
		else
		{
			alert("Por favor, elige un día.");
		}
	}
	else
	{
		alert("Por favor, selecciona a un especialista.");
	}
}


function mostrarConsultasDisponibles1()
{
	$.get("../servidor/consultar_citas_disponibles.php",function(data, status)
		{		
			if(status=="success")
			{
				citasdisponibles=JSON.parse(data);
				var diaaux=poneFecha((citasdisponibles[0].fechahora.split(" "))[0]);
				var salida="<h2>Citas disponibles</h2>";
				
				//salida+="<div class='col-lg-6'><h3>Citas para el día "+diaaux+"</h3>";
				
				for(var i=0;i<citasdisponibles.length;i++)
				{
					var dia=poneFecha((citasdisponibles[i].fechahora.split(" "))[0]);
					var hora=(citasdisponibles[i].fechahora.split(" "))[1];
					
					
					/*if(dia!=diaaux)
					{
						diaaux=dia;
						salida+="</div><div class='col-lg-6'><h3>Citas para el día "+diaaux+"</h3>";
					}*/
					
					
					for(var j=0;j<dietistas.length;j++)
					{
						if(dietistas[j].id==datos[i].id)
						{
							var nombre=dietistas[j].nombre;
						}
					}
					
					salida+="<button style='text-align:left; width:100%; margin-top:3px;' class='btn btn-default'><div class='col-md-3'><b>Día:</b> "+dia+"</div><div class='col-md-3'><b>Hora:</b> "+hora+"</div><div class='col-md-6'><b>Especialista:</b> "+nombre+"</div></button><br/>";
				}
				salida+="</div>";
				//$("#contenidocitas").html(salida);
			}
		});
}
//Fin Citas

//test
function cancelarTest(dia,momento)
{
	if(confirm("Vas a cancelar el test. Todos los datos se perderán. ¿Quieres continuar?"))
	{
		$("#"+momento).html("");
		$.post("../servidor/borrar_test.php",{
			dia: dia,
			momento: momento
					},
					function(data, estado)
					{
						if(data=="s")
						{
							var boton="boton"+momento;
							var aceptar="aceptar"+momento;
							
							$("#"+boton).html("");
							$("#"+aceptar).html("");
							cargarTestAntiguo(dia,momento);
						}
						else
						{
							alert("Ha ocurrido un error. Intentalo de nuevo más tarde.");
						}
					});
	}
}


function empezarTest(dia,momento)
{
	if(confirm("Vas a empezar el test. Los antiguos datos se borraran. ¿Quieres continuar?"))
	{
		$("#"+momento).html("");
		$.post("../servidor/borrar_test.php",{
			dia: dia,
			momento: momento
					},
					function(data, estado)
					{
						if(data=="s")
						{
							var boton="boton"+momento;
							var aceptar="aceptar"+momento;
							
							$("#"+boton).html("<input type='button' class='btn btn-info alimentostest' value='Agregar alimento' onClick='cargarTiposAlimentos(\""+momento+"\");' />");
							$("#"+aceptar).html("<input class='btn btn-success' type='button' value='Aceptar' onClick='recorrerTest("+dia+",\""+momento+"\");' /> <input class='btn btn-warning' type='button' value='Cancelar' onClick='cancelarTest("+dia+",\""+momento+"\");' />");
						}
						else
						{
							alert("Ha ocurrido un error. Intentalo de nuevo más tarde.");
						}
					});
	}
}






var removeButton = $("<input type=\"button\" class=\"remove\" value=\"-\" />");
        removeButton.click(function() {
            $(this).parent().remove();
        });

var tipo=-1;

function cargarTiposAlimentos(momento)
{
	tipo++;
	$.get("../servidor/consulta_tipos_alimentos.php",function(data, status)
		{		
			if(status=="success")
			{
				
				datos=JSON.parse(data);
				var salida="<div id='d"+tipo+"' class='alimentostest'><select class='form-control selecttest' id='"+tipo+"' name='"+tipo+"' onChange='cargarAlimentos(this.value, this.id)'><option value='0'>-- Selecciona --</option>";
				
				for(var i=0;i<datos.length;i++)
				{
					salida+="<option value='"+datos[i].id+"'>"+datos[i].nombre+"</option>";
				}
				salida+="</select> <select class='form-control selecttest' id='"+tipo+"a' name='"+tipo+"a' ><option value='0'>-- Selecciona --</option></select> <input type='number' id='"+tipo+"b' min='0' step='0.01' class='form-control numerotest' onpaste='return false;' /> <input type='button' class='btn btn-danger btn-sm' onClick='borrarCampos("+tipo+",\""+momento+"\");' value='X' /></div>";
				
				$("#"+momento).append(salida);
				
			}
		});
}

function cargarAlimentos(idtipoalimento, idselect)
{
	$.post("../servidor/consulta_alimentos.php",{idtipoalimento:idtipoalimento},function(data, status, xhr)
	{	
		//var salida="";
		var datos=JSON.parse(data);
		
		var nombre=idselect+"a";
		var selectalimentos=document.getElementById(nombre);
		
		$('#'+nombre)
    	.find('option')
    	.remove()
    	.end();
		
		var option=document.createElement("option"); 
			option.value=0;
			option.text="-- Selecciona --"; 
			selectalimentos.appendChild(option);
		
		for(var i=0;i<datos.length;i++)
		{
			var option=document.createElement("option"); 
			option.value=datos[i].id;
			option.text=datos[i].alimento; 
			selectalimentos.appendChild(option);
			//salida+="<option value='"+datos[i].id+"'>"+datos[i].alimento+"</option>";
		}
	});
}

function insertarCampos()
{
	tipo++;
	$("#test").html($("#test").html()+"<br/><span='stipo"+tipo+"'></span>");
	cargarTiposAlimentos();
}

function borrarCampos(campo,momento)
{
	var parent = document.getElementById(momento);
	var child = document.getElementById("d"+campo);
	parent.removeChild(child);
}

var alimentos=[];
var cantidad=[];
var validado=true;
var listaobjetos=[];

function recorrerTest(dia,momento)
{
	alimentos=[];
	cantidad=[];
	validado=true;
	var x = document.getElementById(momento).getElementsByTagName("div");
	if(x.length>0)
	{
		for(var i=0;i<x.length;i++)
		{
			if(x[i].getElementsByTagName("select")[1].value==0 || x[i].getElementsByTagName("input")[0].value=="")
			{
				validado=false;
			}
		}
		
		if(validado)
		{
			for(var i=0;i<x.length;i++)
			{
				alimentos.push(x[i].getElementsByTagName("select")[1].value);
				cantidad.push(x[i].getElementsByTagName("input")[0].value);
			}
			$.post("../servidor/insertar_test.php",{
				dia: dia,
				momento: momento,
				alimentos: alimentos,
				cantidad: cantidad
								},
								function(datos, estado)
								{
									if(datos=="s")
									{
										var boton="boton"+momento;
										var aceptar="aceptar"+momento;
										$("#"+boton).html("");
										$("#"+aceptar).html("");
										
										cargarTestAntiguo(dia,momento);
									}
								});
			
			
		}
		else
		{
			alert("Faltan campos por rellenar");
		}
	}
	else
	{
		alert("No has añadido ningún alimento");
	}
}

function cargarTestAntiguo(dia, momento)
{
	$.post("../servidor/consulta_test.php",{
			dia: dia,
			momento: momento
					},
					function(data, estado)
					{
						if(data=="]")
						{
							$("#"+momento).html("No has hecho este test todavía.");
						}
						else
						{
							datos=JSON.parse(data);
							
							var salida="";
							for(var i=0;i<datos.length;i++)
							{
								salida+="<div class='row'><div class='col-xs-5'>"+datos[i].alimento+"</div><div class='col-xs-4'>"+datos[i].cantidad+" gr.</div></div>";
								//salida+="<div class='row'><div class='col-xs-5 '></div><div class='col-xs-3'></div><div class='col-xs-4'></div></div>";
								if(i!=datos.length-1)
								{
									salida+="<hr />";
								}
							}
							
							$("#"+momento).html(salida);
						}
					});
}


//Fin test




var patologiascliente = [];

function actualizaPassword()
{
	//password
	$.post("../servidor/actualiza_password.php",{
			password: $("#password").val()
							},
							function(datos, estado)
							{
								if(datos=='s')
								{
									borrarPass();
									alert("Contraseña actualizada correctamente.");
								}
								else
								{
									alert("Ha ocurrido un error. Intentalo de nuevo más tarde.");
								}
							});
}


function activaBotonPass()
{
	if($("#errorpassword1").html()=="" && $("#errorpassword2").html()=="" && $("#compruebapassword").html()=="" && $("#password").val()!="" && $("#password2").val()!="")
	{
		$("#buttomPass").attr("disabled",false);
	}
	else
	{
		$("#buttomPass").attr("disabled",true);
	}
}

function borrarPass()
{
	$("#password").val("");
	$("#password2").val("");
	$("#errorpassword1").html("");
	$("#errorpassword2").html("");
	$("#compruebapassword").html("");
	$("#buttomPass").attr("disabled",true);
}

function compruebaMensajeEmail()
{
	if($("#mensajeEmail").val()=="")
	{
		$("#mensajeEmail2").html("No puede estar vacío");
		$("#buttommensajeEmail").attr("disabled",true);
	}
	else
	{
		$("#mensajeEmail2").html("");
		$("#buttommensajeEmail").attr("disabled",false);
	}
}


function enviarEmail(nombre, apellidos, email)
{
	mensaje=$("#mensajeEmail").val();
	$.post("../servidor/enviar_email.php",{
			nombre: nombre,
			apellidos: apellidos,
			email: email,
			mensaje: mensaje
							},
							function(datos, estado)
							{
								if(datos=='s')
								{
									$("#mensajeEmail").val("");
								}
								else
								{
									alert("No se ha enviar la consulta. Intentalo de nuevo más tarde");
								}
							});
}


//Actualizar
function actualizaActividad(id)
{
	$.post("../servidor/actualiza_actividadf.php",{
			idactividad: $("#actividadf").val()
							},
							function(datos, estado)
							{
								datos = datos.replace(/\\n/g, "\\n")  
								   .replace(/\\'/g, "\\'")
								   .replace(/\\"/g, '\\"')
								   .replace(/\\&/g, "\\&")
								   .replace(/\\r/g, "\\r")
								   .replace(/\\t/g, "\\t")
								   .replace(/\\b/g, "\\b")
								   .replace(/\\f/g, "\\f");
								// remove non-printable and other non-valid JSON chars
								datos = datos.replace(/[\u0000-\u0019]+/g,"");
								datos=datos.replace(/[\u200B-\u200D\uFEFF]/g, '');
								if(datos=='s')
								{
									$("#intercambios").addClass("efecto");
									variable = setTimeout(efecto,2100,"intercambios");
									
									
									$("#actf").css("border-radius","6px");
									$("#actf").addClass("efecto");
									variable5 = setTimeout(efecto,2100,"actf");
									
									cargaActividadCliente();
									cargarIntercambios(id);
									cargaGeet();
								}
								else
								{
									alert("Ha ocurrido un error. Intentalo de nuevo más tarde.");
								}
							});
}

function muestraTodasPatologiasAct(sexo)
{
	$.get("../servidor/consulta_patologia.php", function(data, status){
				var objeto = JSON.parse(data);
				var texto="<div class='row'>";
				
				if(sexo=="h")
				{
					var valor=1;
				}
				else
				{
					var valor=0;
				}
				
				for(i=valor;i<objeto.length;i++)
				{
					if(patologiascliente.indexOf(objeto[i].id)>-1)
					{
						
						texto+="<div class='col-sm-4'><label><input type='checkbox' name='"+objeto[i].nombre+"' value='"+objeto[i].id+"' checked /> "+objeto[i].nombre+"</label></div>";
					}
					else
					{
						
						texto+="<div class='col-sm-4'><label><input type='checkbox' name='"+objeto[i].nombre+"' value='"+objeto[i].id+"' /> "+objeto[i].nombre+"</label></div>";
					}
					if(i%3==0 && i!=0)
					{
						texto+="</div><div class='row'>";
					}
				}
				texto+="</div>";
				$("#patologias2").html(texto);
			});
}

function actualizarPatologias(id)
{
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
	
	$.post("../servidor/actualiza_patologias.php",{
			patologias: checkbox
							},
							function(datos, estado)
							{
								if(datos=='s')
								{
									$("#patologias").css("border-radius","6px");
									$("#patologias").addClass("efecto");
									variable = setTimeout(efecto,2100,"patologias");
									cargaPatologiasCliente(id);
								}
								else
								{
									alert("No se ha podido actualizar. Intentalo de nuevo más tarde");
								}
							});
}

function actualizarTelefono(id)
{
	$.post("../servidor/actualiza_telefono.php",{
			acttelefono: $("#acttelefono").val()
							},
							function(datos, estado)
							{
								if(datos=='s')
								{
									cargaTelefono();
									$("#acttelefono").val("");
									$("#buttomacttelefono").attr("disabled",true);
								}
								else
								{
									alert("Ha ocurrido un error. Intentalo de nuevo más tarde.");
								}
							});
}

function cargaTelefono()
{
	$.get("../servidor/consulta_telefono.php", function(data, status){
				var objeto = JSON.parse(data);
				$("#telefono").css("border-radius","6px");
				$("#telefono").addClass("efecto");
				variable = setTimeout(efecto,2100,"telefono");
				$("#telefono").html(objeto[0].telefono);
			});
}

function efecto(id)
{
	$("#"+id).removeClass("efecto");
}

function actCompruebaTelefono()
{
	if($("#acttelefono").val()=="")
	{
		$("#acttelefono2").html("No puede estar vacío");
		$("#buttomacttelefono").attr("disabled",true);
	}
	else
	{
		if($("#acttelefono").val().length==9)
		{
			$("#acttelefono2").html("");
			$("#buttomacttelefono").attr("disabled",false);
		}
		else
		{
			$("#acttelefono2").html("Debe contener 9 dígitos.");
			$("#buttomacttelefono").attr("disabled",true);
		}
	}
}


function cargaCp()
{
	$.get("../servidor/consulta_cp.php", function(data, status){
				var objeto = JSON.parse(data);
				$("#cp").css("border-radius","6px");
				$("#cp").addClass("efecto");
				variable = setTimeout(efecto,2100,"telefono");
				$("#cp").html(objeto[0].cp);
			});
}



function actualizarCp(id)
{
	$.post("../servidor/actualiza_cp.php",{
			actcp: $("#actcp").val()
							},
							function(datos, estado)
							{
								if(datos=='s')
								{
									cargaCp();
									$("#actcp").val("");
									$("#buttomactcp").attr("disabled",true);
								}
								else
								{
									alert("Ha ocurrido un error. Intentalo de nuevo más tarde.");
								}
							});
}



function actCompruebaCp()
{
	if($("#actcp").val()=="")
	{
		$("#actcp2").html("No puede estar vacío");
		$("#buttomactcp").attr("disabled",true);
	}
	else
	{
		if($("#actcp").val().length==5)
		{
			$("#actcp2").html("");
			$("#buttomactcp").attr("disabled",false);
		}
		else
		{
			$("#actcp2").html("Debe contener 5 dígitos.");
			$("#buttomactcp").attr("disabled",true);
		}
	}
}

function actualizarAltura(id)
{
	$.post("../servidor/actualiza_altura.php",{
			actaltura: $("#actaltura").val()
							},
							function(datos, estado)
							{
								datos = datos.replace(/\\n/g, "\\n")  
								   .replace(/\\'/g, "\\'")
								   .replace(/\\"/g, '\\"')
								   .replace(/\\&/g, "\\&")
								   .replace(/\\r/g, "\\r")
								   .replace(/\\t/g, "\\t")
								   .replace(/\\b/g, "\\b")
								   .replace(/\\f/g, "\\f");
								// remove non-printable and other non-valid JSON chars
								datos = datos.replace(/[\u0000-\u0019]+/g,"");
								datos=datos.replace(/[\u200B-\u200D\uFEFF]/g, '');
								if(datos=='s')
								{
									
									$("#intercambios").addClass("efecto");
									variable = setTimeout(efecto,2100,"intercambios");
									cargarIntercambios(id);
									cargaAlturaPesoDes();
									$("#actaltura").val("");
									$("#buttomactaltura").attr("disabled",true);
								}
								else
								{
									alert("Ha ocurrido un error. Intentalo de nuevo más tarde.");
								}
							});
}

function cargaAlturaPesoDes()
{
	$.get("../servidor/consulta_altura_pdes.php", function(data, status){
				var objeto = JSON.parse(data);
				
				$("#altura").css("border-radius","6px");
				$("#altura").addClass("efecto");
				variable = setTimeout(efecto,2100,"altura");
				
				$("#pesodeseable").css("border-radius","6px");
				$("#pesodeseable").addClass("efecto");
				variable2 = setTimeout(efecto,2100,"pesodeseable");
				
				
				$("#geet").css("border-radius","6px");
				$("#geet").addClass("efecto");
				variable3 = setTimeout(efecto,2100,"geet");
				
				
				
				$("#altura").html(objeto[0].altura);
				$("#pesodeseable").html(objeto[0].pesodeseable);
				$("#geet").html(objeto[0].geet);
			});
}

function cargaGeet()
{
	$.get("../servidor/consulta_altura_pdes.php", function(data, status){
				var objeto = JSON.parse(data);
				
				
				$("#geet").css("border-radius","6px");
				$("#geet").addClass("efecto");
				variable3 = setTimeout(efecto,2100,"geet");
				
				$("#geet").html(objeto[0].geet);
			});
}


function actCompruebaAltura()
{
	if($("#actaltura").val()=="")
	{
		$("#actaltura2").html("No puede estar vacío");
		$("#buttomactaltura").attr("disabled",true);
	}
	else
	{
		if($("#actaltura").val()>0)
		{
			$("#actaltura2").html("");
			$("#buttomactaltura").attr("disabled",false);
		}
		else
		{
			$("#actaltura2").html("No puede ser 0 o menor");
			$("#buttomactaltura").attr("disabled",true);
		}
	}

}

function actualizarPeso(id)
{
	$.post("../servidor/actualiza_peso.php",{
			actpeso: $("#actpeso").val()
							},
							function(datos, estado)
							{
								datos = datos.replace(/\\n/g, "\\n")  
								   .replace(/\\'/g, "\\'")
								   .replace(/\\"/g, '\\"')
								   .replace(/\\&/g, "\\&")
								   .replace(/\\r/g, "\\r")
								   .replace(/\\t/g, "\\t")
								   .replace(/\\b/g, "\\b")
								   .replace(/\\f/g, "\\f");
								// remove non-printable and other non-valid JSON chars
								datos = datos.replace(/[\u0000-\u0019]+/g,"");
								datos=datos.replace(/[\u200B-\u200D\uFEFF]/g, '');
								if(datos=='s')
								{
									$("#intercambios").addClass("efecto");
									variable = setTimeout(efecto,2100,"intercambios");
									cargarIntercambios(id);
									cargaPeso();
									graficaPeso(id);
									$("#actpeso").val("");
									$("#buttomactpeso").attr("disabled",true);
								}
								else
								{
									alert("Ha ocurrido un error. Intentalo de nuevo más tarde.");
								}
							});
}

function cargaPeso()
{
	$.get("../servidor/consulta_actpeso.php", function(data, status){
				var objeto = JSON.parse(data);
				
				$("#peso").css("border-radius","6px");
				$("#peso").addClass("efecto");
				variable = setTimeout(efecto,2100,"peso");
				
				$("#geet").css("border-radius","6px");
				$("#geet").addClass("efecto");
				variable2 = setTimeout(efecto,2100,"geet");
				
				
				$("#peso").html(objeto[0].peso);
				$("#geet").html(objeto[0].geet);
			});
}

function actCompruebaPeso()
{
	if($("#actpeso").val()=="")
	{
		$("#actpeso2").html("No puede estar vacío");
		$("#buttomactpeso").attr("disabled",true);
	}
	else
	{
		if($("#actpeso").val()>0)
		{
			$("#actpeso2").html("");
			$("#buttomactpeso").attr("disabled",false);
		}
		else
		{
			$("#actpeso2").html("No puede ser 0 o menor");
			$("#buttomactpeso").attr("disabled",true);
		}
	}
}

//Fin Actualizar
function cargaActividadCliente()
{
	$.post("../servidor/consulta_cliente_actividad.php",
							function(data, estado)
							{
								datos=JSON.parse(data);
								$("#actf").html(datos[0].nombre);
								$("#descactf").html(datos[0].descripcion);
							});
}


function cargaPatologiasCliente(idcliente)
{
	$.post("../servidor/consulta_cliente_patologias.php",{
			idcliente: idcliente
							},
							function(data, estado)
							{
								$("#patologias").html("");
								var objeto = JSON.parse(data);
								var texto="<div class='row'>";
								for(var i=0;i<objeto.length;i++)
								{
									patologiascliente.push(objeto[i].id);
									texto+="<div class='col-sm-3'>"+objeto[i].nombre+"</div>";
									if(i%3==0 && i!=0)
									{
										texto+="</div><div class='row'>";
									}
								}
								texto+="</div>";
								$("#patologias").html(texto);
							});
}


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
		
		if($("#cp").val()=="")
		{
			$("#cp").focus();
			$("#cp2").html("Requerido");
			return false;
			
		}
		else
		{
			$("#cp2").html("");
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
			cp: $("#cp").val(),
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
	var descripcionopciones=[];
	function cargarActividadFisica()
	{
    	$.get("../servidor/consulta_actividadf.php", function(data, status){
				var objeto = JSON.parse(data);
				var texto="<select class='form-control' name='actividadf' id='actividadf' onChange='muestraDescripcion(this.value);'>";
				for(var i=0;i<objeto.length;i++)
				{
					texto+="<option value='"+objeto[i].id+"'>"+objeto[i].nombre+"</option>";
					descripcionopciones.push(objeto[i].descripcion);
				}
				texto+="</select>";
				$("#opciones").html(texto);
				$("#descopciones").html(descripcionopciones[0]);
			});
	}
	
	function muestraDescripcion(indice)
	{
		$("#descopciones").html(descripcionopciones[indice-1]);
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
									tabla+="<tr><thead><td></td><th><a href='cliente_alimentos_intercambio.php#lacteos'>Lácteos</a></th><th><a href='cliente_alimentos_intercambio.php#proteinas'>Proteínas</a></th><th><a href='cliente_alimentos_intercambio.php#verduras'>Verduras</a></th><th><a href='cliente_alimentos_intercambio.php#hidratoscarbono'>H. de Carbono</a></th><th><a href='cliente_alimentos_intercambio.php#frutas'>Frutas</a></th><th><a href='cliente_alimentos_intercambio.php#grasas'>Grasas</a></th></thead></tr><tbody>";
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
										backgroundColor: 'transparent'
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
				
				
				/*$("#dietfijo11").attr("href","tel:"+objeto[0].telefono1);
				$("#dietfijo12").html(objeto[0].telefono1);
				
				$("#dietmovil11").attr("href","tel:"+objeto[0].telefono2);
				$("#dietmovil12").html(objeto[0].telefono2);*/
				
				$("#dietdireccion").html(objeto[0].direccion);
				$("#dietdirecciondatos").html(objeto[0].provincia+", "+objeto[0].localidad+" "+objeto[0].codigopostal);
				$("#dietemail").html(objeto[0].email);
				$("#dietdesarrollado").html(objeto[0].desarrollado);
			});
}

function muestraLoading(){
    $('#loading').show();
    $('#imgLoading').show();
}
function ocultaLoading(){
    $('#loading').hide();
    $('#imgLoading').hide();
}

//FIN Plantilla