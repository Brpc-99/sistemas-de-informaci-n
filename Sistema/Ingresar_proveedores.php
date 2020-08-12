<?php session_start();
if($_SESSION['rol']!=1)
{
	echo $_SESSION['rol'];
	header("Location: Proveedores.php");
}
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Ingresar Proveedor</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="..\imagenes\icono.ico">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_header.css">
	<link rel="stylesheet" type="text/css" href="estilo\registrar_categoria.css">
	<link rel="stylesheet" type="text/css" href="..\iniciar sesion\estilo\font.css">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_footer.css">

</head>
<body>
	<?php include"..\include\header.php"; ?>

	<div class="contenedor">
			<form class="formulario" action="Insertando_proveedores.php" method="post">	<!--EN ACTION TENGO QUE PONER EL INSERTANDO PROVEEDORES CUNADO LO HAGA-->
				<h2>Ingresar Proveedor</h2>
				<p class="campo">Campos Obligatorios *</p>
				
				<div class="contenedor_input">
				<input type="text" name="Rut" placeholder="Rut *" maxlength="12" id="rut" class="input-pequeño">
				<input type="text" name="nombre" placeholder="Nombre *" maxlength="20" id="nombre" class="input-pequeño">
				<textarea name="descripcion" id="descripcion" class="area" autofocus="" maxlength="60" placeholder="Descripción" ></textarea>
		
				<input type="submit" class="btn" name="btn" value="Aceptar" id="btn">
				<input type="button" class="cancelar" name="cancelar" value="Cancelar" id="cancelar">
				</div>

				<p class="error" id="error"></p>

			</form>

	</div>

<footer>
	
	<div class="iconos">

	<div class="siguenos"><p>Síguenos en: </p></div>
	<span class="icon-facebook"><a href="https://es-la.facebook.com/"></a></span>
	<span class="icon-twitter"></span>
	<span class="icon-instagram"></span>

	</div>

	<div class="contacto">
		<div class="gmail"><p >Contáctenos en: Copito@gmail.com</p></div>	

	</div>
</footer>
<script src="js\registrar_proveedor.js"></script>
</body>
</html>