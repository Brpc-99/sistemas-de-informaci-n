<?php 

include"..\include/conexion.php";//conectando la base de datos


$usuario= $_POST['usuario'];
$clave= $_POST['clave'];




$consulta = "SELECT * FROM USUARIOS WHERE Usuario='$usuario' and clave='$clave' ";

$resultado = pg_query($conexion,$consulta); //ejecuta conexion y consulta
$filas= pg_num_rows($resultado); // numero de filas
if($filas>0){

	header("location: ..\Sistema\inicio.php"); // location es para redireccionar a otra pagina

}else{

	echo '<script>
	alert("Error");
	window.history.go(-1);
	</script>';
}

pg_free_result($resultado); //libera espacio
pg_close($conexion);

 ?>