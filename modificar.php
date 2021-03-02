<!-- Fernando Morán González -->
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Custon style -->
<link rel="stylesheet" type="text/css" href="css/registration.css">

<title>Modificar</title>
</head>
<?php include("menu.php"); ?>

<body>
<?php
/* La variable pcod va a redirigirnos a la página cogiendo como parámetro el id de producto
La variable cod va a redirigirnos a la página cogiendo como parámetro el id de usuario */
if (isset($_GET['pparametro'])) 
    {
        $pcod = $_GET['pparametro'];
    }

    if (isset($_GET['parametro'])) 
    {
        $cod = $_GET["parametro"];
    }

/* Conexión con la BBDD*/
require "controlDB.php";

$obj = new controlDB();

if (isset($_GET['pparametro'])) 
    {
    	/* $insertar me va a guardar la información del select, en el que el id de producto sea igual que $pcod */
        $insertar = $obj->consultar("select * from productos where id = $pcod");
    }

    if (isset($_GET['parametro'])) 
    {
    	/* $data me va a guardar la información del select, en el que el id de usuario sea igual que $cod */
        $data = $obj->consultar("select * from cliente where id = $cod");
    }



?>
<div class="container-fluid bg">
	<div class="row">
		<div class="col-md-4 col-sm-4 col-xs-12"></div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<?php if (isset($cod)){ ?>
			<form class="needs-validation" novalidate action="capturar.php" method="post">
				<!-- Recorremos el array $data -->
				<?php 
				foreach ($data as $fila) {?>
				<div class="col-12 log"><a href="usuario.php" title="Vuelta a la página principal"><img src="logo/logo.png" class="logo"></a></div>
				<h1>Modificar</h1>
				<div class="form-group">
					<label for="Id">Id</label>
					<?php echo $cod; ?>
				</div>
				<div class="form-group">
					<label for="Nombre">Nombre</label>
					<input type="text" value="<?php echo $fila["nombre"]; ?>" name="txtnombre" class="form-control" id="nombre" placeholder="Nombre" required pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$">
					<div class="invalid-feedback">
          				Por favor, escriba su nombre.
        			</div>
				</div>
				<div class="form-group">
					<label for="Apellidos">Apellidos</label>
					<input type="text" value="<?php echo $fila["apellidos"]; ?>" name="txtapellidos" class="form-control" id="inputApellidos" placeholder="Apellidos" required pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$">
					<div class="invalid-feedback">
          				Por favor, escriba sus apellidos.
        			</div>
				</div>
				<div class="form-group">
					<label for="Email">Email</label>
					<input type="email" value="<?php echo $fila["email"]; ?>" name="txtemail" class="form-control" id="inputEmail" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
					<div class="invalid-feedback">
          				Por favor, escriba su email.
          				No se permiten espacios o mayúsculas.
        			</div>
				</div>
				<?php if($_SESSION['rol']=='usuario'){ ?>
					<div class="form-group">
						<label for="Contraseña">Contraseña</label>
						<input type="password" name="txtcontrasena" class="form-control" id="inputPassword" placeholder="Contraseña" required>
						<div class="invalid-feedback">
	          				Por favor, escriba su contraseña.
	        			</div>
					</div>
				<?php } ?>
				
				<button type="submit" class="btn btn-success btn-block">Modificar</button>
			<?php } ?>
			<input type="hidden" name="funcion" value="modificar">
			<input type="hidden" name="cod" value="<?php echo $cod; ?>">
			</form>
			<?php } ?>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12"></div>
		</div>

	<div class="row">
		<div class="col-md-4 col-sm-4 col-xs-12"></div>
		<div class="col-md-4 col-sm-4 col-xs-12">
		<?php if (isset($pcod)){ ?>
			<form class="needs-validation" novalidate action="capturar.php" method="post">
				<!-- Recorremos el array $insertar -->
				<?php 
				foreach ($insertar as $fill) {?>
				<div class="col-12 log"><a href="usuario.php" title="Vuelta a la página principal"><img src="logo/logo.png" class="logo"></a></div>
				<h1>Modificar</h1>
				<div class="form-group">
					<label for="Id">Id</label>
					<?php echo $pcod; ?>
				</div>
				<div class="form-group">
					<label for="Nombre">Nombre</label>
					<input type="text" value="<?php echo $fill["nombre"]; ?>" name="pnombre" class="form-control" id="pnombre" placeholder="Nombre" required>
				</div>
				<div class="form-group">
					<label for="Precio">Precio</label>
					<input type="text" value="<?php echo $fill["precio"]; ?>" name="pprecio" class="form-control" id="pprecio" placeholder="Precios" required>
				</div>
				<div class="form-group">
					<label for="Descripcion">Descripcion</label>
					<input type="text" value="<?php echo $fill["descripcion"]; ?>" name="pdescripcion" class="form-control" id="pdescripcion" placeholder="Descripcion" required>
				</div>
				<div class="form-group">
					<label for="Imagen">Imagen</label>
					<input type="text" value="<?php echo $fill["imagen"]; ?>" name="pimagen" class="form-control" id="pimagen" placeholder="Imagen" required>
				</div>
				<?php if($_SESSION['rol']=='usuario'){ ?>
					<div class="form-group">
						<label for="Contraseña">Contraseña</label>
						<input type="password" name="txtcontrasena" class="form-control" id="inputPassword" placeholder="Contraseña" required>
						<div class="invalid-feedback">
	          				Por favor, escriba su contraseña.
	        			</div>
					</div>
				<?php } ?>
				
				<button type="submit" class="btn btn-success btn-block">Modificar</button>
			<?php } ?>
			<input type="hidden" name="funcion" value="modificar">
			<input type="hidden" name="pcod" value="<?php echo $pcod; ?>">
			</form>
		<?php } ?>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12"></div>
	</div>
</div>


<!-- Optional JavaScript -->
<script type="text/javascript" src="js/registro.js"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
</body>
</html>