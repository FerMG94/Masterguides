<!-- Fernando Morán González -->
<?php 
session_start();
include 'paypal/config.php';
include 'paypal/conexion.php'; 

if(isset($_SESSION['id'])){
  include 'header2.php';
}else{
  include 'header.php';
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