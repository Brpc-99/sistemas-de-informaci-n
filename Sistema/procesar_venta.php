<?php 
include"..\include/conexion.php";
session_start();

$codigo=$_POST['codigo_producto'];
$nombre= $_POST['nombre'];
$venta= $_POST['venta'];
$cantidad= $_POST['cant'];
$total=$_POST['cant']*$_POST['venta'];
$fecha= date('y-m-d', time());
$usuario=$_SESSION['codigo'];

echo $cantidad;
echo $venta;
echo $total;
$insertar= "INSERT INTO VENTAS (Fecha,Valor_total,Codigo_usuario)
VALUES('$fecha','$total','$usuario')";

$resultado= pg_query($conexion,$insertar);
if(!$resultado){
	echo '<script>
	alert("Error");
	window.history.go(-1);
	</script>';
}else{

	$update=pg_query($conexion,"UPDATE PRODUCTOS 
		SET Stock=Stock-$cantidad WHERE Codigo_producto='$codigo'");


	$contador= "SELECT MAX(Codigo_venta) as max FROM VENTAS";
	$contador2=pg_query($conexion,$contador);
	 while($data = pg_fetch_array($contador2)){

		$clave= $data['max'];

	}
	$insertar2="INSERT INTO CONTIENE(Codigo_producto,Codigo_venta ,Cantidad ,Valor) VALUES ('$codigo','$clave',$cantidad,'$total')";
	$resultado2 = pg_query($conexion,$insertar2);
	
	echo '<script>
	alert("Registro insertado exitosamente");
	
	</script>';

}





 ?>