//Funciones dietista
function poneImagen(ruta)
{
	if(ruta==0)
	{
		$("#imagenseleccionada").html("");
	}
	else
	{
		$("#imagenseleccionada").html("<img src='images/"+ruta+"' class='img-responsive imagenentrada' />");
	}
}

function muestraImagenesPre()
{
	$.get("../servidor/cargar_imagenes_pre.php",function(data, status)
								{		
									if(status=="success")
									{
										
										imagenes=JSON.parse(data);
										var salida="<div class='form-group'><label>Imagen:</label><select onChange='poneImagen(this.value)' class='form-control' id='imagen' name='imagen'>";
										salida+="<option value='0'>-- Selecciona --</option>";
										for(var i=0;i<imagenes.length;i++)
										{
											
												salida+="<option value='"+imagenes[i].ruta+"'>"+imagenes[i].nombre+"</option>";
											
										}
										salida+="</select></div>";
										
										$("#imagenespre").html(salida);
										
									}
								});
}

function borrarEntrada(id)
{
	if(confirm("¿Deseas borrar esta entrada?"))
	{
		$.post("../servidor/borrar_entrada.php",{
			id: id
							},
							function(data, estado)
							{
								if(data=="s")
								{
									alert("Borrado correctamente.");
									buscarEntradas();
									$("#modalEntrada").modal("hide");
									borraModal();
									
								}
							});
	}
}


function consultaEntrada(id)
{
	$.post("../servidor/consultar_entradas.php",{
			id: id
							},
							function(data, estado)
							{
								
								datos=JSON.parse(data);
								
										var modalEntradas="";
										
										modalEntradas+= "<div id='modalEntrada' class='modal fade' role='dialog'>";
										modalEntradas+="  <div class='modal-dialog'>";
											<!-- Modal content-->
										modalEntradas+="	<div class='modal-content'>";
										modalEntradas+="	  <div class='modal-header'>";
										modalEntradas+="		<button type='button' class='close' data-dismiss='modal'>&times;</button>";
										modalEntradas+="		<h4 class='modal-title'>"+datos[0].titulo+"</h4>";
										modalEntradas+="	  </div>";
										modalEntradas+="	  <div class='modal-body'>";
										modalEntradas+="		  <form role='form' name='formBorrarEntrada' method='post'>";
										
										
										modalEntradas+="		  <div class='row'><div class='col-md-6'><b>Fecha:</b> "+datos[0].fecha+"</div><div class='col-md-6'><b>Categoría:</b> "+datos[0].categoria+"</div></div>";
										
										modalEntradas+="		  <div class='row'><div class='col-md-12'><img width='230' src='images/"+datos[0].imagen+"' /></div></div>";
										
										modalEntradas+="		  <div class='row'><div class='col-md-12'><p><b>Entrada:</b></p></div></div>";
										modalEntradas+="		  <div class='row'><div class='col-md-12'><p>"+datos[0].texto+"</p></div></div>";
										
										if(datos[0].video!="")
										{
										modalEntradas+="		  <iframe id='videoyoutube' width='100%' height='315' class='embed-responsive-16by9' src='https://www.youtube.com/embed/"+datos[0].video+"?rel=0&wmode=transparent&showinfo=0' scrolling='no'  allowtransparency='true' allowfullscreen='true' frameborder='0' ></iframe>";
										}
										
										modalEntradas+="		  <div class='row'><div class='col-md-12'><p><b>Autor:</b> "+datos[0].dietnombre+" "+datos[0].dietapellidos+"</p></div></div>";
										
										modalEntradas+="		  </div>";
										modalEntradas+="		  <div class='modal-footer'>";
										modalEntradas+="			<button type='submit' id='buttomBorrarEntrada' class='btn btn-danger' onClick='borrarEntrada("+id+");'><span class='glyphicon glyphicon-check'></span> Borrar</button>";
										
										modalEntradas+="			<button type='button' class='btn btn-info btn-default' onClick='borraModal();' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancelar</button>";
										modalEntradas+="		  </form>";
										modalEntradas+="	  </div>";
										modalEntradas+="	</div>";
										
										modalEntradas+="  </div>";
										modalEntradas+="</div>";
										
										
										
										
										$("#modalEntradas").html(modalEntradas);
										$("#modalEntrada").modal("show");
								
							});
}

function borraModal()
{
	variable = setTimeout(function () {$("#modalEntradas").html("");},800);
}

function buscarEntradas()
{
	$.post("../servidor/buscar_entradas.php",{
			titulo: $("#buscadorentradas").val()
							},
							function(data, estado)
							{
								if(data!="]")
								{
									datos=JSON.parse(data);
									salida="";
										for(var i=0;i<datos.length;i++)
										{
											salida+="<div class='row fondoentradas'><div class='col-sm-2'><button class='btn btn-info' onClick='consultaEntrada("+datos[i].id+");'><span class='glyphicon glyphicon-eye-open'></span></button></div><div class='col-lg-7'>"+datos[i].titulo+"</div><div class='col-lg-3'>"+datos[i].fecha+"</div></div>";
											
										}
										$("#buscador").html(salida);
								}
								else
								{
									salida="<div class='row fondoentradas'>No hay resultados.</div>";
									$("#buscador").html(salida);
								}
								
							});
}


function publicarEntrada()
{
	if($("#titulo").val()!="")
	{
		$("#titulo2").html("");
		if($("#categoria").val()!=0)
		{
			$("#categoria2").html("");
			if($("#imagen").val()!=0)
			{
				$("#imagenerror").html("");
				if($("#textoentrada").val()!="")
				{
					$("#textoentrada3").html("");
					if(confirm("¿Quieres publicar esta entrada?"))
					{
						video=$("#enlace").val();
						var enlace=video.split("/watch?v=");
						
						var enlacevideo=enlace[enlace.length-1];
						
						$.post("../servidor/insertar_entrada.php",{
							imagen: $("#imagen").val(),
							idcategoria: $("#categoria").val(),
							titulo: $("#titulo").val(),
							texto: $("#textoentrada").val(),
							video: enlacevideo
											},
											function(data, estado)
											{
												
												if(data=="s")
												{
													
													cuentaCaracteres();
													
													$("#imagenseleccionada").html("");
													
													document.getElementById('resetear').click();
													buscarEntradas();
													alert("Entrada publicada correctamente.");
													
												}
												else
												{
													alert("Ocurrió un error. Intentalo de nuevo más tarde.");
												}
											});
					}
				}
				else
				{
					$("#textoentrada3").html("Debes escribir un texto para el artículo.");
				}
			}
			else
			{
				$("#imagenerror").html("Debes seleccionar una imagen.");
			}
		}
		else
		{
			$("#categoria2").html("Debes elegir una categoría.");
		}
	}
	else
	{
		$("#titulo2").html("Debes poner un título.");
	}
	
}


function cuentaCaracteres()
{
	$("#textoentrada2").html($("#textoentrada").val().length);
}

function muestraCategorias()
{
	$.get("../servidor/consulta_categorias.php",function(data, status)
								{		
									if(status=="success")
									{
										
										categoria=JSON.parse(data);
										var salida="<div class='form-group'><label>Categoría:</label><select class='form-control' id='categoria' name='categoria'>";
										salida+="<option value='0'>-- Selecciona --</option>";
										for(var i=0;i<categoria.length;i++)
										{
											
												salida+="<option value='"+categoria[i].id+"'>"+categoria[i].nombre+"</option>";
											
										}
										salida+="</select></div>";
										
										$("#listacategorias").html(salida);
										
									}
								});
}


function insertarAlimento()
{
	if($("#inalimento").val()=="" || $("#incomestible").val()=="" || $("#inenergia").val()=="" || $("#inproteinas").val()=="" || $("#inlipidos").val()=="" || $("#inags").val()=="" || $("#inagm").val()=="" || $("#inagp").val()=="" || $("#incolesterol").val()=="" || $("#inglucidos").val()=="" || $("#infibra").val()=="" || $("#insodio").val()=="" || $("#inpotasio").val()=="" || $("#incalcio").val()=="" || $("#inmagnesio").val()=="" || $("#infosforo").val()=="" || $("#inhierro").val()=="" || $("#inzinc").val()=="" || $("#inyodo").val()=="" || $("#inb1").val()=="" || $("#inb2").val()=="" || $("#inb6").val()=="" || $("#inb12").val()=="" || $("#inb9").val()=="" || $("#inb3").val()=="" || $("#inc").val()=="" || $("#ina").val()=="" || $("#ind").val()=="" || $("#ine").val()=="")
	{
		
		alert("Hay algún campo vacío o con error. Por favor, rellena todos los campos correctamene.");
		
	}
	else
	{
		$.post("../servidor/dietista_insertar_alimento.php",{
			idtipoalimento: $("#intiposalimentos").val(),
			alimento: $("#inalimento").val(),
			comestible: $("#incomestible").val(),
			energia: $("#inenergia").val(),
			proteinas: $("#inproteinas").val(),
			lipidos: $("#inlipidos").val(),
			ags: $("#inags").val(),
			agm: $("#inagm").val(),
			agp: $("#inagp").val(),
			colesterol: $("#incolesterol").val(),
			glucidos: $("#inglucidos").val(),
			fibra: $("#infibra").val(),
			sodio: $("#insodio").val(),
			potasio: $("#inpotasio").val(),
			calcio: $("#incalcio").val(),
			magnesio: $("#inmagnesio").val(),
			fosforo: $("#infosforo").val(),
			hierro: $("#inhierro").val(),
			zinc: $("#inzinc").val(),
			yodo: $("#inyodo").val(),
			b1: $("#inb1").val(),
			b2: $("#inb2").val(),
			b6: $("#inb6").val(),
			b12: $("#inb12").val(),
			b9: $("#inb9").val(),
			b3: $("#inb3").val(),
			c: $("#inc").val(),
			a: $("#ina").val(),
			d: $("#ind").val(),
			e: $("#ine").val()
							},
							function(data, estado)
							{
								if(data=="s")
								{
									$("#inalimento").val("");
									$("#incomestible").val("");
									$("#inenergia").val("");
									$("#inproteinas").val("");
									$("#inlipidos").val("");
									$("#inags").val("");
									$("#inagm").val("");
									$("#inagp").val("");
									$("#incolesterol").val("");
									$("#inglucidos").val("");
									$("#infibra").val("");
									$("#insodio").val("");
									$("#inpotasio").val("");
									$("#incalcio").val("");
									$("#inmagnesio").val("");
									$("#infosforo").val("");
									$("#inhierro").val("");
									$("#inzinc").val("");
									$("#inyodo").val("");
									$("#inb1").val("");
									$("#inb2").val("");
									$("#inb6").val("");
									$("#inb12").val("");
									$("#inb9").val("");
									$("#inb3").val("");
									$("#inc").val("");
									$("#ina").val("");
									$("#ind").val("");
									$("#ine").val("");
									muestraAlimentos();
									alert("Insertado correctamente");
									
								}
								else
								{
									alert(data);
									alert("Ha ocurrido un error. Intentalo de nuevo más tarde.");
									
								}
								
							});
	}
}


function actualizaAlimento(idalimento)
{
	if($("#alimento").val()=="" || $("#comestible").val()=="" || $("#energia").val()=="" || $("#proteinas").val()=="" || $("#lipidos").val()=="" || $("#ags").val()=="" || $("#agm").val()=="" || $("#agp").val()=="" || $("#colesterol").val()=="" || $("#glucidos").val()=="" || $("#fibra").val()=="" || $("#sodio").val()=="" || $("#potasio").val()=="" || $("#calcio").val()=="" || $("#magnesio").val()=="" || $("#fosforo").val()=="" || $("#hierro").val()=="" || $("#zinc").val()=="" || $("#yodo").val()=="" || $("#b1").val()=="" || $("#b2").val()=="" || $("#b6").val()=="" || $("#b12").val()=="" || $("#b9").val()=="" || $("#b3").val()=="" || $("#c").val()=="" || $("#a").val()=="" || $("#d").val()=="" || $("#e").val()=="")
	{
		alert("Hay algún campo vacío o con error. Por favor, rellena todos los campos correctamene.");
		
	}
	else
	{
		$.post("../servidor/dietista_actualizar_alimento.php",{
			idalimento: idalimento,
			idtipoalimento: $("#tiposalimentos").val(),
			alimento: $("#alimento").val(),
			comestible: $("#comestible").val(),
			energia: $("#energia").val(),
			proteinas: $("#proteinas").val(),
			lipidos: $("#lipidos").val(),
			ags: $("#ags").val(),
			agm: $("#agm").val(),
			agp: $("#agp").val(),
			colesterol: $("#colesterol").val(),
			glucidos: $("#glucidos").val(),
			fibra: $("#fibra").val(),
			sodio: $("#sodio").val(),
			potasio: $("#potasio").val(),
			calcio: $("#calcio").val(),
			magnesio: $("#magnesio").val(),
			fosforo: $("#fosforo").val(),
			hierro: $("#hierro").val(),
			zinc: $("#zinc").val(),
			yodo: $("#yodo").val(),
			b1: $("#b1").val(),
			b2: $("#b2").val(),
			b6: $("#b6").val(),
			b12: $("#b12").val(),
			b9: $("#b9").val(),
			b3: $("#b3").val(),
			c: $("#c").val(),
			a: $("#a").val(),
			d: $("#d").val(),
			e: $("#e").val()
							},
							function(data, estado)
							{
								if(data=="s")
								{
									$("#modalAlimento").modal("hide");
									alert("Actualizado correctamente");
									
								}
								else
								{
									$("#modalAlimento").modal("hide");
									alert("Ha ocurrido un error. Intentalo de nuevo más tarde.");
									
								}
								
							});
	}
}

function cargarTiposAlimentosInsertar()
{
	$.get("../servidor/consulta_tipos_alimentos.php",function(data, status)
								{		
									if(status=="success")
									{
										
										tiposalimentos=JSON.parse(data);
										var salida="<div class='form-group'><label>Tipo de alimento:</label><select class='form-control' id='intiposalimentos' name='tiposalimentos'>";
										
										for(var i=0;i<tiposalimentos.length;i++)
										{
											
												salida+="<option value='"+tiposalimentos[i].id+"'>"+tiposalimentos[i].nombre+"</option>";
											
										}
										salida+="</select></div>";
										
										$("#ponertiposalimentos").html(salida);
										
									}
								});
}

function muestraModal(idalimento)
{
	$.post("../servidor/dietista_mostrar_alimento.php",{
			idalimento: idalimento
							},
							function(data, estado)
							{
								datos=JSON.parse(data);
								
								$.get("../servidor/consulta_tipos_alimentos.php",function(data, status)
								{		
									if(status=="success")
									{
										
										tiposalimentos=JSON.parse(data);
										var salida="<div class='form-group'><label>Tipo de alimento:</label><select class='form-control' id='tiposalimentos' name='tiposalimentos'>";
										
										for(var i=0;i<tiposalimentos.length;i++)
										{
											if(tiposalimentos[i].id==datos[0].idtipoalimento)
											{
												salida+="<option selected='selected' value='"+tiposalimentos[i].id+"'>"+tiposalimentos[i].nombre+"</option>";
											}
											else
											{
												salida+="<option value='"+tiposalimentos[i].id+"'>"+tiposalimentos[i].nombre+"</option>";
											}
										}
										salida+="</select></div>";
										
										var modalAlimento="";
										
										modalAlimento+= "<div id='modalAlimento' class='modal fade' role='dialog'>";
										modalAlimento+="  <div class='modal-dialog'>";
											<!-- Modal content-->
										modalAlimento+="	<div class='modal-content'>";
										modalAlimento+="	  <div class='modal-header'>";
										modalAlimento+="		<button type='button' class='close' data-dismiss='modal'>&times;</button>";
										modalAlimento+="		<h4 class='modal-title'>Alimento</h4>";
										modalAlimento+="	  </div>";
										modalAlimento+="	  <div class='modal-body'>";
										modalAlimento+="		  <form role='form' name='formActualizarAlimento' method='post'>";
										modalAlimento+="		  <div class='form-group'><label for='alimento'>Nombre</label><input id='alimento' name='alimento' class='form-control' value='"+datos[0].alimento+"' /></div>"; //IMPORTANTE
										modalAlimento+=salida;
										
										modalAlimento+="		  <div class='row'><div class='col-md-4'><div class='form-group'><label for='comestible'>Comestible</label><input type='number' required min='0'  id='comestible' name='comestible' class='form-control' value='"+datos[0].comestible+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='energia'>Energía</label><input type='number' required min='0' id='energia' name='energia' class='form-control' value='"+datos[0].energia+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='proteinas'>Proteínas</label><input type='number' required min='0' step='0.01' id='proteinas' name='proteinas' class='form-control' value='"+datos[0].proteinas+"' /></div></div></div>";
										
										modalAlimento+="		  <div class='row'><div class='col-md-4'><div class='form-group'><label for='lipidos'>Lípidos</label><input type='number' required min='0'  id='lipidos' name='lipidos' class='form-control' value='"+datos[0].lipidos+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='ags'>AGS</label><input type='number' required min='0' id='ags' name='ags' class='form-control' value='"+datos[0].ags+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='agm'>AGM</label><input type='number' required min='0' step='0.01' id='agm' name='agm' class='form-control' value='"+datos[0].agm+"' /></div></div></div>";
										
										modalAlimento+="		  <div class='row'><div class='col-md-4'><div class='form-group'><label for='agp'>AGP</label><input type='number' required min='0'  id='agp' name='agp' class='form-control' value='"+datos[0].agp+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='colesterol'>Colesterol</label><input type='number' required min='0' id='colesterol' name='colesterol' class='form-control' value='"+datos[0].colesterol+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='glucidos'>Glúcidos</label><input type='number' required min='0' step='0.01' id='glucidos' name='glucidos' class='form-control' value='"+datos[0].glucidos+"' /></div></div></div>";
										
										
										modalAlimento+="		  <div class='row'><div class='col-md-4'><div class='form-group'><label for='fibra'>Fibra</label><input type='number' required min='0'  id='fibra' name='fibra' class='form-control' value='"+datos[0].fibra+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='sodio'>Sodio</label><input type='number' required min='0' id='sodio' name='sodio' class='form-control' value='"+datos[0].sodio+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='potasio'>Potasio</label><input type='number' required min='0' step='0.01' id='potasio' name='potasio' class='form-control' value='"+datos[0].potasio+"' /></div></div></div>";
										
										modalAlimento+="		  <div class='row'><div class='col-md-4'><div class='form-group'><label for='calcio'>Calcio</label><input type='number' required min='0'  id='calcio' name='calcio' class='form-control' value='"+datos[0].calcio+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='magnesio'>Magnesio</label><input type='number' required min='0' id='magnesio' name='magnesio' class='form-control' value='"+datos[0].magnesio+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='fosforo'>Fósforo</label><input type='number' required min='0' step='0.01' id='fosforo' name='fosforo' class='form-control' value='"+datos[0].fosforo+"' /></div></div></div>";
										
										modalAlimento+="		  <div class='row'><div class='col-md-4'><div class='form-group'><label for='hierro'>Hierro</label><input type='number' required min='0'  id='hierro' name='hierro' class='form-control' value='"+datos[0].hierro+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='zinc'>Zinc</label><input type='number' required min='0' id='zinc' name='zinc' class='form-control' value='"+datos[0].zinc+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='yodo'>Yodo</label><input type='number' required min='0' step='0.01' id='yodo' name='yodo' class='form-control' value='"+datos[0].yodo+"' /></div></div></div>";
										
										modalAlimento+="		  <div class='row'><div class='col-md-4'><div class='form-group'><label for='b1'>B1</label><input type='number' required min='0'  id='b1' name='b1' class='form-control' value='"+datos[0].b1+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='b2'>B2</label><input type='number' required min='0' id='b2' name='b2' class='form-control' value='"+datos[0].b2+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='b6'>B6</label><input type='number' required min='0' step='0.01' id='b6' name='b6' class='form-control' value='"+datos[0].b6+"' /></div></div></div>";
										
										modalAlimento+="		  <div class='row'><div class='col-md-4'><div class='form-group'><label for='b12'>B12</label><input type='number' required min='0'  id='b12' name='b12' class='form-control' value='"+datos[0].b12+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='b9'>B9</label><input type='number' required min='0' id='b9' name='b9' class='form-control' value='"+datos[0].b9+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='b3'>B3</label><input type='number' required min='0' step='0.01' id='b3' name='b3' class='form-control' value='"+datos[0].b3+"' /></div></div></div>";
										
										modalAlimento+="		  <div class='row'><div class='col-md-4'><div class='form-group'><label for='c'>C</label><input type='number' required min='0'  id='c' name='c' class='form-control' value='"+datos[0].c+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='a'>A</label><input type='number' required min='0' id='a' name='a' class='form-control' value='"+datos[0].a+"' /></div></div><div class='col-md-4'><div class='form-group'><label for='d'>D</label><input type='number' required min='0' step='0.01' id='d' name='d' class='form-control' value='"+datos[0].d+"' /></div></div></div>";
										
										modalAlimento+="		  <div class='row'><div class='col-md-4'><div class='form-group'><label for='e'>E</label><input type='number' required min='0'  id='e' name='e' class='form-control' value='"+datos[0].e+"' /></div></div></div>";
										
										
										modalAlimento+="		  </div>";
										modalAlimento+="		  <div class='modal-footer'>";
										modalAlimento+="			<button type='submit' id='buttomActualizar' class='btn btn-success' onClick='actualizaAlimento("+idalimento+");'><span class='glyphicon glyphicon-check'></span> Actualizar</button>";
										
										modalAlimento+="			<button type='button' class='btn btn-danger btn-default' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancelar</button>";
										modalAlimento+="		  </form>";
										modalAlimento+="	  </div>";
										modalAlimento+="	</div>";
										
										modalAlimento+="  </div>";
										modalAlimento+="</div>";
										$("#modalAlimentos").html(modalAlimento);
										$("#modalAlimento").modal("show");
										
									}
								});
								
								
								
							});
}

function borrarAlimento(idalimento)
{
	if(confirm("¿Deseas borrar este alimento?"))
	{
		$.post("../servidor/dietista_borrar_alimento.php",{
			idalimento: idalimento
							},
							function(data, estado)
							{
								if(data=="s")
								{
									alert("Borrado correctamente.");
									muestraAlimentos();
								}
							});
	}
}



function muestraAlimentos()
{
	$.post("../servidor/dietista_buscar_alimentos.php",{
			texto: $("#buscaralimento").val()
							},
							function(data, estado)
							{
								if(data!="]")
								{
									datos=JSON.parse(data);
									salida="";
									for(var i=0;i<datos.length;i++)
									{
										salida+="<div class='row fondoalimentos'><div class='col-sm-2'><button class='btn btn-info' onClick='muestraModal("+datos[i].id+");'><span class='glyphicon glyphicon-eye-open'></span></button></div><div class='col-lg-8'>"+datos[i].alimento+"</div><div class='col-sm-2'><button class='btn btn-danger' onClick='borrarAlimento("+datos[i].id+")'><span class='glyphicon glyphicon-remove-sign'></span></button></div></div>";
										
									}
									$("#buscador").html(salida);
								}
								else
								{
									salida="<div class='row fondoclientes'>No hay resultados.</div>";
									$("#buscador").html(salida);
								}
							});
	
}


function buscarClientes()
{
	$.post("../servidor/dietista_buscar_clientes.php",{
			texto: $("#buscarcliente").val()
							},
							function(data, estado)
							{
								if(data!="]")
								{
									datos=JSON.parse(data);
									salida="";
									for(var i=0;i<datos.length;i++)
									{
										salida+="<div class='row fondoclientes'><div class='col-sm-2'><button class='btn btn-info' onClick='datosClienteBuscado("+datos[i].id+");'><span class='glyphicon glyphicon-eye-open'></span></button></div><div class='col-lg-5'>"+datos[i].nombre+"</div><div class='col-lg-5'>"+datos[i].email+"</div></div>";
										
									}
									$("#buscador").html(salida);
								}
								else
								{
									salida="<div class='row fondoclientes'>No hay resultados.</div>";
									$("#buscador").html(salida);
								}
							});
}

function dietistaEliminarCita(idcliente, cita, email)
{
	if(confirm("¿Deseas eliminar la cita? Se enviará un mensaje al cliente informandole de la cancelación."))
	{
		$.post("../servidor/dietista_eliminar_cita.php",{
			idcliente: idcliente,
			cita: cita,
			email: email
							},
							function(datos, estado)
							{
								if(datos=='s')
								{
									cargarCitasDietista();
									alert("Cita borrada correctamente.");
								}
								else
								{
									alert("Ha ocurrido un error. Intentalo de nuevo más tarde.");
								}
							});
	}
}


function cargarCitasDietista()
{
	var porNombre=document.getElementsByName("consultaDias");
	for(var i=0;i<porNombre.length;i++)
        {
            if(porNombre[i].checked)
                dias=porNombre[i].value;
        }
		
	$.post("../servidor/dietista_consulta_citas.php",{
			dias: dias
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
										
								if(data!=']')
								{
									datos=JSON.parse(data);
									salida="<div>";
									for(var i=0;i<datos.length;i++)
									{
										var dia=poneFecha((datos[i].cita.split(" "))[0]);
										var hora=(datos[i].cita.split(" "))[1];
										salida+="<div class='row citas'>";
										salida+="<div class='row'><div class='col-sm-2'><button class='btn btn-info' onClick='datosClienteBuscado("+datos[i].idcliente+")' > <span class='glyphicon glyphicon-eye-open'></span> </button></div><div class='col-sm-7'> </div><div class='col-sm-2'><button class='btn btn-danger' onClick='dietistaEliminarCita("+datos[i].idcliente+",\""+datos[i].cita+"\",\""+datos[i].email+"\")'> <span class='glyphicon glyphicon-remove-sign' ></span> </button></div></div><div class='row'><div class='col-md-11'><b>"+dia+" "+hora+"</b></div></div><div class='row'><div class='col-md-12'>"+datos[i].nombre+"</div></div><div class='row oculto'><div class='col-md-11'>"+datos[i].tipocita+"</div></div>";
										salida+="</div>";
										//salida+="<hr />";
									}
									
									salida+="</div>";
									$("#citas").html(salida);
								}
								else
								{
									$("#citas").html("");
								}
							});
}




function actualizaPasswordDietista()
{
	//password
	$.post("../servidor/dietista_actualiza_password.php",{
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



function datosClienteBuscado(idcliente)
{
	$.post("../servidor/dietista_cliente.php",{
							idcliente: idcliente
									},
									function(data, estado)
									{
										$("#cliente").html("");
										$("#patologias").html("");
										$("#intercambios").html("");
										$("#grafica").html("");
										$("#alimentosconsumidos").html("");
										$("#kcal").html("");
										$("#perfillipidico").html("");
										$("#colesterolfibra").html("");
										$("#minerales").html("");
										$("#vitaminas").html("");
										
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
										salida+="<div class='col-sm-4'><p><b>Dieta</b> <span data-toggle='tooltip' data-placement='top' title='Actualizar'><button type='button' class='btn btn-info btn-xs' data-toggle='modal' data-target='#modalDieta'><span class='glyphicon glyphicon-edit'></span></button></span></p><p id='ladieta'>"+datos[0].dieta+"</p></div>";
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
										
										
										var modaldieta="";
										
										modaldieta+= "<div id='modalDieta' class='modal fade' role='dialog'>";
										modaldieta+="  <div class='modal-dialog'>";
											<!-- Modal content-->
										modaldieta+="	<div class='modal-content'>";
										modaldieta+="	  <div class='modal-header'>";
										modaldieta+="		<button type='button' class='close' data-dismiss='modal'>&times;</button>";
										modaldieta+="		<h4 class='modal-title'>Actualizar dieta</h4>";
										modaldieta+="	  </div>";
										modaldieta+="	  <div class='modal-body'>";
										modaldieta+="		  <form role='form' name='formActualizarDieta' method='post'>";
										modaldieta+="		  <textarea id='textodieta' class='form-control' rows='4' cols='50' onKeyUp='compruebaDieta();' onChange='compruebaDieta();'>"+datos[0].dieta+"</textarea>";
										modaldieta+="		  <span id='textodieta2'></span>";
										modaldieta+="		  </div>";
										modaldieta+="		  <div class='modal-footer'>";
										modaldieta+="			<button type='submit' id='buttomdieta' class='btn btn-success' data-dismiss='modal' disabled='true' onClick='actualizaDieta("+idcliente+");'><span class='glyphicon glyphicon-check'></span> Enviar</button>";
										
										modaldieta+="			<button type='button' class='btn btn-danger btn-default' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancelar</button>";
										modaldieta+="		  </form>";
										modaldieta+="	  </div>";
										modaldieta+="	</div>";
										
										modaldieta+="  </div>";
										modaldieta+="</div>";
										<!-- Fin Modal Enviar Email -->;
										$("#ventanadieta").html(modaldieta);
										
										cargarAlimentosCantidadesTest(idcliente);
										
										compruebaDieta();
									});
}

function actualizaDieta(idcliente)
{
	dieta=$("#textodieta").val();
	$.post("../servidor/actualizar_dieta.php",{
			idcliente: idcliente,
			dieta: dieta
							},
							function(datos, estado)
							{
								if(datos=='s')
								{
									$("#textodieta").val("");
									$("#ladieta").html(dieta);
								}
								else
								{
									alert("No se ha podido actualizar. Intentalo de nuevo más tarde");
								}
							});
}

function compruebaDieta()
{
	if($("#textodieta").val()=="")
	{
		$("#textodieta2").html("No puede estar vacío");
		$("#buttomdieta").attr("disabled",true);
	}
	else
	{
		$("#textodieta2").html("");
		$("#buttomdieta").attr("disabled",false);
	}
}

function cargarAlimentosCantidadesTest(idcliente)
{
	$.post("../servidor/cargar_alimentos.php",{
			idcliente: idcliente
					},
					function(data, estado)
					{
						if(data!="]")
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
						
						var energia=0;
						var proteinas=0;
						var lipidos=0;
						var ags=0;
						var agm=0;
						var agp=0;
						var colesterol=0;
						var glucidos=0;
						var fibra=0;
						var sodio=0;
						var potasio=0;
						var calcio=0;
						var magnesio=0;
						var fosforo=0;
						var hierro=0;
						var zinc=0;
						var yodo=0;
						var b1=0;
						var b2=0;
						var b6=0;
						var b12=0;
						var b9=0;
						var b3=0;
						var c=0;
						var a=0;
						var d=0;
						var e=0;
						
						salida="<div class='table-responsive'><table class='table table-condensed'>";
						salida+="<tr><thead><th>Momento</th><th>Alimento</th><th>Cantidad</th></thead></tr><tbody>";
						for(var i=0; i<datos.length;i++)
						{
							salida+="<tr><td>"+datos[i].momento+"</td><td>"+datos[i].alimento+"</td><td>"+datos[i].cantidad+"</td></tr>";
							
							var comestible=parseFloat(datos[i].cantidad)*parseFloat(datos[i].comestible)/100;
							energia=energia+(comestible*(parseFloat(datos[i].energia))/100);
							proteinas=proteinas+(comestible*(parseFloat(datos[i].proteinas))/100);
							lipidos=lipidos+(comestible*(parseFloat(datos[i].lipidos))/100);
							ags=ags+(comestible*(parseFloat(datos[i].ags))/100);
							agm=agm+(comestible*(parseFloat(datos[i].agm))/100);
							agp=agp+(comestible*(parseFloat(datos[i].agp))/100);
							colesterol=colesterol+(comestible*(parseFloat(datos[i].colesterol))/100);
							glucidos=glucidos+(comestible*(parseFloat(datos[i].glucidos))/100);
							fibra=fibra+(comestible*(parseFloat(datos[i].fibra))/100);
							sodio=sodio+(comestible*(parseFloat(datos[i].sodio))/100);
							potasio=potasio+(comestible*(parseFloat(datos[i].potasio))/100);
							calcio=calcio+(comestible*(parseFloat(datos[i].calcio))/100);
							magnesio=magnesio+(comestible*(parseFloat(datos[i].magnesio))/100);
							fosforo=fosforo+(comestible*(parseFloat(datos[i].fosforo))/100);
							hierro=hierro+(comestible*(parseFloat(datos[i].hierro))/100);
							zinc=zinc+(comestible*(parseFloat(datos[i].zinc))/100);
							yodo=yodo+(comestible*(parseFloat(datos[i].yodo))/100);
							b1=b1+(comestible*(parseFloat(datos[i].b1))/100);
							b2=b2+(comestible*(parseFloat(datos[i].b2))/100);
							b6=b6+(comestible*(parseFloat(datos[i].b6))/100);
							b12=b12+(comestible*(parseFloat(datos[i].b12))/100);
							b9=b9+(comestible*(parseFloat(datos[i].b9))/100);
							b3=b3+(comestible*(parseFloat(datos[i].b3))/100);
							c=c+(comestible*(parseFloat(datos[i].c))/100);
							a=a+(comestible*(parseFloat(datos[i].a))/100);
							d=d+(comestible*(parseFloat(datos[i].d))/100);
							e=e+(comestible*(parseFloat(datos[i].e))/100);
							
						}
						
						
						energia=(energia/3);
						
						salida+="</tbody></table></div><b>Energía:</b> "+energia.toFixed(2)+" KCal/día<br/>";
						
						proteinas=(proteinas*4)/3;
						
						lipidos=(lipidos*9)/3;
						
						ags=ags/3;
						
						agm=agm/3;
						
						agp=agp/3;
						
						colesterol=(colesterol/3)*100;
						colesterol=colesterol/300;
						
						glucidos=(glucidos*4)/3;
						
						
						fibra=(fibra/3)*100;
						fibra=fibra/25;
						
						sodio=(sodio/3)*100;
						sodio=sodio/2000;
						
						potasio=(potasio/3)*100;
						potasio=potasio/4700;
						
						calcio=(calcio/3)*100;
						calcio=calcio/800;
						
						magnesio=(magnesio/3)*100;
						magnesio=magnesio/350;
						
						fosforo=(fosforo/3)*100;
						fosforo=fosforo/800;
						
						hierro=(hierro/3)*100;
						hierro=hierro/15;
						
						zinc=(zinc/3)*100;
						zinc=zinc/15;
						
						yodo=(yodo/3)*100;
						yodo=yodo/150;
						
						b1=(b1/3)*100;
						b1=b1/1.5;
						
						b2=(b2/3)*100;
						b2=b2/1.7;
						
						b6=(b6/3)*100;
						b6=b6/2;
						
						b12=(b12/3)*100;
						b12=b12/2;
						
						b9=(b9/3)*100;
						b9=b9/200;
						
						b3=(b3/3)*100;
						b3=b3/19;
						
						c=(c/3)*100;
						c=c/60;
						
						a=(a/3)*100;
						a=a/1000;
						
						d=(d/3)*100;
						d=d/5;
						
						e=(e/3)*100;
						e=e/10;
						
						graficaKCal(proteinas,lipidos,glucidos);
						
						graficaPerfilLipidico(ags, agm, agp);
						
						graficaColesterolFibra(colesterol, fibra);
						
						graficaMinerales(sodio, potasio, calcio, fosforo, magnesio, hierro, zinc, yodo);
						
						graficaVitaminas(b1, b2, b6, b12, b9, b3, c, a, d, e);
						
						
						
						
						$("#alimentosconsumidos").html(salida);
						}
						else
						{
							$("#alimentosconsumidos").html("No hay resultados.");
						}
					});
}

function graficaKCal(proteinas, lipidos, glucidos)
{
	 $('#kcal').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: '% Kcal'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Proteínas',
                y: proteinas
            }, {
                name: 'Lípidos',
                y: lipidos
            }, {
                name: 'Glúcidos',
                y: glucidos
            }]
        }]
    });
}

function graficaPerfilLipidico(ags, agm, agp)
{
	$('#perfillipidico').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Perfil Lipídico'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'AGP',
                y: agp
            }, {
                name: 'AGS',
                y: ags
            }, {
                name: 'AGM',
                y: agm
            }]
        }]
    });
}

function graficaColesterolFibra(colesterol, fibra)
{
	colesterol=parseFloat(colesterol.toFixed(2));
	fibra=parseFloat(fibra.toFixed(2));
	$('#colesterolfibra').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: '% Ir'
        },
        xAxis: {
            categories: ['Fibra', 'Colesterol']
        },
        yAxis: {
            min: 0,
            title: {
                text: ' '
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
        series: [{
            name: '% Colesterol',
            data: [0,colesterol]
        }, {
            name: '% Fibra',
            data: [fibra,0]
        }]
    });
}

function graficaMinerales(sodio, potasio, calcio, fosforo, magnesio, hierro, zinc, yodo)
{
	$('#minerales').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '% Minerales'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
				'Minerales'
            ],
            crosshair: false
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Sodio',
            data: [sodio]

        }, {
            name: 'Potasio',
            data: [potasio]

        }, {
            name: 'Calcio',
            data: [calcio]

        }, {
            name: 'Fósforo',
            data: [fosforo]

        },{
            name: 'Magnesio',
            data: [magnesio]

        },{
            name: 'Hierro',
            data: [hierro]

        },{
            name: 'Zinc',
            data: [zinc]

        },{
            name: 'Yodo',
            data: [yodo]

        }]
    });
}

function graficaVitaminas(b1, b2, b6, b12, b9, b3, c, a, d, e)
{
	$('#vitaminas').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '% Vitaminas'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
				'Vitaminas'
            ],
            crosshair: false
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'B1',
            data: [b1]

        }, {
            name: 'B2',
            data: [b2]

        }, {
            name: 'B6',
            data: [b6]

        }, {
            name: 'B12',
            data: [b12]

        },{
            name: 'B9',
            data: [b9]

        },{
            name: 'B3',
            data: [b3]

        },{
            name: 'C',
            data: [c]

        },{
            name: 'A',
            data: [a]

        },{
            name: 'D',
            data: [d]

        },{
            name: 'E',
            data: [e]

        }]
    });
}