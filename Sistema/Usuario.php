<?php 

	include"..\include/conexion.php";


$sql_registro= pg_query($conexion,"SELECT COUNT(*) AS total_registro FROM USUARIOS"); /*Total de todos los registros*/
	$result_registro = pg_fetch_array($sql_registro);
	$total_registro= $result_registro['total_registro'];
	$por_pagina=5; /*Cantidad de filas por paginado*/

if(empty($_GET['pagina'])){

	$pagina=1;
}else{
	$pagina=$_GET['pagina'];
}

$desde=($pagina-1)*$por_pagina;
$total_paginas= ceil($total_registro/$por_pagina); 

/*CONSULTAS*/
$consulta= "SELECT U.Codigo_usuario,U.Nombre,U.Apellido,U.Usuario,U.Correo,R.Tipo
FROM USUARIOS U,ROL R
WHERE U.Cod_rol=R.Cod_rol
limit $por_pagina offset $desde; ";
$resul= pg_query($conexion,$consulta);

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Usuarios</title>
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
	<a href="Registrar_Usuario.php">Registrar Usuario</a>
	</div>
	<div class="filtro">
		<h2>Lista de Usuarios</h2>

	<form action="buscar_usuario.php" method="get" class="form_search">
		<input type="text" name="busqueda" id="busqueda" placeholder="Nombre">
		<?php 
		$query= pg_query($conexion,"SELECT * FROM Rol");
		$result_categoria= pg_num_rows($query);

		 ?>
		 <select name="rol" id="rol">
		 	<option value="" selected>Cargo</option>
		 	<?php 
		 	if($result_categoria>0){

		 		while ($categoria=pg_fetch_array($query)) {

		 	 ?>	

		<option value="<?php echo $categoria['cod_rol']; ?>"><?php echo $categoria['tipo']?> </option>
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
			<td>Apellido</td>
			<td>Usuario</td>
			<td>Correo</td>
			<td>Cargo</td>
			<td>Modificar</td>
			<td>Eliminar</td>

		</tr>
		<?php 

		

		while($mostrar=pg_fetch_array($resul)){
		 ?>
		 <tr class="muestras" >
			<td><?php echo $mostrar['nombre'] ?></td>
			<td><?php echo $mostrar['apellido'] ?></td>
			<td><?php echo $mostrar['usuario']?></td>
			<td><?php echo $mostrar['correo'] ?></td>
			<td><?php echo $mostrar['tipo'] ?></td>
			<td><a href="modificando_usuario.php?id=<?php echo $mostrar['codigo_usuario'] ?>">Modificar</a></td>
			<td><a href="eliminar_usuario.php?id=<?php echo $mostrar['codigo_usuario'] ?>">Eliminar</a></td>

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