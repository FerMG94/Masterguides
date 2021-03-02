<!-- Fernando Morán González -->
<?php
session_start();
include 'paypal/config.php';
include 'paypal/conexion.php';
include 'carrito.php'; 

if(isset($_SESSION['id'])){
  include 'header2.php';
}else{
  include 'header.php';
}
  ?>
  

    <!-- Custon style -->
    <link rel="stylesheet" type="text/css" href="css/shop.css">

   

    <div class="container">
      <br>
      <?php if($mensaje!=""){ ?>
      <div class="alert alert-success">
        <?php echo $mensaje; ?>

        <a href="muestraCarrito.php" class="badge badge-success"></a>
      </div>
    <?php } ?>
      <h1>Guías</h1><br>
        <ol class="breadcrumb pt-1 pb-0 m-0">
                <li class="breadcrumb-item m-0" ><a class="ini" href="usuario.php">Inicio</a></li>
                <li class="breadcrumb-item m-0"><a class="resto">Shop</a></li>
        </ol><br>
        <form method="POST">
                <select class="form-control col-4" id="select_producto" name="select_producto">
                    <option value="0">Ordenar por...</option>
                    <optgroup id="general">
                        <option value="1">Precio: de más bajo a más alto</option>
                        <option value="2">Precio: de más alto a más bajo</option>
                    </optgroup>
                </select>
                <button class="btn mt-2" type="button" id="order" name="order">Ordenar</button>
            </form>
     <div class="row" id="orden">
     </div>
      <br>
      
      <?php include 'footer.php'; ?>