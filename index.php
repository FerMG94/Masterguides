<!-- Fernando Morán González -->
<?php include 'header.php';
/* Aquí se crea la base de datos y las tablas en el caso de que no existan, también he añadido un insert de administrador para que 
al crearse la base de datos se cree una cuenta con rol de administrador, lo único que hay que hacer si quieres registrar a un usuario
es entrar en la zona de administración y registrar ahi un usuario o también se puede introducir desde PHPMYADMIN */
session_start();
include 'paypal/config.php';
include 'paypal/conexion.php';

$pdo->query("CREATE DATABASE IF NOT EXISTS masterguides");
$pdo->query("use masterguides");

$cliente = ("CREATE TABLE IF NOT EXISTS cliente (
  id int(11) AUTO_INCREMENT NOT NULL,
  nombre varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  apellidos varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  email varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  contrasena varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  fecha timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  rol varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY(id))
");
$pdo->exec($cliente);

$comentarios = ("CREATE TABLE IF NOT EXISTS comentarios (
  id int(11) AUTO_INCREMENT NOT NULL,
  comentario varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  idproducto int(11) NOT NULL,
  usuario int(11) NOT NULL,
  fecha date NOT NULL,
  PRIMARY KEY (id))
");
$pdo->exec($comentarios);

$productos = ("CREATE TABLE IF NOT EXISTS productos (
  id int(11) AUTO_INCREMENT NOT NULL,
  nombre varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  precio decimal(20,2) NOT NULL,
  descripcion text COLLATE utf8_spanish_ci NOT NULL,
  imagen varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (id))
");
$pdo->exec($productos);

$ventas = ("CREATE TABLE IF NOT EXISTS ventas (
  id int(11) AUTO_INCREMENT NOT NULL,
  clave varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  datos text COLLATE utf8_spanish_ci NOT NULL,
  fecha datetime NOT NULL,
  correo varchar(5000) COLLATE utf8_spanish_ci NOT NULL,
  total decimal(60,2) NOT NULL,
  status varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (id))
");
$pdo->exec($ventas);

$detalleventas = ("CREATE TABLE IF NOT EXISTS detalleventas (
  id int(11) AUTO_INCREMENT NOT NULL,
  idventa int(11) NOT NULL,
  idproducto int(11) NOT NULL,
  precio decimal(20,2) NOT NULL,
  cantidad int(11) NOT NULL,
  descargado int(1) NOT NULL,
  PRIMARY KEY (id))
");
$pdo->exec($detalleventas);

if(isset($cliente))
{
    $records = $pdo->prepare('SELECT * FROM cliente');

    $records->execute();

    $results = $records->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) == 0) 
    {
        $sql = "INSERT INTO cliente (nombre, apellidos, email, contrasena, rol) VALUES ('Admin','Admin','admin@admin.com','admin','admin')";
        $stmt= $pdo->prepare($sql);
        $stmt->execute();
    }
}

?>
<style media="screen">
  .carousel-cell {
    width: auto;
    }

    /* cell number */
    .carousel-cell:before {
      display: block;
    }
  </style>
  <section>
    <div class="contenedor">
      <div class="row">
        <div class="col-lg-12">
          <h1>Bienvenidos a MasterGuides.</h1><hr>
          <p class="mt-4 lead">Tu sitio web dedicado a la venta de cualquier tipo de guía de videojuegos que pueda interesarte.</p>
          <p>¡Síguenos en nuestras redes sociales!</p>
          <ul class="list-inline">
            <li class="list-inline-item" title="Instagram"><a href="https://www.instagram.com" class="iconos"><iconify-icon data-icon="ion:logo-instagram"></iconify-icon></a></li>
            <li class="list-inline-item" title="Twitter"><a href="https://www.twitter.com" class="iconos"><iconify-icon data-icon="ion:logo-twitter"></iconify-icon></a></li>
            <li class="list-inline-item" title="Facebook"><a href="https://www.facebook.com" class="iconos"><iconify-icon data-icon="ant-design:facebook-filled"></iconify-icon></a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="pt-5">
    <div class="container">
      <h1>Mi Tienda</h1><hr>
      <p>¡Entra y observa la gran variedad de guías que ofrecemos!</p>
      <div class="row mt-5">
        <div class="col-md-12">
          <div class="container1">
            <a href="shop.php" class="mt-3">
              <img class="tienda" src="images/shop.png" class="img-fluid rounded">
              <div class="overlay">
                <div class="text mx-auto">Tienda</div>
              </div>
            </a>
        </div>
      </div>
    </div>
  </div>
  </section>

   <section class="pt-5">
    <div class="container">
      <h1>Sobre mi</h1><hr>
      <p>¡Descubre al desarrollador de esta página!</p>
      <div class="row mt-5">
        <div class="col-md-12">
          <div class="container1">
            <a href="about.php" class="mt-3">
              <img class="tienda" src="images/about.png" class="img-fluid rounded">
              <div class="overlay">
                <div class="text">Sobre mi</div>
              </div>
            </a>
        </div>
      </div>
    </div>
  </section>

  <section class="pt-5">
    <div class="container">
      <h1>Mis productos</h1><hr>
      <p class="mb-5">Estos son algunos de los productos que ofrecemos</p>
    <div class="carousel mt-4" data-flickity='{ "wrapAround": true, "autoPlay": true }'>
      <div class="carousel-cell">
        <img src="images/1.jpg">
      </div>
      <div class="carousel-cell">
        <img src="images/3.jpg">
      </div>
      <div class="carousel-cell">
        <img src="images/5.jpg">
      </div>
      <div class="carousel-cell">
        <img src="images/7.jpg">
      </div>
    </div>
     </div>
</section>

<!-- CSS -->
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

<!-- JavaScript -->
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<?php include 'footer.php'; ?>
  