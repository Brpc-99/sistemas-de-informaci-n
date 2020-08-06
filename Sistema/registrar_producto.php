<?php 

include"..\include/conexion.php";
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
	<div class="contenedor">
		
	
			
			<form class="formulario" action="insertando_usuario.php" method="post">
				<h2>Registrar Producto</h2>
				<p class="campo">Campos Obligatorios *</p>
				<div class="contenedor_input">
				<input type="text" name="nombre" placeholder="Nombre *" maxlength="20" id="nombre" class="input-pequeño">
				<select name="codigo_categoria" class="codigo_categoria">
					<option value="1">Administrador </option>
					<option value="2">Vendedor </option>
				</select>
				<br>
				<select name="codigo_proveedor" class="codigo_categoria">
					<option value="" selected>Proveedor</option>
<?php  
			$query= pg_query($conexion,"SELECT * FROM PROVEEDORES");
				$result_categoria= pg_num_rows($query);
?>				
				</select>
					<input type="tex" name="cantidad" placeholder="Cantidad *" maxlength="15" id="usuario" class="input-pequeño">
				<br>
			
				<input type="text" name="v_compra" placeholder="Valor Unitario de Compra *" maxlength="15" id="v_compra" class="input-pequeño">
				
				<input type="text" name="v_venta" placeholder="Valor Unitario de Venta *" maxlength="40" id="v_venta" class="input-pequeño">
				<br>
				<input type="date" name="fecha" id="fecha" class="fecha">
				<br>
				<textarea  name="descripcion" placeholder="Descripción *" maxlength="10" id="descripcion" class="input_grande"></textarea> 
				<br>
				
				<br>
				<input type="submit" class="btn" name="btn" value="Aceptar" id="btn">
				
				<input type="button" class="cancelar" name="cancelar" value="Cancelar" id="cancelar">
				
				</div>


				<p class="error" id="error"></p>


			</form>







	</div>
</body>
</html>