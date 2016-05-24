//Funciones dietista
function actualizaAlimento(idalimento)
{
	
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
										var salida="<select class='form-control' id='tiposalimentos' name='tiposalimentos'>";
										
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
										salida+="</select>";
										
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
										modalAlimento+="		  <input id='alimento' class='form-control' value='"+datos[0].alimento+"' />"; //IMPORTANTE
										modalAlimento+=salida;
										modalAlimento+="		  </div>";
										modalAlimento+="		  <div class='modal-footer'>";
										modalAlimento+="			<button type='submit' id='buttomdieta' class='btn btn-success' data-dismiss='modal' disabled='true' onClick='actualizaAlimento("+idalimento+");'><span class='glyphicon glyphicon-check'></span> Enviar</button>";
										
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
										salida+="<div class='row fondoalimentos'><div class='col-sm-3'><button class='btn btn-info' onClick='muestraModal("+datos[i].id+");'><span class='glyphicon glyphicon-eye-open'></span></button></div><div class='col-lg-9'>"+datos[i].alimento+"</div></div>";
										
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
										salida+="<div class='row'><div class='col-sm-2'><button class='btn btn-info' onClick='datosClienteBuscado("+datos[i].idcliente+")' > <span class='glyphicon glyphicon-eye-open'></span> </button></div><div class='col-sm-8'> </div><div class='col-sm-2'><button class='btn btn-danger' onClick='dietistaEliminarCita("+datos[i].idcliente+",\""+datos[i].cita+"\",\""+datos[i].email+"\")'> <span class='glyphicon glyphicon-remove-sign' ></span> </button></div></div><div class='row'><div class='col-md-12'><b>"+dia+" "+hora+"</b></div></div><div class='row'><div class='col-md-12'>"+datos[i].nombre+"</div></div><div class='row oculto'><div class='col-md-12'>"+datos[i].tipocita+"</div></div>";
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