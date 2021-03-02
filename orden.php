<?php
session_start();
include 'paypal/config.php';
include 'paypal/conexion.php';
include 'carrito.php';

$ordenado = '';
/* Si producto no esta definido, me hace un select de productos order by id */
if(!isset($_POST['producto']) )
{
	$sentencia = $pdo->prepare("SELECT * FROM productos ORDER BY id");
}else{
	/* En el caso de que este definido me coge el value de options y me lo ordena dependiendo del value */
	if ($_POST['producto'] == "1" )
	{
		$sentencia = $pdo->prepare("SELECT * FROM productos  ORDER BY precio ASC");
	}

	if ($_POST['producto'] == "2" )
	{
		$sentencia = $pdo->prepare("SELECT * FROM productos ORDER BY precio DESC");
	}

}

$sentencia->execute();
$listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
/* En el caso de que no haya productos, se muestra "no se han encontrado resultados" */
if (count($listaProductos) == 0) {
	?>		
	<p><b>No se han encontrado resultados</b></p>		
	
	<?php 
}
?>
<!-- Se recorre listaproductos -->
<?php foreach($listaProductos as $producto){ 
	$ordenado .= '<div class="col-12 col-md-3 col-sm-3 mt-4 mb-4">
	<div class="card text-center">
	<img title="' . $producto['nombre'] . '"
	alt="'. $producto['nombre'].'"
	class="card-img-top"
	src="'.$producto['imagen'].'"
	data-placement="right"
	data-toggle="popover"
	data-trigger="hover"
	data-content="'. $producto['descripcion'].'"
	onclick="detalles('.$producto['id'].')"
	>

	<div class="card-body m-0">
	<span class="nombre_producto">' .$producto['nombre'].'</span>
	<h5 class="card-title">'.$producto['precio'].'€</h5>';
	/* En el caso de que el id este definido me muestra el botón de compra */
	if (isset($_SESSION['id'])) {
		$ordenado .= '<form action="" method="post">
		<input type="hidden" name="id" id="id" value="'.openssl_encrypt($producto["id"], COD, KEY).';">
		<input type="hidden" name="nombre" id="nombre" value="'.openssl_encrypt($producto["nombre"], COD, KEY).';">
		<input type="hidden" name="precio" id="precio" value="'.openssl_encrypt($producto["precio"], COD, KEY).';">
		<input type="hidden" name="cantidad" id="cantidad" value="'.openssl_encrypt(1, COD, KEY).';">
		
		<button class="btn" id="dropdownMenuButton" name="btnAccion" value="agregar" type="submit">Comprar</button>
		</form>';
	}
	
	$ordenado .= '</div>
	</div>
	</div>';
}


echo $ordenado;
?>