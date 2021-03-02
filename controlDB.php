<!-- Fernando Morán González -->
<?php
class controlDB{
	function __construct(){
		try{
			// Declarando variables
			$host="localhost";
			$db_name="masterguides";
			$user="root";
			$pass="";

			// Conexión
			$this->con=mysqli_connect($host,$user,$pass) or die ("Error al conectar con la BBDD");
			// Selección de BBDD
			mysqli_select_db($this->con,$db_name) or die ("No se ha encontrado la BBDD " . "<br>" . mysqli_error($this->con));


		}catch(Exception $ex){

			throw $ex;
		}
		
	}
	/* Seleccionar */
	function consultar($sql){
		try{
			$res = mysqli_query($this->con,$sql);

			$data = NULL;
			while($fila = mysqli_fetch_assoc($res)){
				$data[] = $fila;
			}
			return $data;

		}catch(Exception $ex){

			throw $ex;
		}
	}

	/* Insertar , eliminar o actualizar datos (registro) */
	function actualizar($sql){
		mysqli_query($this->con,$sql);

		/* Validar una inserción o actualización de algún registro */
		if(mysqli_affected_rows($this->con) <=0){
			echo "No se pudo realizar el registro";
		}else{
			echo "Registro realizado correctamente";
		}
	}


}
?>