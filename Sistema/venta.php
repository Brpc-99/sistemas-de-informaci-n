<?php 

include"..\include/conexion.php";
session_start();

$where="";
if(isset($_POST['filtro'])){


if(!empty($_POST['busqueda']) && empty($_POST['codigo'])){
$busqueda=$_POST['busqueda'];
				$where= " and P.Nombre_Producto like '$busqueda%'";
				$buscar= 'busqueda='.$busqueda;

}
if(empty($_POST['busqueda']) && !empty($_POST['codigo'])){
$codigo=$_POST['codigo'];
				$where= " and P.Codigo_producto =$codigo";
				$buscar= 'codigo='.$codigo;

}

}
/*PAGINADOOOOOOR*/
$sql_registro= pg_query($conexion,"SELECT COUNT(*) AS total_registro FROM PRODUCTOS P "); /*Total de todos los registros*/
	$result_registro = pg_fetch_array($sql_registro);
	$total_registro= $result_registro['total_registro'];
	$por_pagina=1;

if(empty($_GET['pagina'])){

	$pagina=1;
}else{
	$pagina=$_GET['pagina'];
}

$desde=($pagina-1)*$por_pagina;
$total_paginas= ceil($total_registro/$por_pagina); 

/*CONSULTAS*/
$consulta= "SELECT P.Codigo_producto,P.Nombre_Producto,P.Descripcion,C.Nombre_categoria,PR.Nombre,P.Fecha,P.Valor_unitario,
P.Valor_de_venta,P.Stock
FROM PRODUCTOS P,CATEGORIAS C,PROVEEDORES PR,ENTREGAN E
WHERE P.Codigo_categoria=C.Codigo_categoria and P.Codigo_producto=E.Codigo_producto and E.Codigo_proveedores=PR.Codigo_proveedores $where
limit $por_pagina offset $desde; ";
$resul= pg_query($conexion,$consulta);

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Productos</title>
 	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="..\imagenes\icono.ico">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_header.css">
	<link rel="stylesheet" type="text/css" href="estilo/estilo_venta.css">
	<link rel="stylesheet" type="text/css" href="..\iniciar sesion\estilo\font.css">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_footer.css">
 </head>
 <body>
 	<?php include"..\include\header.php"; ?>
 
	<div class="monto_total">
		<div class="tareas">
		<div class="wrap">
			<form action="procesar_venta.php" method="post" >
				<h3>Venta</h3>
				<div class="labels">
				<label class="veinticinco">Código</label>
				<label class="veinticinco">Nombre</label>
				<label class="veinticinco">Valor</label>
				<label class="veinticinco">Cantidad</label>
				</div>
				<div id="lista" class="listas">
					

				</div>

				<input  class="btn2" type="submit" name="btn" value="Generar Venta">
			</form>
		</div>
	</div>

	</div>

	<div class="contenedorr">
	<div class="filtro">
		<h2>Lista de Productos</h2>
	<form action="" method="post" class="form_search">
	<input type="text" name="busqueda" id="busqueda" placeholder="Nombre">
	<input type="text" name="codigo" placeholder="Código">
		<input type="submit" name="filtro" value="Filtrar" class="btn">
	</form>
	</div>

	<table>
		<tr class="encabezado">
			<td>Nombre</td>
			<td>Descripción</td>
			<td>Categoría</td>
			<td>Valor de venta</td>
			<td>Stock</td>
			<td>Valor Total</td>
			<td>Cantidad</td>
			<td>Agregar</td>

	

		</tr>
		<?php 

		

		while($mostrar=pg_fetch_array($resul)){
		 ?>
		 <form>
		 <tr class="muestras" id="tabla">
		 	<td ><input  class="input" type="text" id="codigo" name="" value="<?php echo $mostrar['codigo_producto'] ?>" ></td>
			<td><input class="input2" type="text" name="" id="nombre_p" value="<?php echo $mostrar['nombre_producto'] ?>" ></td>
			<td><input class="input2" type="text" name="" id="tareaInput4" value="<?php echo $mostrar['nombre_categoria'] ?>" ></td>
			<td><input class="input" type="text" name="" id="v_ventas" value="<?php echo number_format($mostrar['valor_de_venta']) ?>" ></td>
			<td> <input class="input" type="text" name="" id=""  value="<?php echo number_format($mostrar['stock']) ?>" ></td>
			<?php $total=$mostrar['valor_de_venta']*$mostrar['stock']; ?>
			<td><?php echo number_format($total) ?></td>
			<td><input class="input" type="text" name="" id="cant"></td>
			<td><input type="button" class="boton" id="btn-agregar" value="Agregar Tarea"></td>
		

		</tr>

		</form>

		<?php 
	}
		 ?>

	</table>

</div>

		<div class="paginador">
			<ul>
			<li><a href="#">|<</a></li>
			<li><a href="#"><<</a></li>
<?php
		for ($i=1; $i <=$total_paginas ; $i++) { 

			if ($i == $pagina) {
				echo '<li class="pageSelected">'.$i.'</li>';
			}else{
			echo '<li ><a  href="?pagina='.$i.'">'.$i.'</a></li>';

			}
		
		}
?>
	
			<li><a href="#">>></a></li>
			<li><a href="#">>|</a></li>
		</ul>


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
	<script src="js\venta.js"></script>
 </body>
 </html>