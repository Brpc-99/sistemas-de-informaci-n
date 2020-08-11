<?php 

include"..\include/conexion.php";

//almacenamiento de los datos
$rut= $_POST['Rut'];
$nombre= $_POST['nombre'];
$descripcion= $_POST['descripcion'];


$insertar="INSERT INTO PROVEEDORES (Rut,Nombre,Descripcion) VALUES ('$rut','$nombre','$descripcion')";

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

?>
