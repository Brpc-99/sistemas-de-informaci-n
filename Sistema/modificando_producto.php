<?php 

include"..\include/conexion.php";

if(!empty($_POST)){

$iduser=$_POST['idusuario'];
$nombre= $_POST['nombre'];
$codigo_categoria=$_POST['codigo_categorias'];
$codigo_proveedores=$_POST['codigo_proveedores'];
$cantidad= $_POST['cantidad'];
$descripcion= $_POST['descripcion'];
$v_compra=$_POST['v_compra'];
$v_venta=$_POST['v_venta'];
$descripcion=$_POST['descripcion'];
$fecha=$_POST['fecha'];
$total= $v_compra*$cantidad;



if(isset($_POST['btn'])){

	
	$consulta= pg_query($conexion, "UPDATE PRODUCTOS
	SET 
Codigo_categoria=$codigo_categoria,Nombre_Producto='$nombre',Descripcion='$descripcion',Fecha='$fecha',Valor_unitario='$v_compra',Valor_de_venta='$v_venta',Stock='$cantidad',total=$total
	 WHERE Codigo_producto=$iduser");
	$consulta2= pg_query($conexion, "UPDATE ENTREGAN SET Codigo_proveedores=$codigo_proveedores WHERE Codigo_producto=$iduser");

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
		$Codigo_categoria= $data['codigo_categoria'];
		$nombre= $data['nombre_producto'];
		$descripcion= $data['descripcion'];
		$fecha=$data['fecha'];
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
	<link rel="stylesheet" type="text/css" href="estilo/registrar_producto.css">
</head>
<body>
<?php include"..\include\header.html" ?>
	<div class="contenedorr">
		
	
			
			<form class="formulario" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
				<h2>Registrar Producto</h2>
				<p class="campo">Campos Obligatorios *</p>
				<div class="contenedor_input">
				<input type="hidden" name="idusuario" value="<?php echo $iduser; ?>">	
		<input type="text" name="nombre" placeholder="Nombre *" maxlength="20" id="nombre" class="input-pequeño" value="<?php echo $nombre; ?>">
						<?php 
		$cons= pg_query($conexion,"SELECT * FROM CATEGORIAS");
		$result_catego= pg_num_rows($cons);

		 ?>
		 <select name="codigo_categorias" id="categoria" class="codigo_categoria">
		 	<?php 
		 	if($result_catego>0){

		 		while ($catego=pg_fetch_array($cons)) {

		 	 ?>	

		<option value="<?php echo $catego['codigo_categoria']; ?>"><?php echo $catego['nombre_categoria']?> </option>
<?php  
		 		}
		 	}

		 ?>	

		 </select>
				<br>
			<?php 
		$query= pg_query($conexion,"SELECT * FROM PROVEEDORES");
		$result_categoria= pg_num_rows($query);

		 ?>
		 <select name="codigo_proveedores" id="proveedores" class="codigo_categoria">
		
		 	<?php 
		 	if($result_categoria>0){

		 		while ($categoria=pg_fetch_array($query)) {

		 	 ?>	

		<option value="<?php echo $categoria['codigo_proveedores']; ?>"><?php echo $categoria['nombre']?> </option>
<?php  
		 		}
		 	}

		 ?>	

		 </select>
			<input type="tex" name="cantidad" placeholder="Cantidad *" maxlength="10" id="cantidad" class="input-pequeño" value="<?php echo $Stock ?>">
				<br>
			
				<input type="text" name="v_compra" placeholder="Valor Unitario de Compra *" maxlength="15" id="v_compra" class="input-pequeño" value="<?php echo $Valor_unitario ?> ">
				
				<input type="text" name="v_venta" placeholder="Valor Unitario de Venta *" maxlength="10" id="v_venta" class="input-pequeño" value=" <?php echo $Valor_de_venta ?> ">
				<br>
				<input type="date" name="fecha" id="fecha" class="fecha" value="<?php echo $fecha ?> ">
				<br>
				<input  name="descripcion" placeholder="Descripción *" maxlength="50" id="descripcion" class="input_grande"
				value="<?php echo $descripcion ?>">
				<br>
				
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