<!-- Fernando Morán González -->
<?php
/* Logout.php es la que se encarga de poder cerrar la sesión y devolverte al index.php */
session_start();

session_unset();

session_destroy();

header('Location: index.php');
?>