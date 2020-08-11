<?php 

include"..\include/conexion.php";

if(!empty($_POST)){

$iduser=$_POST['idusuario'];
$Cantidad_nueva=$_POST['cantidad_nueva'];
$valor_nuevo=$_POST['valor_nuevo'];
$total= $Cantidad_nueva*$valor_nuevo;

if(isset($_POST['btn'])){

	
	$consulta= pg_query($conexion, "UPDATE PRODUCTOS
	SET 
Stock=Stock+$Cantidad_nueva, total=total+$total, Valor_unitario=$valor_nuevo
	 WHERE Codigo_producto=$iduser");

if(!$consulta){
echo '<script>
	alert("Error");
	window.history.go(-1);
	</script>';
}else{
	echo '<script>
	alert("Registro actualizado exitosamente");
	window.history.go(-1);
	</script>';
}

}


}
//motrar datos
if(empty($_GET['id'])){
	
	header('Location: producto.php');
}
$iduser=$_GET['id'];
$sql= pg_query($conexion,"SELECT*FROM PRODUCTOS WHERE Codigo_producto=$iduser");

$resul=pg_num_rows($sql);
	
	if($resul ==0){
	header('Location: producto.php');
}else{
		while($data = pg_fetch_array($sql)){

		$iduser= $data['codigo_producto'];
		$nombre= $data['nombre_producto'];
		$descripcion= $data['descripcion'];
		$Valor_unitario=$data['valor_unitario'];
		$Valor_de_venta=$data['valor_de_venta'];
		$Stock=$data['stock'];

	}
	


}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Ingresar Producto</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="..\imagenes\icono.ico">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_header.css">
	<link rel="stylesheet" type="text/css" href="estilo/cargar_stock.css">
</head>
<body>
<?php include"..\include\header.html" ?>
	<div class="contenedorr">
		
	
			
			<form class="formulario" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
				<h2>Registrar Producto</h2>
				<p class="campo">Campos Obligatorios *</p>
				<div class="contenedor_input">
				<input type="hidden" name="idusuario" value="<?php echo $iduser; ?>">
		<label>Nombre:</label>	
		<input type="text" name="nombre" placeholder="Nombre *" maxlength="20" id="nombre" class="input_grande" value="<?php echo $nombre; ?>" disabled>
						
			<br>

		<label>Cantidad Actual:</label>
			<input type="tex" name="cantidad" placeholder="Cantidad" maxlength="10" id="cantidad" class="input_grande" value="<?php echo $Stock ?>" disabled>
				<br>
			<label>Valor de Compra</label>
				<input type="text" name="v_compra" placeholder="Valor Unitario de Compra *" maxlength="15" id="v_compra" class="input_grande" value="<?php echo $Valor_unitario ?> " disabled>
				<br>
				<label> Valor de Venta</label>
				<input type="text" name="v_venta" placeholder="Valor Unitario de Venta *" maxlength="10" id="v_venta" class="input_grande" value=" <?php echo $Valor_de_venta ?> " disabled>
				<br>
				<label>Descripción</label>
				<input  name="descripcion" placeholder="Descripción *" maxlength="50" id="descripcion" class="input_grande"
				value="<?php echo $descripcion ?>" disabled>
				<br>
				<label>Cantidad a Agregar</label>
				<input type="text" name="cantidad_nueva" >
				<br>
				<label>Valor unitario nuevo</label>
				<input type="text" name="valor_nuevo" >
				<br>
				<input type="submit" class="btn" name="btn" value="Aceptar" id="btn">
				
				<input type="button" class="cancelar" name="cancelar" value="Cancelar" id="cancelar">
				
				</div>


				<p class="error" id="error"></p>


			</form>


	</div>

	<script src="js\registrar_producto.js"></script>
</body>
</html>