// JavaScript Document
function ir_a(elemento){
	var posicion=0;
    posicion = $(elemento).offset().top-120;
	
    $('html,body').animate({scrollTop: posicion}, 1300);
	
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