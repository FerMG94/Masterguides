<!-- Fernando Morán González -->
<?php session_start(); 
/* Si el id de la sesión no está definido, la página te redirige a index.php */
if(!isset($_SESSION['id'])){
	header('Location: index.php');
}
?> 
<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- Custon style -->
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<title>Administracion</title>
</head>
<?php include("menu.php"); ?>

<body>
	<?php
	require "controlDB.php";
	/* Instacia de controlDB() */
	$obj = new controlDB();
	/* $datos variable que guarda información de la consulta de la tabla cliente
	$insertar variable que guarda información de la consulta de la tabla productos*/
	$datos = $obj->consultar("select * from cliente");
	$insertar = $obj->consultar("select * from productos");

	?>
	<div class="container">
		<h2 class="mt-4">Lista de usuarios</h2>
		<table class="table table-light mt-4" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>ID</td>
				<td>NOMBRE</td>
				<td>APELLIDOS</td>
				<td>EMAIL</td>
				<td>FECHA</td>
				<td>MODIFICAR</td>
				<td>ELIMINAR</td>
				<td>ROL</td>
			</tr>
			<!-- Aquí es donde se muestra la información de la BBDD -->
			<!-- Se recorrerán esos datos mediante un foreach -->
			<?php foreach ($datos as $fila) {?>
				<tr>
					<td><?php echo $fila["id"]; ?></td>
					<td><?php echo $fila["nombre"]; ?></td>
					<td><?php echo $fila["apellidos"]; ?></td>
					<td><?php echo $fila["email"]; ?></td>
					<td><?php echo $fila["fecha"]; ?></td>
					<td><img class="edit" src="images/editar.png" onclick="modificar(<?php echo $fila["id"]; ?>)"></td>
					<td><img class="editar" src="images/eliminar.png" onclick="eliminar(<?php echo $fila["id"]; ?>)"></td>
					<td><?php echo $fila["rol"]; ?></td>
				</tr>
			<?php } ?>
		</table>
		<h2 class="mt-4">Productos</h2>
		<table class="table table-light mt-4" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>ID</td>
				<td>NOMBRE</td>
				<td>PRECIO</td>
				<td>DESCRIPCION</td>
				<td>IMAGEN</td>
				<td>MODIFICAR</td>
				<td>ELIMINAR</td>
			</tr>
			<!-- Aquí es donde se muestra la información de la BBDD -->
			<!-- Se recorrerán esos datos mediante un foreach -->
			<?php foreach ($insertar as $fill) {?>
				<tr>
					<td><?php echo $fill["id"]; ?></td>
					<td><?php echo $fill["nombre"]; ?></td>
					<td><?php echo $fill["precio"]; ?></td>
					<td><?php echo $fill["descripcion"]; ?></td>
					<td><img src="./<?php echo $fill["imagen"];?>" width="150"></td>
					<td><img class="edit" src="images/editar.png" onclick="modificarproducto(<?php echo $fill["id"]; ?>)"></td>
					<td><img class="editar" src="images/eliminar.png" onclick="eliminarproducto(<?php echo $fill["id"]; ?>)"></td>
				</tr>
			<?php } ?>
		</table>
	</div>







	<!-- Optional JavaScript -->
	<script type="text/javascript" src="js/admin.js"></script>


	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
</body>
</html>














</body>
</html>