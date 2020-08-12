<?php 
session_start();
if($_SESSION['rol']!=1)
{
	echo $_SESSION['rol'];
	header("Location: Usuario.php");
}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Registrar Usuario</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="..\imagenes\icono.ico">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_header.css">
	<link rel="stylesheet" type="text/css" href="estilo\registrar_usuario.css">
	
</head>
<body>
	<?php include"..\include\header.php"; ?>

	<div class="contenedor">
		
	
			
			<form class="formulario" action="insertando_usuario.php" method="post">
				<h2>Registrar Usuario</h2>
				<p class="campo">Campos Obligatorios *</p>
				<div class="contenedor_input">
				<input type="text" name="nombre" placeholder="Nombre *" maxlength="20" id="nombre" class="input-pequeño">
				<input type="text" name="apellido" placeholder="Apellido" maxlength="20" id="apellido" class="input-pequeño">
				<br>
				<input type="tex" name="usuario" placeholder="Usuario *" maxlength="15" id="usuario" class="input-pequeño">
				<input type="password" name="clave" placeholder="Clave *" maxlength="15" id="clave" class="input-pequeño">
				<br>
				<input type="email" name="correo" placeholder="Correo *" maxlength="40" id="correo" class="input_grande">
				<br>
				<input type="text" name="palabra_segura" placeholder="Palabra de Seguridad *" maxlength="10" id="palabra_segura" class="input_grande">
				<br>
				<select name="codigo_rol" class="rol">
					<option value="1">Administrador </option>
					<option value="2">Vendedor </option>
				</select>
				<br>
				<input type="submit" class="btn" name="btn" value="Aceptar" id="btn">
				
				<input type="button" class="cancelar" name="cancelar" value="Cancelar" id="cancelar">
				
				</div>


				<p class="error" id="error"></p>


			</form>







	</div>

<script src="js\registro_usuario.js"></script>
</body>
</html>