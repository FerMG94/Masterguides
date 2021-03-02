<?php 
session_start();
/* Se comprueba que la sesión y el input del captcha sea igual al value de la sesión del captcha */
if(isset($_SESSION['captcha']) and $_POST['my-captcha'] == $_SESSION['captcha']){
	/* Elimina la sesión, lo que impide tener el mismo número de nuevo */
	unset($_SESSION['captcha']);
	header('Location: usuario.php');
}else{
	echo "El captcha no es correcto";
}
?>