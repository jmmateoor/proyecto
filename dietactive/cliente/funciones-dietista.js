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
										cargarAlimentosCantidadesTest(idcliente)
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
							
							var comestible=parseFloat(datos[i].cantidad)+parseFloat(datos[i].comestible);
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
						salida+="</tbody></table></div>";
						energia=(energia/3);
						
						proteinas=proteinas/3;
						
						lipidos=lipidos/3;
						
						ags=ags/3;
						
						agm=agm/3;
						
						agp=agp/3;
						
						colesterol=(colesterol/3)*100;
						colesterol=colesterol/300;
						
						glucidos=glucidos/3;
						
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
						
						graficaVitaminas(b1, b2, b6, b12, b9, b3, c, a, d, e)
						
						$("#alimentosconsumidos").html(salida);
						
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
            name: 'Colesterol',
            data: [0,colesterol]
        }, {
            name: 'Fibra',
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
                '<td style="padding:0"><b>{point.y:.1f} mg</b></td></tr>',
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
                '<td style="padding:0"><b>{point.y:.1f} mg</b></td></tr>',
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
/*
$salida.="{";
		$salida.="\"idalimento\": \"".$idalimento."\",";
		$salida.="\"alimento\": \"".$alimento."\",";
		$salida.="\"cantidad\": \"".$cantidad."\",";
		$salida.="\"momento\": \"".$momento."\",";
		$salida.="\"comestible\": \"".$comestible."\",";
		$salida.="\"energia\": \"".$energia."\",";
		$salida.="\"proteinas\": \"".$proteinas."\",";
		$salida.="\"lipidos\": \"".$lipidos."\",";
		$salida.="\"ags\": \"".$ags."\",";
		$salida.="\"agm\": \"".$agm."\",";
		$salida.="\"agp\": \"".$agp."\",";
		$salida.="\"colesterol\": \"".$colesterol."\",";
		$salida.="\"glucidos\": \"".$glucidos."\",";
		$salida.="\"fibra\": \"".$fibra."\",";
		$salida.="\"sodio\": \"".$sodio."\",";
		$salida.="\"potasio\": \"".$potasio."\",";
		$salida.="\"calcio\": \"".$calcio."\",";
		$salida.="\"magnesio\": \"".$magnesio."\",";
		$salida.="\"fosforo\": \"".$fosforo."\",";
		$salida.="\"hierro\": \"".$hierro."\",";
		$salida.="\"zinc\": \"".$zinc."\",";
		$salida.="\"yodo\": \"".$yodo."\",";
		$salida.="\"b1\": \"".$b1."\",";
		$salida.="\"b2\": \"".$b2."\",";
		$salida.="\"b6\": \"".$b6."\",";
		$salida.="\"b12\": \"".$b12."\",";
		$salida.="\"b9\": \"".$b9."\",";
		$salida.="\"b3\": \"".$b3."\",";
		$salida.="\"c\": \"".$c."\",";
		$salida.="\"a\": \"".$a."\",";
		$salida.="\"d\": \"".$d."\",";
		$salida.="\"e\": \"".$e."\"";
		$salida.="},";
*/