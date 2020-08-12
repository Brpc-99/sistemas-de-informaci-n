<?php 

session_start();

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Registrar Categoría</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="..\imagenes\icono.ico">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_header.css">
	<link rel="stylesheet" type="text/css" href="estilo\registrar_categoria.css">
</head>
<body>
	<?php include"..\include\header.php"; ?>

	<div class="contenedor">
		
	
			
			<form class="formulario" action="insertando_categoria.php" method="post">
				<h2>Registrar Categoría</h2>
				<p class="campo">Campos Obligatorios *</p>
				<div class="contenedor_input">
				<input type="text" name="nombre" placeholder="Nombre *" maxlength="20" id="nombre" class="input-pequeño">
				<textarea name="descripcion" id="descripcion" class="area" autofocus="" maxlength="60" placeholder="Descripción" ></textarea>
		
				<input type="submit" class="btn" name="btn" value="Aceptar" id="btn">
				
				<input type="button" class="cancelar" name="cancelar" value="Cancelar" id="cancelar">
				
				</div>


				<p class="error" id="error"></p>


			</form>







	</div>
<script src="js\registrar_categoria.js"></script>
</body>
</html>