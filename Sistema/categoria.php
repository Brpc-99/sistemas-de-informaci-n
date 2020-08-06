<?php 

	include"..\include/conexion.php";


$sql_registro= pg_query($conexion,"SELECT COUNT(*) AS total_registro FROM CATEGORIAS"); /*Total de todos los registros*/
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
$consulta= "SELECT C.Codigo_categoria,C.Nombre_categoria,C.Descripcion
FROM CATEGORIAS C
limit $por_pagina offset $desde; ";
$resul= pg_query($conexion,$consulta);

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Categorías</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="..\imagenes\icono.ico">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_header.css">

	<link rel="stylesheet" type="text/css" href="estilo\estilo_usuario.css">
	<link rel="stylesheet" type="text/css" href="..\iniciar sesion\estilo\font.css">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_footer.css">
</head>
<body>
	<?php include"..\include\header.html" ?>


	<div class="registrar_usuario">
	<a href="registrar_categoria.php">Registrar Categoría</a>
	</div>
	<div class="filtro">
		<h2>Lista de Categorías</h2>

	<form action="buscar_categoria.php" method="get" class="form_search">
		<input type="text" name="busqueda" id="busqueda" placeholder="Nombre">
	
		<input type="submit" name="" value="Filtrar" class="btn">
	</form>

	</div>
	<table>
		<tr class="encabezado">
			<td>Código</td>
			<td>Nombre</td>
			<td>Descripción</td>
			<td>Modificar</td>
			<td>Eliminar</td>

		</tr>
		<?php 

		

		while($mostrar=pg_fetch_array($resul)){
		 ?>
		 <tr class="muestras" >
			<td><?php echo $mostrar['codigo_categoria'] ?></td>
			<td><?php echo $mostrar['nombre_categoria'] ?></td>
			<td><?php echo $mostrar['descripcion']?></td>
			<td><a href="modificando_categoria.php?id=<?php echo $mostrar['codigo_categoria'] ?>">Modificar</a></td>
			<td><a href="eliminando_categoria.php?id=<?php echo $mostrar['codigo_categoria'] ?>">Eliminar</a></td>

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
