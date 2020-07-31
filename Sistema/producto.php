<?php 

include"..\include/conexion.php";



/*PAGINADOOOOOOR*/
$sql_registro= pg_query($conexion,"SELECT COUNT(*) AS total_registro FROM PRODUCTOS"); /*Total de todos los registros*/
	$result_registro = pg_fetch_array($sql_registro);
	$total_registro= $result_registro['total_registro'];
	$por_pagina=5;

if(empty($_GET['pagina'])){

	$pagina=1;
}else{
	$pagina=$_GET['pagina'];
}

$desde=($pagina-1)*$por_pagina;
$total_paginas= ceil($total_registro/$por_pagina); 

/*CONSULTAS*/
$consulta= "SELECT P.Codigo_producto,P.Nombre_Producto,P.Descripcion,C.Nombre_categoria,P.Fecha,P.Valor_unitario,
P.Valor_de_venta,P.Stock
FROM PRODUCTOS P,CATEGORIAS C
WHERE P.Codigo_categoria=C.Codigo_categoria
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
	<link rel="stylesheet" type="text/css" href="estilo/estilos_producto.css">
	<link rel="stylesheet" type="text/css" href="..\iniciar sesion\estilo\font.css">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_footer.css">
 </head>
 <body>
 	<?php include"..\include\header.html" ?>
 	<div class="registrar_producto">
	<a href="#">Registrar Producto</a>
	</div>
	<div class="filtro">
		<h2>Lista de Productos</h2>
	<form action="buscar_producto.php" method="get" class="form_search">
		<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
		<?php 
		$query= pg_query($conexion,"SELECT * FROM CATEGORIAS");
		$result_categoria= pg_num_rows($query);

		 ?>
		 <select name="categoria" id="categoria">
		 	<option value="" selected>Categoría</option>
		 	<?php 
		 	if($result_categoria>0){

		 		while ($categoria=pg_fetch_array($query)) {

		 	 ?>	

		<option value="<?php echo $categoria['codigo_categoria']; ?>"><?php echo $categoria['nombre_categoria']?> </option>
<?php  
		 		}
		 	}

		 ?>	

		 </select>
		<input type="submit" name="" value="Filtrar" class="btn">
	</form>
	</div>

	<table>
		<tr class="encabezado">
			<td>Nombre</td>
			<td>Descripción</td>
			<td>Categoría</td>
			<td>Fecha Ingreso</td>
			<td>Valor Unitario de Compra</td>
			<td>Stock</td>
			<td>Valor Total</td>
			<td>Modificar</td>
			<td>Eliminar</td>

		</tr>
		<?php 

		

		while($mostrar=pg_fetch_array($resul)){
		 ?>
		 <tr class="muestras" >
			<td><?php echo $mostrar['nombre_producto'] ?></td>
			<td><?php echo $mostrar['descripcion'] ?></td>
			<td><?php echo $mostrar['nombre_categoria'] ?></td>
			<td><?php echo $mostrar['fecha']?></td>
			<td><?php echo $mostrar['valor_unitario'] ?></td>
			<td><?php echo $mostrar['stock'] ?></td>
			<?php $total=$mostrar['valor_unitario']*$mostrar['stock']; ?>
			<td><?php echo $total ?></td>
			<td><a href="modificando_producto.php?id=<?php echo $mostrar['codigo_producto'] ?>">Modificar</a></td>
			<td><a href="eliminando_producto.php?id=<?php echo $mostrar['codigo_producto'] ?>">Eliminar</a></td>

		</tr>

		<?php 
	}
		 ?>

	</table>

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
 </body>
 </html>