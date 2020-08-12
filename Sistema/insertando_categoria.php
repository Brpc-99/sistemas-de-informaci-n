<?php 
include"..\include/conexion.php";
session_start();
$nombre= $_POST['nombre'];
$descripcion= $_POST['descripcion'];

$insertar="INSERT INTO CATEGORIAS (Nombre_categoria,Descripcion) VALUES ('$nombre', '$descripcion')";
$verificar_categoria= pg_query($conexion, "SELECT * FROM CATEGORIAS where Nombre_categoria='$nombre'");

if(pg_num_rows($verificar_categoria)>0){

echo '<script>

 alert("La categoría ya esta registrado, intente con otra");
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