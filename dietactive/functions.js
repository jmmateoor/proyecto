// JavaScript Document
function ir_a(elemento){
	var posicion=0;
    posicion = $(elemento).offset().top-120;
	
    $('html,body').animate({scrollTop: posicion}, 1300);
	
    return;
}

function principal(lugar)
{
	document.location.href=lugar;
}

function redireccion()
{
	if(location.hash!="")
	{
		ir_a(location.hash);
	}
}

var totalentradas;
var inicio;
var fin;

function cargarEntradasInicio()
{
	$.post("servidor/consultar_total_entradas.php",{
							},
							function(data, estado)
							{
								datos=JSON.parse(data);
								totalentradas=datos[0].total;
								fin=datos[0].paginacion;
								inicio=0;
								consultaEntradas(inicio,fin);
								var numeropaginas=(Math.floor(totalentradas/datos[0].paginacion))+1;
								var salidapaginas="<div class='container'><ul class='pagination'>";
								for(var i=1;i<=numeropaginas;i++)
								{
									salidapaginas+="<li><a href='javascript:void(0)' onClick='consultaEntradas("+inicio+","+fin+")'>"+i+"</a></li>";
									inicio=parseInt(inicio)+parseInt(datos[0].paginacion);
									fin=parseInt(fin)+parseInt(datos[0].paginacion);
								}
								salidapaginas+="</ul></div>";
								$("#paginacion").html(salidapaginas);
							});
	
}

function consultaEntradas(inicio1,fin1)
{
	$.post("servidor/consultar_todas_entradas.php",{
		inicio: inicio1,
		fin: fin1
							},
							function(data, estado)
							{
								var salida="";
								
								datos=JSON.parse(data);
								for(var i=0;i<datos.length;i++)
								{
									salida+="<div class='articulo'><div class='row'><div class='col-lg-12'><h3>"+datos[i].titulo+"</h3></div></div>";
									salida+="<hr />";
									salida+="<div class='row'><div class='col-md-12'><b>Autor:</b> "+datos[i].dietnombre+" "+datos[i].dietapellidos+"</div></div>";
									salida+="<div class='row'><div class='col-md-6'><b>Categoría: </b>"+datos[i].categoria+"</div><div class='col-md-6'><b>Fecha publicación: </b>"+datos[i].fecha+"</div></div><br/>";
									salida+="<hr />";
									salida+="<div class='row'><div class='col-md-6'><img src='servidor/imagenes/"+datos[i].imagen+"' class='img-responsive imagenentrada' /></div><div class='col-md-6'>"+datos[i].texto+"</div></div>";
									if(datos[i].video!="")
									{
										salida+="<hr />";
										salida+="<div class='row'><div class='col-md-12'><iframe id='videoyoutube' width='100%' height='315' class='embed-responsive-16by9' src='https://www.youtube.com/embed/"+datos[i].video+"?rel=0&wmode=transparent&showinfo=0' scrolling='no'  allowtransparency='true' allowfullscreen='true' frameborder='0' ></iframe></div></div>";
									}
									salida+="</div>";
								}
								$("#posts").html(salida);
										
								
							});
}