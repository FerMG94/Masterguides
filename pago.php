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

<link rel="stylesheet" type="text/css" href="css/pago.css">
<?php
/* Recibir los productos de carrito */
if($_POST){
	/* $total es lo que vamos a cobrar al usuario, se inicializa en 0 */
	$total=0;
	/* carrito genera una sesión, y esa misma se guarda en session_id() */
	$SID=session_id();
	$correo=$_POST['email'];

	foreach ($_SESSION['carrito'] as $indice => $producto) {
		$total=$total+($producto['precio']*$producto['cantidad']);
	}

	$sentencia=$pdo->prepare("INSERT INTO `ventas` (`id`, `clave`, `datos`, `fecha`, `correo`, `total`, `status`) VALUES (NULL, :clave, '', NOW(), :correo, :total, 'pendiente')");

	$sentencia->bindParam(":clave",$SID);
	$sentencia->bindParam(":correo",$correo);
	$sentencia->bindParam(":total",$total);
	$sentencia->execute();
	/* Me devuelve el último id insertado */
	$idVenta=$pdo->lastInsertId();
	
	foreach ($_SESSION['carrito'] as $indice => $producto) {

		$sentencia=$pdo->prepare("INSERT INTO `detalleventas` (`id`, `idventa`, `idproducto`, `precio`, `cantidad`, `descargado`) VALUES (NULL, :idventa, :idproducto, :precio, :cantidad, '0')");
		/* Id venta viene de la inserción del ultimo registro */
		$sentencia->bindParam(":idventa",$idVenta);
		$sentencia->bindParam(":idproducto",$producto['id']);
		$sentencia->bindParam(":precio",$producto['precio']);
		$sentencia->bindParam(":cantidad",$producto['cantidad']);
		$sentencia->execute();

	}
// echo "<h3>".$total."</h3>";
}
?>
<div class="container">
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>

	<style>
		/* Media query for mobile viewport */
		@media screen and (max-width: 400px) {
			#paypal-button-container {
				width: 100%;
			}
		}
		/* Media query for desktop viewport */
		@media screen and (min-width: 400px) {
			#paypal-button-container {
				width: 250px;
				display: inline-block;
			}
		}
	</style>
	<div class="jumbotron text-center light">
		<h1 class="display-4">Paso final</h1>
		<hr class="my-4 color">
		<p class="lead color">Se accederá a pagar a través de Paypal la cantidad de: 
			<h5 class="mb-3"><?php echo number_format($total,2); ?>€</h4>
				<div id="paypal-button-container"></div>
			</p>
			<p class="color">Los productos serán descargados una vez esté procesado el pedido</p>
		</div>
	</div>
	<!-- Include the PayPal JavaScript SDK -->
	<!--<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>-->

	<script>
		/* Botón de Paypal */
		paypal.Button.render({
			env: 'sandbox',
			style: {
				label: 'checkout',
				size: 'responsive',
				shape: 'pill',
				color: 'blue'
			},

			client:{
				/* Cuenta cliente */
				sandbox:'AUmzKi8YHW8ZteAJTWjHqOdE0ypID4UcPzkPVDMaQciHFKA7SmnQ-EKsI8tXDhRDOXABGyUVK4seK_wE',
				/* Cuenta vendedor */
				production: '<insert production client id>'
			},

			payment: function(data, actions){
				return actions.payment.create({
					payment: {
						transactions: [
						{
							amount: { total: '<?php echo $total;?>', currency: 'EUR'},
							custom:"<?php echo $SID; ?>#<?php echo openssl_encrypt($idVenta,COD,KEY); ?>"
						}
						]
					}
				});
			},

			onAuthorize: function(data, actions){
				return actions.payment.execute().then(function(){
					console.log(data);
					window.location = "verificador.php?paymentToken="+data.paymentToken+"&paymentID="+data.paymentID;
				});
			}

		}, '#paypal-button-container');
	</script>



	<br>
	<?php include 'footer.php'; ?>