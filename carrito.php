<!-- Fernando Morán González -->
<?php
// unset($_SESSION['carrito']);
// Esta variable va a mandar información a la parte de mensaje del shop.php
$mensaje="";

if(isset($_POST['btnAccion'])){
	switch($_POST['btnAccion']){
		case 'agregar':
// Recogemos el id. Al estar encriptado se realiza la función decrypt
		if(is_numeric(openssl_decrypt($_POST['id'], COD, KEY))){
// Se guarda la desencriptación en una variable
			$id = openssl_decrypt($_POST['id'], COD, KEY);
			$mensaje.= "Id correcto:"." ".$id."<br>";
		}else{
			$mensaje.= "Id incorrecto"; break;
		}
// Repetimos la misma secuencia con los demás campos
		if(is_string(openssl_decrypt($_POST['nombre'], COD, KEY))){
			$nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
			$mensaje.= "Nombre correcto:"." ".$nombre."<br>";
		}else{
			$mensaje.= "Nombre incorrecto"; break;
		}

		if(is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))){
			$precio = openssl_decrypt($_POST['precio'], COD, KEY);
			$mensaje.= "Precio correcto:"." ".$precio."€"."<br>";
		}else{
			$mensaje.= "Precio incorrecto"; break;
		}

		if(is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))){
			$cantidad = openssl_decrypt($_POST['cantidad'], COD, KEY);
			$mensaje.= "Cantidad correcta:"." ".$cantidad."<br>";
		}else{
			$mensaje.= "Cantidad incorrecta"; break;
		}
// Si no existe la variable de sesión, recupera la información del id, nombre, precio y producto
		if(!isset($_SESSION['carrito'])){
			$producto=array(
				'id'=>$id,
				'nombre'=>$nombre,
				'precio'=>$precio,
				'cantidad'=>$cantidad
			);
// Crear en el carrito de la compra en el primer elemento un espacio para meter la información de la variable producto
			$_SESSION['carrito'][0]=$producto;
			$mensaje = "Producto agregado al carrito.";
		}else{
			/* Array column me deposita todos los ids dentro del carrito */
			$idProductos=array_column($_SESSION['carrito'], "id");
			/* Aqui se prohibe la selección doble del mismo producto */
			if(in_array($id, $idProductos)){
				$mensaje="Lo sentimos, solo puedes agregar un ejemplar del mismo tipo al carrito.";
			}else{
// Else permite que puedas depositar más productos en el carrito de compra
// La función count contabiliza el carrito de compras
				$numeroProductos=count($_SESSION['carrito']);
// Recogemos la información del producto
				$producto=array(
					'id'=>$id,
					'nombre'=>$nombre,
					'precio'=>$precio,
					'cantidad'=>$cantidad
				);
// Se almacena la información en carrito
				$_SESSION['carrito'][$numeroProductos]=$producto;
				$mensaje = "Producto agregado al carrito";
			}
			/* $mensaje = "print_r($_SESSION['carrito'],true)"; */
		}

		break;
		case "eliminar":
		if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
			$ide=openssl_decrypt($_POST['id'],COD,KEY);
			/* Con el foreach se lee todos los valores que estan dentro de la sesion */
			/* Entonces se busca el que tenga $id para poder borrarlo */
			foreach($_SESSION['carrito'] as $indice=>$producto){
				/* Si el id de producto es igual al id anterior, me elimina el registro con unset */
				if($producto['id']==$ide){
					unset($_SESSION['carrito'][$indice]);
				}
			}
		}
		break;
	}
}

?>