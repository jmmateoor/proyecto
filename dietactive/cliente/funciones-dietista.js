//Funciones dietista
function datosClienteBuscado(idcliente)
{
	idcliente=17;
	
	$.post("../servidor/dietista_cliente.php",{
							idcliente: idcliente
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
										
										salida="";
										datos=JSON.parse(data);
										salida+="<div class='row'>";
										salida+="<div class='col-sm-4'><p><b>Nombre completo</b></p><p>"+datos[0].nombre+" "+datos[0].apellidos+"</p></div>";
										salida+="<div class='col-sm-4'><p><b>Código Postal</b></p><p>"+datos[0].cp+"</p></div>";
										salida+="<div class='col-sm-4'><p><b>Provincia</b></p><p>"+datos[0].cp+"</p></div>";
										salida+="</div>";
										
										salida+="<div class='row'>";
										salida+="<div class='col-sm-4'><p><b>Teléfono</b></p><p>"+datos[0].telefono+"</p></div>";
										salida+="<div class='col-sm-6'><p><b>Correo electrónico</b></p><p>"+datos[0].email+"</p></div>";
										salida+="</div>";
										
										salida+="<div class='row'>";
										salida+="<div class='col-sm-4'><p><b>Sexo</b></p><p>"+datos[0].sexo+"</p></div>";
										salida+="<div class='col-sm-4'><p><b>Peso</b></p><p>"+datos[0].peso+"</p></div>";
										salida+="<div class='col-sm-4'><p><b>Altura</b></p><p>"+datos[0].altura+"</p></div>";
										salida+="</div>";
										
										salida+="<div class='row'>";
										salida+="<div class='col-sm-4'><p><b>Edad</b></p><p>"+datos[0].fechanac+"</p></div>";
										salida+="<div class='col-sm-4'><p><b>Peso deseable</b></p><p>"+datos[0].pesodeseable+"</p></div>";
										salida+="<div class='col-sm-4'><p><b>Dieta</b> X</p><p>"+datos[0].dieta+"</p></div>";
										salida+="</div>";
										
										salida+="<div class='row'>";
										salida+="<div class='col-sm-4'><p><b>GET</b></p><p>"+datos[0].geet+"</p></div>";
										salida+="<div class='col-sm-6'><p><b>Actividad F.</b></p><p>"+datos[0].actividadfisica+"</p></div>";
										salida+="</div>";
										
										salida+="<div class='row'>";
										salida+="<div class='col-sm-12'><p><b>Descripción Actividad F.</b></p><p>"+datos[0].descripcionactividad+"</p></div>";
										salida+="</div>";
										
										$("#cliente").html(salida);
										cargarIntercambios(idcliente);
										graficaPeso(idcliente);
										cargaPatologiasCliente(idcliente);
									});
}

function cargarAlimentosCantidadesTest(idcliente)
{
	$.post("../servidor/cargar_alimentos.php",{
			idcliente: idcliente
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
						
						salida="";
						datos=JSON.parse(data);
						
						
					});
}