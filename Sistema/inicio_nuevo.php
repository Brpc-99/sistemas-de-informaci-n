<?php
include "..\include/conexion.php";
session_start();
$query = pg_query($conexion,"SELECT nombre_producto, stock FROM productos WHERE stock <= 10");

?>

<!DOCTYPE html>
<html>
<head>
	<title>CA.PI.TO Solutions</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="..\imagenes\icono.ico">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_header.css">
	<link rel="stylesheet" type="text/css" href="estilo\estilo_usuario.css">
	<link rel="stylesheet" type="text/css" href="..\iniciar sesion\estilo\font.css">
	<link rel="stylesheet" type="text/css" href="estilo\estilo_footer_ventas.css">

	<link rel="stylesheet" type="text/css" href="estilo\inicio_p.css">
</head>
<body>
	<?php include"..\include\header.php"; ?>

	<div class="contenedoroso" style="padding-bottom: 50px">
		<h3 class="textocen copi">Bienvenidos a Nuestro Sistema Electrónico de Gestión de Farmacia</h3>
		<h3 class="textocen copi">BiofarmacStock</h3>
		<br></br>
				<h3 class="izquierda-texto">En esta aplicación web podrás encontrar las siguientes secciones:</h3>
				<br></br>
		<div class="caja">
			<div class="pega"><h3 class="textocen titulo">Usuarios</h3>
				<p class="padding">En esta parte podrá encontrar una lista de los usuarios que están registrados en el software, podrá crear nuevos usuarios, como también eliminarlos o modificarlos.</p>
			</div>
			<div class="pega"><h3 class="textocen titulo">Productos</h3>
				<p class="padding">En esta parte podrá encontrar una lista de los productos ingresados, podrá modificar o eliminar como también agregar un nuevo producto, podrá ver también un resumen total del valor de los productos por mes. </p>
			</div>
			<div class="pega"><h3 class="textocen titulo">Proveedores</h3>
				<p class="padding">En esta parte podrá encontrar una lista de los proveedores ingresados, podrá modificar o eliminar, como también agregar un nuevo proveedor. </p>
			</div>
			<div class="pega"><h3 class="textocen titulo">Ventas</h3>
				<p class="padding">En esta parte podrá encontrar una lista de las ventas, como tambián generar ventas, además se podrá ver el monto total de las ventas por mes.</p>
			</div>
		</div>
	</div>
	<div class="filtro" style="width: 350px">
	<h2>Stocks bajos:</h2>
	</div>
	<div style="padding-bottom: 50px">
	<table style="width: 350px">
        <tr class="encabezado">
            <td style="text-align: center">Nombre Producto</td>
            <td style="text-align: center">Stock</td>
        </tr>
		<?php
			while ($productos_bajo_stock = pg_fetch_array($query)) { ?>
        <tr class="muestras">
            <td><?php echo $productos_bajo_stock['nombre_producto']; ?></td>
            <td><?php echo $productos_bajo_stock['stock']; ?></td>
        </tr>
        <?php } ?>
	</table>
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

</body>
</html>