<?php 

include"..\include/conexion.php";
session_start();
if($_SESSION['rol']!=1)
{
	echo $_SESSION['rol'];
	header("Location: Producto.php");
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
<?php include"..\include\header.php"; ?>
	<div class="contenedorr">
		
	
			
			<form class="formulario" action="insertando_producto.php" method="post">
				<h2>Registrar Producto</h2>
				<p class="campo">Campos Obligatorios *</p>
				<div class="contenedor_input">
				<input type="text" name="nombre" placeholder="Nombre *" maxlength="20" id="nombre" class="input-pequeño">
						<?php 
		$cons= pg_query($conexion,"SELECT * FROM CATEGORIAS");
		$result_catego= pg_num_rows($cons);

		 ?>
		 <select name="codigo_categoria" id="categoria" class="codigo_categoria">
		 	<option value="" selected>Categoría</option>
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
		 	<option value="" selected>Proveedores</option>
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
					<input type="tex" name="cantidad" placeholder="Cantidad *" maxlength="10" id="cantidad" class="input-pequeño">
				<br>
			
				<input type="text" name="v_compra" placeholder="Valor Unitario de Compra *" maxlength="15" id="v_compra" class="input-pequeño">
				
				<input type="text" name="v_venta" placeholder="Valor Unitario de Venta *" maxlength="10" id="v_venta" class="input-pequeño">
				<br>
				<input type="date" name="fecha" id="fecha" class="fecha" required>
				<br>
				<textarea  name="descripcion" placeholder="Descripción" maxlength="50" id="descripcion" class="input_grande"></textarea> 
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