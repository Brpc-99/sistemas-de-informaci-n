<?php 
include"..\include/conexion.php";

$nombre= $_POST['nombre'];
$codigo_categoria= $_POST['codigo_categoria'];
$codigo_proveedores= $_POST['codigo_proveedores'];
$cantidad= $_POST['cantidad'];
$v_compra= $_POST['v_compra'];
$v_venta= $_POST['v_venta'];
$fecha= $_POST['fecha'];
$descripcion = $_POST['descripcion'];
$cantidad =$_POST['cantidad'];

$insertar= "INSERT INTO PRODUCTOS (Codigo_categoria,Nombre_Producto,Descripcion,Fecha,Valor_unitario,Valor_de_venta,Stock)
VALUES('$codigo_categoria','$nombre','$descripcion','$fecha','$v_compra','$v_venta','$cantidad')";




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


 ?>