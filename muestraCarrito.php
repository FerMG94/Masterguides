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

<div class="container">
  <br>
  <h3>Lista del carrito</h3>
  <link rel="stylesheet" type="text/css" href="css/muestra.css">

  <!-- Validar si existe algo en el carrito de compras -->
  <?php if(!empty($_SESSION['carrito'])) { ?>
    <table class="table table-light mt-4 mb-4">
      <tbody>
        <tr>
          <th width="40%">Producto</th>
          <th width="15%" class="text-center">Cantidad</th>
          <th width="20%" class="text-center">Precio</th>
          <th width="20%" class="text-center">Total</th>
          <th width="5%"></th>
        </tr>
        <?php $total=0; ?>
        <!-- foreach me recorre carrito y me va posicionando los productos adquiridos en la tabla -->
        <?php foreach($_SESSION['carrito'] as $indice=>$producto){?>
          <tr>
            <td width="40%"><?php echo $producto['nombre'];?></td>
            <td width="15%" class="text-center"><?php echo $producto['cantidad'];?></td>
            <td width="20%" class="text-center"><?php echo $producto['precio'];?></td>
            <td width="20%" class="text-center"><?php echo number_format($producto['precio'] * $producto['cantidad'],2);?></td>
            <td width="5%">
              <form action="" method="post">
                <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY);?>">
                <button 
                class="btn btn-danger" 
                type="submit"
                name="btnAccion"
                value="eliminar">
              Eliminar</button>
            </form>
          </td>
        </tr>
        <?php $total=$total+($producto['precio'] * $producto['cantidad']); ?>
      <?php } ?>
      <tr>
        <td colspan="3" align="right"><h3 id="total">Total</h3></td>
        <td align="right"><h3 id="total">€<?php echo number_format($total,2);?></h3></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="5">
          <form action="pago.php" method="post">
            <div class="alert alert-info mt-4">
              <div class="form-group">
                <label for="my-input">Contacto: </label>
                <input id="email" name="email" class="form-control" type="email" placeholder="Escribe aquí tu correo" required>
                <button class="btn btn-lg btn-block mt-4 mb-2" id="dropdownMenuButton" type="submit" value="proceder" name="btnAccion">
                  Proceder al pago 
                </button>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
    <?php }else{ ?>
      <div class="alert alert-info">
        No hay productos en el carrito.
      </div>  
    <?php } ?>  
  </div>




  <?php include 'footer.php'; ?>
  