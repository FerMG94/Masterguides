document.getElementById("nombre").addEventListener("keyup", mayus);
document.getElementById("apellidos").addEventListener("keyup", mayus);

function mayus(){
	/* Se coge el value de nombre y apellidos y lo almacenamos en dos variables */
    var nombre = document.getElementById("nombre").value;
    var apellidos = document.getElementById("apellidos").value;
  	
  	/* Aquí se ponen las primeras letras de nombre y apellidos en mayúsculas */
    var capitalizeString = (str) => str[0].toUpperCase() + str.slice(1).toLowerCase();
    var capitalizeWords = (str) => str.split(" ").map(capitalizeString).join(" ");

    var upper = capitalizeWords(nombre);
    document.getElementById("nombre").value = upper;

    var uppers = capitalizeWords(apellidos);
    document.getElementById("apellidos").value = uppers;
}


	
