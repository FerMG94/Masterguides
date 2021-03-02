<!-- Fernando Morán González -->
<?php 
session_start();
include 'paypal/config.php';
include 'paypal/conexion.php'; 

/* Si el id de la sesión está definido me lleva al header2.php (usuario), en el caso de que no, te lleva a header.php(público). */
if(isset($_SESSION['id'])){
	include 'header2.php';
}else{
	include 'header.php';
}

?>
<link rel="stylesheet" type="text/css" href="css/about.css">
<body>
	<section id="about">
		<div class="row">
			<div class="col-lg-12">
				<div class="about-img">
					<img class="man" src="images/man.png" alt="">
				</div>
			</div>
			<div class="col-lg-12 mt-4">
				<p class="text-white">
					Mi nombre es Fernando Morán González y he estado estudiando Desarrollo de Aplicaciones Web durante dos años en el IES Leopoldo Queipo. 
				</p>
				<p class="text-white">
					MasterGuides es mi primer proyecto personal y es una página dedicada a la venta de guías de videojuegos.
				</p>
			</div>
		</div>
	</section>
</body>
</html>

<?php include 'footer.php'; ?>