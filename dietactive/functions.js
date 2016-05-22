// JavaScript Document
function ir_a(elemento){
    var posicion = $(elemento).position().top-100;
    $('html,body').animate({scrollTop: posicion}, 1000);
    return;
}

function principal(lugar)
{
	document.location.href="../index.html#"+lugar;
}

function redireccion()
{
	if(location.hash!="")
	{
		ir_a(location.hash);
	}
}