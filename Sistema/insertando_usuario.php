<?php 
session_start();
include"..\include/conexion.php";

//almacenamiento de los datos
$nombre= $_POST['nombre'];
$apellido= $_POST['apellido'];
$usuario= $_POST['usuario'];
$clave= $_POST['clave'];
$correo= $_POST['correo'];
$palabra= $_POST['palabra_segura'];
$cargo= $_POST['codigo_rol'];

$insertar="INSERT INTO USUARIOS (Cod_rol,Nombre,Apellido,Usuario,clave,Correo,Respuesta_de_seguridad) VALUES ('$cargo','$nombre','$apellido','$usuario','$clave','$correo','$palabra')";

$verificar_usuario= pg_query($conexion, "SELECT * FROM USUARIOS where usuario='$usuario'");

if(pg_num_rows($verificar_usuario)>0){

echo '<script>

 alert("El usuario ya esta registrado intente con otro usuario");
			window.history.go(-1);
</script>';
exit; //no ejecutar lo demas

}
//ejecutar consulta para insertar

$resultado= pg_query($conexion,$insertar);
if(!$resultado){
	echo '<script>
	alert("Error");
	window.history.go(-1);
	</script>';
}else{
	echo '<script>
	alert("Registro insertado exitosamente");
	window.history.go(-2);
	</script>';

}

//cerrar conexion
pg_close($conexion);
?>

 ?>