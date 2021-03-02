/* Window.location se utiliza para redirigir el navegador a una nueva página */
function modificar(cod){
	window.location = "http://localhost/proyecto/modificar.php?parametro="+cod;
}

function eliminar(cod){
	window.location = "http://localhost/proyecto/capturar.php?parametro="+cod+"&funcion=eliminar";
}

function modificarproducto(pcod){
	window.location = "http://localhost/proyecto/modificar.php?pparametro="+pcod;
}

function eliminarproducto(pcod){
	window.location = "http://localhost/proyecto/capturar.php?pparametro="+pcod+"&funcion=eliminar";
}