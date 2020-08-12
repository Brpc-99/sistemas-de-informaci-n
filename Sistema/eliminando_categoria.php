<?php 
	include"..\include/conexion.php";
session_start();
		if(!empty($_POST)){
			$idusuario=$_POST['idusuario'];
			$query_delete=pg_query($conexion, "DELETE FROM CATEGORIAS where  Codigo_categoria=$idusuario");

			if($query_delete){
		
				echo '<script>
				alert("Eliminado exitosamente");
			window.history.go(-1);
				</script>';
			}else{
				echo '<script>
			alert("Error");
			window.history.go(-1);
			</script>';
			}

		}

		if(empty($_REQUEST['id'])) //para recibir la variable
		{

			header("Location: categoria.php");

		}else{

			$idusuario=$_REQUEST['id'];
			$query= pg_query($conexion,"SELECT c.Codigo_categoria, c.Nombre_categoria,c.Descripcion FROM CATEGORIAS c 
			Where c.Codigo_categoria='$idusuario'");

			$result=pg_num_rows($query);

			if($result >0){

				while ($data=pg_fetch_array($query)) {
				
					$codigo=$data['codigo_categoria'];
					$nombre=$data['nombre_categoria'];
					$descripcion=$data['descripcion'];
				}
			}else{

				header("Location: categoria.php");
			}
		}


 ?> 


<!DOCTYPE html>
<html>
<head>
	<title>Eliminar Usuario</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="..\imagenes\icono.ico">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_header.css">
	<link rel="stylesheet" type="text/css" href="estilo\estilo_eliminar_usuario.css">
</head>
<body>
	<?php include"..\include\header.php"; ?>

	<section>
		
		<div class="delete">
			<h2>¿Esta seguro que desea eliminar el registro?</h2>
			<p>Código: <span><?php echo $codigo; ?></span></p>
			<p>Nombre: <span><?php echo $nombre; ?></span></p>
			<p>Descripción: <span><?php echo $descripcion; ?></span></p>

			<form action="" method="post">
				<input type="hidden" name="idusuario" value="<?php echo $idusuario ?>">
				<input type="submit" name="submit" value="Aceptar" class="btn">
				<a href="categoria.php" class="btn2">Cancelar</a>
				
			</form>
		</div>
	</section>

</body>
</html>