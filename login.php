<!-- Fernando Morán González -->
<?php
session_start();
include 'paypal/config.php';
include 'paypal/conexion.php';


if(!isset($_POST['my-captcha'])){
	/* Captcha */
	/* Se crean números aleatorios */
	$captcha = rand(111111,999999); 
	/* Se guardan esos números en la sesión captcha */
	$_SESSION['captcha'] = $captcha;
}

if (!empty($_POST['email']) && !empty($_POST['contrasena'] && !empty($_POST['my-captcha'])))
{	
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    $records = $pdo->prepare('SELECT * FROM cliente WHERE email=:email');
    $records->bindParam(':email', $_POST['email']);

    $records->execute();

    $results = $records->fetch(PDO::FETCH_ASSOC);
    /* Se comprueba que la sesión y el input del captcha sea igual al value de la sesión del captcha y además que las contraseñas coincidan*/
    if (isset($_SESSION['captcha']) and $_POST['my-captcha'] == $_SESSION['captcha'] && $results > 0 && password_verify($_POST['contrasena'], $results['contrasena'])) 
        {
        	unset($_SESSION['captcha']);
            /* Sesiones */
            $_SESSION['id'] = $results['id'];
            $_SESSION['rol'] = $results['rol'];
            $_SESSION['nombre'] = $results['nombre'];

            header('Location: usuario.php');
        }
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
<link rel="stylesheet" type="text/css" href="css/login.css">

<title>Login</title>
</head>

<body>
<div class="container-fluid bg">
	<div class="row">
		<div class="col-sm-4 col-xs-12"></div>
		<div class="col-sm-4 col-xs-12">
			<form class="needs-validation" novalidate method="post">
				<div class="col-12 log"><a href="index.php" title="Vuelta a la página principal"><img src="logo/logo.png" class="logo"></a></div>
				<h1>Identifícate</h1>
				<div class="form-group">
					<label for="Email">Email</label>
					<input name="email" id="email" type="email" class="form-control" id="inputEmail" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
					<div class="invalid-feedback">
          				Por favor, escriba su email.
          				No se permiten espacios o mayúsculas.
        			</div>
				</div>
				<div class="form-group">
					<label for="Contraseña">Contraseña</label>
					<input name="contrasena" id="contrasena" type="password" class="form-control" class="inputPass" placeholder="Contraseña" required>
					<div class="invalid-feedback">
          				Por favor, escriba su contraseña.
        			</div>
				</div>
				<div>
					<p>Captcha:</p>
					<p><img class="center" src="image.php?captcha_text=<?php echo $_SESSION['captcha']; ?>"></p>
					<p><input type="" name="my-captcha" value="" required></p>
				</div>
				<button type="submit" class="btn btn-success btn-block">Identifícame</button><br>
				¿Aún no tienes cuenta? <a href="registro.php">Regístrate</a>
			</form>
		</div>
	</div>
</div>


<!-- Optional JavaScript -->
<script type="text/javascript" src="js/login.js"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
</body>
</html>