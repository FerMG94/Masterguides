    <!-- Fernando Morán González -->
    <?php
    session_start();
    include 'paypal/config.php';
    include 'paypal/conexion.php'; 
    include 'carrito.php';
    /* Si la variable esta definida, me lleva a header2.php, si no, me lleva a header.php */
    if(isset($_SESSION['id'])){
      include 'header2.php';
    }else{
      include 'header.php';
    }
    /* En el caso de que guardar este verificado el header hace una redireccion hacia detalles.php pero con el id del usuario */
    if (isset($_POST['guardar']))
    {
      header("Location: detalles.php?parametro=$_GET[parametro]");
    }
    $cod = $_GET["parametro"];
    ?>

      <link rel="stylesheet" type="text/css" href="css/detalles.css">

    <div class="container">
      <?php if($mensaje!=""){ ?>
        <div class="alert alert-success">
          <?php echo $mensaje; ?>

          <a href="muestraCarrito.php" class="badge badge-success"></a>
        </div>
      <?php } ?>
      <ol class="breadcrumb pt-1 pb-0 m-0">
        <li class="breadcrumb-item m-0" ><a class="ini" href="usuario.php">Inicio</a></li>
        <li class="breadcrumb-item m-0"><a class="resto">Shop</a></li>
        <li class="breadcrumb-item m-0"><a class="resto">Tienda</a></li>
      </ol></div>
      <div class="container">
        <div class="row">
          <?php 
          $sentencia=$pdo->prepare("SELECT * FROM productos where id='$cod'");
          $sentencia->execute();
          $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
          // print_r($listaProductos);
          ?>
          <?php foreach($listaProductos as $producto){ ?>
            <div class="col-12 col-xl-6 mt-5">
              <div class="card text-center">
                <img 
                title="<?php echo $producto['nombre'];?>" 
                alt="<?php echo $producto['nombre'];?>" 
                class="card-img-top" 
                src="<?php echo $producto['imagen'];?>">
                <div class="card-body">
                  <span><h3>Guía <?php echo $producto['nombre'];?></h3></span>
                  <h5 class="card-title"><?php echo $producto['precio'];?>€</h5>
                  <p class="description"><?php echo $producto['descripcion'];?></p>
                  <form action="" method="post">
                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY);?>">
                    <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], COD, KEY);?>">
                    <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'], COD, KEY);?>">
                    <!-- En cantidad seleccionamos 1, dado que si es una guía lo que vamos a descargar, se podrá descargar sólamente 1 vez por ejemplar -->
                    <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY);?>">

                    <?php 
                    /* En el caso de que $_SESSION['id'] este definido aparece el botón */
                    if(isset($_SESSION['id'])){ ?>
                      <button class="btn btn-primary" name="btnAccion" value="agregar" type="submit">Comprar</button>
                    <?php } ?>
                  </form> 
                </div>
              </div>
            </div>


            <!-- Comentarios -->
            <?php if (isset($cod)){ ?>          
              <div class="col-12 col-xl-6 mt-5">         
                <?php
                $comentar = $pdo->prepare("SELECT * FROM comentarios WHERE idproducto = $cod ORDER BY id DESC");
                $comentar->execute();
                $coms = $comentar->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <h4 id="observaciones">Comentarios (<?php echo count($coms)?>)</h4>
                <br>

                <?php
                foreach ($coms as $com) 
                {
                  $user = $pdo->prepare("SELECT * FROM cliente WHERE id = '".$com['usuario']."'");
                  $user->execute();
                  $us = $user->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <!-- Visualización -->
                  <div class="row">
                    <!-- Nombre de usuario y fecha en los comentarios -->
                    <div class="col-12 nombre">
                      <?php echo $us['nombre'];?>
                      <span class="fec"><small><em><?php echo $com['fecha'];?></em></small></span>
                    </div>

                    <!-- Columna de comentarios -->
                    <div class="col-12 coment">
                      <span id="com_com"><?php echo $com['comentario'];?></span>
                    </div>
                  </div>
                  <hr>

                  <?php 
                } 
                if (isset($_SESSION['id'])) { ?>   
                  <div class="row">
                    <!-- Escribir y mandar comentarios -->
                    <div class="col-12">    
                      <form action="" method="post">
                        <p>
                          <textarea name="comentario" id="comentario" cols="50" rows="3" placeholder=" Deja tu opinión aquí"></textarea>
                        </p>
                        <p>
                          <input class="btn" type="submit" name="guardar" value="Comentar">
                        </p>
                      </form>
                    </div>
                  </div>

                  <?php
                } else {
                  ?>

                  <p>Es necesario estar logueado para poder mandar comentarios. <a class="iden" href="login.php">Identifícate.</a></p>

                <?php }
                /* Para que entre es necesario que exista guardar y que además el comentario que se mande no esté vacio */
                if (isset($_POST['guardar']) && $_POST['comentario'] != '') 
                { 
                  /* Se insertan los comentarios */     
                  $insert = $pdo->prepare("INSERT INTO comentarios (comentario, idproducto, usuario, fecha) VALUES ('".$_POST['comentario']."', $cod, '".$_SESSION['id']."', NOW())");

                  $insert->execute();
                  ?>
                <?php } 
                ?>
              </div>       
              <?php } ?>          </div>
            <?php } ?>
            <br>
            <br>
            <?php
            include 'footer.php';
            ?>