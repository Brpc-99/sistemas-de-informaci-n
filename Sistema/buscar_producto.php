<?php 

include"..\include/conexion.php";
//$busqueda = $_REQUEST['busqueda'];
//$categoria = $_REQUEST['categoria'];
//$where="";
$busqueda ='';
$categoria='';
$fecha_de='';
$fecha_a='';
/*funciona*/ if(empty($_REQUEST['busqueda']) && empty($_REQUEST['categoria']) && empty($_REQUEST['fecha_de']) && empty($_REQUEST['fecha_a']))
			{
				header("Location: producto.php");

			}
/*funciona*/if(!empty($_REQUEST['busqueda']) && empty($_REQUEST['categoria']) && empty($_REQUEST['fecha_de']) && empty($_REQUEST['fecha_a'])){

				$busqueda= $_REQUEST['busqueda'];
				$where= "P.Nombre_Producto like '$busqueda%'";
				$buscar= 'busqueda='.$busqueda;
				
/*funciona*/			}
			if(!empty($_REQUEST['busqueda']) && !empty($_REQUEST['categoria']) && empty($_REQUEST['fecha_de']) && empty($_REQUEST['fecha_a'])){
				$busqueda= $_REQUEST['busqueda'];
				$categoria= $_REQUEST['categoria'];
				$where= "P.Nombre_Producto like '$busqueda%' and P.Codigo_categoria = $categoria";
				$buscar= 'busqueda='.$busqueda.'&'.'categoria='.$categoria;

			}
/*funciona*/if(!empty($_REQUEST['categoria']) && empty($_REQUEST['busqueda'])&& empty($_REQUEST['fecha_de']) && empty($_REQUEST['fecha_a']) )
			{

				$categoria=$_REQUEST['categoria'];
				$where="P.Codigo_categoria = $categoria ";
				$buscar='categoria='.$categoria;
			}

			/*PARA LA FECHA*/
if(!empty($_REQUEST['fecha_de']) && !empty($_REQUEST['fecha_a'])
&& empty($_REQUEST['busqueda']) && empty($_REQUEST['categoria']) ){

	$fecha_de= $_REQUEST['fecha_de'];
	$fecha_a= $_REQUEST['fecha_a'];

	if($fecha_de>$fecha_a){
		header("Location: producto.php");
	}else if($fecha_de == $fecha_a){
		$where= "P.Fecha = '$fecha_de'";
		$buscar = "fecha_de=$fecha_de&fecha_a=$fecha_a";
	}else{
		$where= "P.Fecha between '$fecha_de' and '$fecha_a'";
		$buscar= "fecha_de=$fecha_de&fecha_a=$fecha_a";
	}
}
/*hasta aqui el codigo de arriba funciona*/
if(!empty($_REQUEST['fecha_de']) && !empty($_REQUEST['fecha_a'])
&& !empty($_REQUEST['busqueda']) && empty($_REQUEST['categoria'])){

	$fecha_de= $_REQUEST['fecha_de'];
	$fecha_a= $_REQUEST['fecha_a'];
	$busqueda= $_REQUEST['busqueda'];


	if($fecha_de>$fecha_a){
		header("Location: producto.php");
	}else if($fecha_de == $fecha_a){
		$where= "P.Nombre_Producto like '$busqueda%' and P.Fecha = '$fecha_de'";
		$buscar = "fecha_de=$fecha_de&fecha_a=$fecha_a&busqueda=$busqueda";
	}else{
		$where= "P.Nombre_Producto like '$busqueda%' and P.Fecha between '$fecha_de' and '$fecha_a'";
		$buscar= "fecha_de=$fecha_de&fecha_a=$fecha_a&busqueda=$busqueda";
	}
}
/*hasta aqui igual funciona al parecer*/

if(!empty($_REQUEST['fecha_de']) && !empty($_REQUEST['fecha_a'])
&& !empty($_REQUEST['busqueda']) && !empty($_REQUEST['categoria'])){

	$fecha_de= $_REQUEST['fecha_de'];
	$fecha_a= $_REQUEST['fecha_a'];
	$busqueda= $_REQUEST['busqueda'];
	$categoria=$_REQUEST['categoria'];

	if($fecha_de>$fecha_a){
		header("Location: producto.php");
	}else if($fecha_de == $fecha_a){
		$where= "P.Nombre_Producto like '$busqueda%' and P.Codigo_categoria = $categoria and P.Fecha = '$fecha_de'";
		$buscar = "fecha_de=$fecha_de&fecha_a=$fecha_a&busqueda=$busqueda&categoria=$categoria";
	}else{
		$where= "P.Nombre_Producto like '$busqueda%' and P.Codigo_categoria = $categoria and P.Fecha between '$fecha_de' and '$fecha_a'";
		$buscar= "fecha_de=$fecha_de&fecha_a=$fecha_a&busqueda=$busqueda&categoria=$categoria";
	}


}
if(!empty($_REQUEST['fecha_de']) && !empty($_REQUEST['fecha_a'])
&& empty($_REQUEST['busqueda']) && !empty($_REQUEST['categoria'])){

	$fecha_de= $_REQUEST['fecha_de'];
	$fecha_a= $_REQUEST['fecha_a'];
	$categoria=$_REQUEST['categoria'];

	if($fecha_de>$fecha_a){
		header("Location: producto.php");
	}else if($fecha_de == $fecha_a){
		$where= "P.Codigo_categoria = $categoria and P.Fecha = '$fecha_de'";
		$buscar = "fecha_de=$fecha_de&fecha_a=$fecha_a&categoria=$categoria";
	}else{
		$where= "P.Codigo_categoria = $categoria and P.Fecha between '$fecha_de' and '$fecha_a'";
		$buscar= "fecha_de=$fecha_de&fecha_a=$fecha_a&categoria=$categoria";
	}

}
		
			

			
		/*PAGINADOOOOOOR*/


$sql_registro= pg_query($conexion,"SELECT COUNT(*) AS total_registro FROM PRODUCTOS P WHERE
 $where "); /*Total de todos los registros*/
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
$consulta= "SELECT P.Nombre_Producto,P.Descripcion,C.Nombre_categoria,P.Fecha,P.Valor_unitario,
P.Valor_de_venta,P.Stock
FROM PRODUCTOS P,CATEGORIAS C
WHERE $where and P.Codigo_categoria=C.Codigo_categoria
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
		<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<?php 
			$pro=0;
			if(!empty($_REQUEST['categoria'])){
				$pro = $_REQUEST['categoria'];
			}

		$query= pg_query($conexion,"SELECT * FROM CATEGORIAS");
		$result_categoria= pg_num_rows($query);

		 ?>
		 <select name="categoria" id="categoria">
		 	<option value="" selected>Categoría</option>
		 	<?php 
		 	if($result_categoria>0){

		 		while ($categoria=pg_fetch_array($query)) {
		 			if($pro==$categoria['codigo_categoria'])
		 			{

		 	 ?>	

		<option value="<?php echo $categoria['codigo_categoria']; ?>" selected><?php echo $categoria['nombre_categoria']?> </option>
<?php  
}else{
?>
	<option value="<?php echo $categoria['codigo_categoria']; ?>" ><?php echo $categoria['nombre_categoria']?> </option>
<?php
}
		 		}
		 	}

?>	

		 </select>
		  <label>Desde</label>
	  	 <input type="date" name="fecha_de" value="<?php  echo $fecha_de; ?>" >
		 <label>Hasta</label>
		 <input type="date" name="fecha_a" value="<?php  echo $fecha_a; ?>" >             
		<input type="submit" name="" value="Filtrar" class="btn_search">

	</div>
	</form>
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
			echo '<li ><a  href="?pagina='.$i.'&'.$buscar.'">'.$i.'</a></li>';

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