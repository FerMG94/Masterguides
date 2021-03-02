<!-- Fernando Morán González -->
<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custon style -->
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <title>MasterGuides</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand mx-3" href="usuario.php"><img src="logo/logo.png" class="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-3">
            <div class="dropdown">
              <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Bienvenido, <?php echo $_SESSION['nombre']; ?>
              </button>
              <?php 
              $hola = $_SESSION['id'];
              $coment = $pdo->prepare("SELECT * FROM cliente WHERE id = $hola");
                                $coment->execute();
                                $producto = $coment->fetch(PDO::FETCH_ASSOC);
              ?>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <!-- Si te registras con rol de de admin, puedes acceder a la zona de administración y si eres usuario podrás acceder a la zona de modificar tus datos -->
                <?php if($_SESSION['rol'] == 'admin'){?> 
                <a class="dropdown-item" href="admin.php">Zona de administración</a>
                <?php } ?></a>
                <?php if($_SESSION['rol'] == 'usuario'){?> 
                <a class="dropdown-item" onclick="perfil(<?php echo $producto['id']; ?>)">Modificar datos</a>
                <?php } ?></a>
                <a class="dropdown-item"href="logout.php">Cerrar sesión</a>
              </div>
                <li class="nav-item mx-3">
              <a class="nav-link" href="muestraCarrito.php">Carrito(<?php echo (empty($_SESSION['carrito']))?0:count($_SESSION['carrito']); ?>)</a>
            </li>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>