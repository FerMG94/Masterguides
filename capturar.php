<!-- Fernando Morán González -->
<?php
session_start();
require "controlDB.php";
include 'paypal/config.php';
include 'paypal/conexion.php';

// Recoge el nombre: insertar, modificar y eliminar
$funcion = $_REQUEST["funcion"];
/* Recoge id de usuario o producto */
if (isset($_GET['pparametro'])) 
{
	$pcod = $_GET['pparametro'];
}

if (isset($_GET['parametro'])) 
{
	$cod = $_GET["parametro"];
}

/* Si $funcion no es eliminar y el nombre del producto esta definido se mete en otra función en la que si $dfuncion es modificar me guarda en la variable $productocod el parámtro del producto (id). */
/* Después de eso se guardan en variables la información de los productos via $_POST */
if (($funcion != "eliminar") && (isset($_POST['pnombre']))) {
	if ($funcion == "modificar"){
		$productocod = $_POST["pcod"];
	}

	$pnombre = $_POST['pnombre'];
	$precio = $_POST['pprecio'];
	$descripcion = $_POST['pdescripcion'];
	$imagen = $_POST['pimagen'];
	
}
/* lo mismo que arriba */
if (($funcion != "eliminar") && (isset($_POST['txtnombre']))) {
	if ($funcion == "modificar"){
		$usercod = $_POST["cod"];
	}

	$nombre = $_POST["txtnombre"];
	$apellidos = $_POST["txtapellidos"];
	$email = $_POST["txtemail"];
	if(isset($_POST['txtcontrasena'])){
		$contrasena = $_POST["txtcontrasena"];
	}
}

/* Instancia controlDB */
$obj = new controlDB();

/* Si $funcion es modificar y la sesión pcod esta definida me hace un update en los productos */
if (($funcion == "modificar") && (isset($_POST["pcod"]))){
	$query = "UPDATE productos SET nombre = '$pnombre', precio = '$precio', descripcion = '$descripcion', imagen = '$imagen' WHERE id = $productocod";
	$obj->actualizar($query);

/* Eliminar */
}else if ($funcion == "eliminar" && isset($_GET["pparametro"])){
	$query = "DELETE FROM productos WHERE id = '$pcod'";
	$obj->actualizar($query);


}else if ($funcion == "insertar" && isset($_POST["insertar"])){
	$query = "INSERT INTO productos(nombre, precio, descripcion, imagen) VALUES ('$pnombre', '$precio', '$descripcion', '$imagen')";
	$obj->actualizar($query);
}

if (($funcion == "modificar") && (isset($_POST["cod"]))) {
	if(isset($_POST['txtcontrasena'])){
		$contrasena = $_POST["txtcontrasena"];
		/* Encriptación de contraseña */
		$contrasena = password_hash($contrasena, PASSWORD_BCRYPT);
		$sql="UPDATE cliente set contrasena='$contrasena' WHERE id='$usercod'";
		$obj->actualizar($sql);
	}
	$sql="UPDATE cliente set nombre='$nombre', apellidos='$apellidos', email='$email' WHERE id='$usercod'";
	$obj->actualizar($sql);

}else if ($funcion == "eliminar" && isset($_GET["parametro"])) {
	$sql="delete from cliente where id='$cod'";
	$sqlo="delete from comentarios where usuario='$cod'";
	$obj->actualizar($sql);
	$obj->actualizar($sqlo);

}else if (($funcion == "insertar") && isset($_POST["insercion"])){
	$contrasena = password_hash($contrasena, PASSWORD_BCRYPT);
	$sql = "INSERT INTO cliente(nombre,apellidos,email,contrasena,rol) values ('$nombre','$apellidos','$email','$contrasena','usuario')";
	$obj->actualizar($sql);
}

echo "registro realizado";
/* Si el rol es usuario, recojo el id del usuario y al redirigirme a usuario.php saldrá el nombre del usuario en la parte superior */
if($_SESSION['rol'] == 'usuario'){
	$hola = $_SESSION['id'];
	$coment = $pdo->prepare("SELECT * FROM cliente WHERE id = $hola");
	$coment->execute();
	$producto = $coment->fetch(PDO::FETCH_ASSOC);
	$_SESSION['nombre'] = $producto['nombre'];
	/* Redirección a usuario.php */
	header("location: usuario.php");
}else{
	/* Redirección a admin.php */
	header("location: admin.php");
}
?>