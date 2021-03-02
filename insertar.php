<!-- Fernando Morán González -->
<!DOCTYPE html>
<?php 
	session_start();
	/* Si recoge el id me incluye menu.php */
	if(isset($_SESSION['id'])){
		include("menu.php");
	}
?>
<html lang="es">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Custon style -->
<link rel="stylesheet" type="text/css" href="css/registration.css">

<title>Insertar</title>
</head>
<body>
<div class="container-fluid bg">
	<div class="row">
		<div class="col-md-4 col-sm-4 col-xs-12"></div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<form class="needs-validation" novalidate action="capturar.php" method="post">
				<div class="col-12 log"><a href="index.php" title="Vuelta a la página principal"><img src="logo/logo.png" class="logo"></a></div>
				<h1>Insertar</h1>
				<div class="form-group">
					<label for="Nombre">Nombre</label>
					<input type="text" name="pnombre" class="form-control" id="pnombre" placeholder="Nombre" required>
				</div>
				<div class="form-group">
					<label for="Precio">Precio</label>
					<input type="text" name="pprecio" class="form-control" id="pprecio" placeholder="Precio" required>
				</div>
				<div class="form-group">
					<label for="Descripcion">Descripcion</label>
					<input type="text" name="pdescripcion" class="form-control" id="descripcion" placeholder="Descripcion" required>
				</div>
				<div class="form-group">
					<label for="Imagen">Imagen</label>
					<input type="text" name="pimagen" class="form-control" id="pimagen" placeholder="Imagen" required>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success btn-block">Insertar</button>
				</div>
					<input type="hidden" name="funcion" value="insertar">
                    <input type="hidden" name="insertar">
			</form>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12"></div>
	</div>
</div>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<!-- Optional JavaScript -->
<script type="text/javascript" src="js/registros.js"></script>
</body>
</html>