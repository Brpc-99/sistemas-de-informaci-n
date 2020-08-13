<?php 

include"..\include/conexion.php";//conectando la base de datos

if(!empty($_SESSION['active']))
{
header("location: ..\Sistema\inicio_nuevo.php");
}else{
$usuario= $_POST['usuario'];
$clave= $_POST['clave'];




$consulta = "SELECT * FROM USUARIOS WHERE Usuario='$usuario' and clave='$clave' ";

$resultado = pg_query($conexion,$consulta); //ejecuta conexion y consulta
$filas= pg_num_rows($resultado); // numero de filas
if($filas>0){
		// sesiones
	$data=pg_fetch_array($resultado);
	session_start(); //sesion
	$_SESSION['active']=true;
	$_SESSION['codigo']=$data['codigo_usuario'];
	$_SESSION['rol']=$data['cod_rol'];
	$_SESSION['nombre']=$data['nombre'];
	$_SESSION['usuario']=$data['usuario'];
	$_SESSION['Correo']=$data['correo'];

	//sesiones

	header("location: ..\Sistema\inicio_nuevo.php"); // location es para redireccionar a otra pagina

}else{

	echo '<script>
	alert("Error");
	window.history.go(-1);
	</script>';
}

pg_free_result($resultado); //libera espacio

}
 ?>