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
<link rel="stylesheet" type="text/css" href="css/verificador.css">
<?php
/* Para coger el documento pdf es necesario nombrar el pdf con el id del producto que se desea */
if($_POST){
	$idventa= openssl_decrypt($_POST['idventa'],COD,KEY);
	$idproducto=openssl_decrypt($_POST['idproducto'],COD,KEY);

	$sentencia=$pdo->prepare("SELECT * FROM detalleventas
		WHERE idventa=:idventa
		AND idproducto=:idproducto
		AND descargado<".DESCARGASPERMITIDAS);

	$sentencia->bindParam(":idventa",$idventa);
	$sentencia->bindParam(":idproducto",$idproducto);
	$sentencia->execute();

	$listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);


	if($sentencia->rowCount()>0){
		/* Cuando el usuario descargue el archivo .pdf, éste tendrá que incluir en su nombre el idproducto que se desee */
		$nombreArchivo="archivos/".$listaProductos[0]['idproducto'].".pdf";
		$nuevoNombreArchivo=$_POST['idventa'].$_POST['idproducto'].".pdf";
		echo $nuevoNombreArchivo;

		header("Content-Transfer-Encoding: binary");
		header("Content-type: application/force-download");
		header("Content-Disposition: attachment; filename=$nuevoNombreArchivo");
		readfile("$nombreArchivo");
		
		$sentencia=$pdo->prepare("UPDATE detalleventas set descargado=descargado+1
			WHERE idventa=:idventa AND idproducto=:idproducto");

		$sentencia->bindParam(":idventa",$idventa);
		$sentencia->bindParam(":idproducto",$idproducto);
		$sentencia->execute();
		
	}else{
		
	}
}



?>
<?php 
	/* API Paypal */

	$clientId="AUmzKi8YHW8ZteAJTWjHqOdE0ypID4UcPzkPVDMaQciHFKA7SmnQ-EKsI8tXDhRDOXABGyUVK4seK_wE";
	$secret="EHv_qpaoDT1HGl-QRxpmSHdX_Vd38kI9o1gayQBEVNcuICD9tvLLVp0yTWzPJAQyapI6TxNAB8Masz_X";


	$login=curl_init("https://api.sandbox.paypal.com/v1/oauth2/token");

	curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);

	curl_setopt($login, CURLOPT_USERPWD, $clientId.":".$secret);

	curl_setopt($login, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

	$respuesta=curl_exec($login);

	/* Convertir la respuesta a objeto */
	$objRespuesta=json_decode($respuesta);

	$accessToken=$objRespuesta->access_token;

	$venta=curl_init("https://api.sandbox.paypal.com/v1/payments/payment/".$_GET['paymentID']);

	curl_setopt($venta, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$accessToken));

	curl_setopt($venta, CURLOPT_RETURNTRANSFER, TRUE);

	$respuestaVenta=curl_exec($venta);

	$objDatosTransaccion=json_decode($respuestaVenta);

	$state=$objDatosTransaccion->state;

	$email=$objDatosTransaccion->payer->payer_info->email;

	$total = $objDatosTransaccion->transactions[0]->amount->total;
	$currency = $objDatosTransaccion->transactions[0]->amount->currency;
	$custom = $objDatosTransaccion->transactions[0]->custom;

	$clave=explode("#", $custom);

	$SID=$clave[0];
	$claveVenta=openssl_decrypt($clave[1],COD,KEY);

	curl_close($venta);
	curl_close($login);
/* Si el estado es aprobado me limpia la sesión del carrito, y me hace un update en ventas */
	if($state=="approved"){
		$mensajePaypal="Pago realizado con éxito";
		$sentencia=$pdo->prepare("UPDATE `ventas` 
			SET `datos` = :datos, 
			`status` = 'aprobado' 
			WHERE `ventas`.`id` = :id;");

		$sentencia->bindParam(":id",$claveVenta);
		$sentencia->bindParam(":datos",$respuestaVenta);
		$sentencia->execute();

		
		$sentencia=$pdo->prepare("UPDATE `ventas` 
			SET status='completo'
			WHERE clave=:clave
			AND total=:total
			AND id=:id");

		$sentencia->bindParam(":clave",$SID);
		$sentencia->bindParam(":total",$total);
		$sentencia->bindParam(":id",$claveVenta);
		$sentencia->execute();

		$completado=$sentencia->rowCount();
		unset($_SESSION['carrito']);
	}else{
		$mensajePaypal="<h3>Lo sentimos, el pago no ha sido realizado</h3>";
	}

?>
<div class="container">
	<div class="jumbotron">

		<h3><?php echo $mensajePaypal; ?></h3>

		<hr class="my-4 color">

		<p class="text-center">¡Disfruta de tu compra!</p>

		<p>
			<?php 
				if($completado>=1){
					

					$sentencia=$pdo->prepare("SELECT * FROM detalleventas,productos 
					WHERE detalleventas.idproducto=productos.id 
					AND detalleventas.idventa=:id");

					$sentencia->bindParam(":id",$claveVenta);
					$sentencia->execute();

					$listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

				}
			?>
			<div class="row">
				<?php foreach($listaProductos as $producto){ ?>
				<div class="col-12 col-sm-3 mt-4 text-center">
					<div class="card">
						<img class="card-img-top" src="<?php echo $producto['imagen']; ?>">
						<div class="card-body">
						<p class="card-text"><?php echo $producto['nombre']; ?></p>
						<?php if($producto['descargado']<DESCARGASPERMITIDAS){ ?>
							<form action="" method="post">
								<input type="hidden" name="idventa" id="" value="<?php echo openssl_encrypt($claveVenta,COD,KEY); ?>">
								<input type="hidden" name="idproducto" id="" value="<?php echo openssl_encrypt($producto['idproducto'],COD,KEY); ?>">
								<button class="btn" id="dropdownMenuButton" type="submit">Descargar</button>
							</form>
						<?php }else{ ?>
							<!-- Cuando el usuario descarga el pdf el botón queda inhabilitado -->
							<button class="btn btn-danger" type="button" disabled >Descargar</button>
						<?php } ?>
						</div>
				</div>
			</div>
			<?php } ?>
		</p>

	</div>
</div>
 <?php include 'footer.php'; ?>