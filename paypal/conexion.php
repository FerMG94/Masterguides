<!-- Fernando Morán González -->
<?php
/* Conexión con la BBDD, obteniendo información desde el archivo config.php*/
$servidor="mysql:dbname=".BD.";host=".SERVIDOR;

/* Para comprobar la conexión a la BBDD */
try{
	/* Se crea una variable $pdo y una instancia PDO, la cual permite conectarse a la BBDD */ 
	$pdo = new PDO($servidor,USUARIO,PASSWORD,
		array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
	);
}catch(PDOException $e){
	/* echo"<script>alert('Error...')</script>"; */
}
?>